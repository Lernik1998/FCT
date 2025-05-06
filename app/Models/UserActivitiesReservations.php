<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivitiesReservations extends Model
{
    protected $guarded = [];
    //

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con la actividad
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
