<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    protected $guarded = ['id'];

    // protected $fillable = [
    //     'title',
    //     'description',
    //     'start',
    //     'end',
    //     'user_id',
    //     // 'google_calendar_event_id'
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
