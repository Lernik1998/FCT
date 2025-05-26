<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;


use Laravel\Cashier\Subscription;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role',
        'category',
        'google_calendar_id',
        'is_active',
    ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // Para la gestión de los roles,TODO: pendiente probar si funciona

    public function setRoleAttribute($value)
    {
        $this->attributes['role'] = $value;

        // Cambiar el current_team_id según el rol
        switch ($value) {
            case 'trainer':
                $this->attributes['current_team_id'] = 2;
                break;
            case 'admin':
                $this->attributes['current_team_id'] = 3;
                break;
            default:
                $this->attributes['current_team_id'] = 1;
                break;
        }
    }

    // Relación con membresía
    // User.php
    // public function membership()
    // {
    //     return $this->belongsTo(Plan::class, 'plan_id');
    // }


    // TODO: No se usa
    /* public function hasActiveMembership()
     {
         return $this->subscribed('default') &&
             !$this->subscription('default')->cancelled() &&
             !$this->subscription('default')->ended();
    } */


    /**
     * Verifica si el usuario tiene una membresía activa
     * Compatible con Laravel Cashier v12+
     */
    public function hasActiveMembership()
    {
        if (!$this->subscribed('default')) {
            return false;
        }

        $subscription = $this->subscription('default');

        // Para Laravel Cashier v12/v13
        return $subscription->valid();

        // Alternativa más explícita:
        // return $subscription->active() || $subscription->onGracePeriod();
    }

    /**
     * Obtiene el tipo de membresía del usuario
     */
    public function membershipType()
    {
        return $this->subscribed('default')
            ? $this->subscription('default')->stripe_price
            : null;
    }

    /**
     * Verifica si el usuario tiene una membresía específica
     */
    public function hasMembershipType($type)
    {
        return $this->membershipType() === $type;
    }

    /**
     * Obtiene la fecha de finalización de la membresía
     */
    public function membershipEndsAt()
    {
        return $this->subscribed('default')
            ? $this->subscription('default')->ends_at
            : null;
    }


    // FIXME: Pendiente gestión de las relaciones

    // public function subscriptions()
    // {
    //     return $this->hasMany(Subscription::class);
    // }

    // public function activities()
    // {
    //     return $this->hasMany(Activity::class);
    // }

    // public function reservations()
    // {
    //     return $this->hasMany(UserActivitiesReservations::class);
    // }


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Verifica si es trainer
    public function isTrainer()
    {
        return $this->role === 'trainer';
    }


}
