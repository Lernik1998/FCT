<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemporalReservation extends Model
{
    protected $fillable = [
        'user_id',
        'activity_id',
        'session_id',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime'
    ];
}
