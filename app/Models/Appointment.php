<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = ['id'];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
