<?php

namespace App\Models;

use Laravel\Jetstream\Membership as JetstreamMembership;

class Membership extends JetstreamMembership
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    // protected $fillable = [
    //     'user_id',
    //     'type',
    //     'start_date',
    //     'end_date',
    // ];


    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // // public function activity()
    // // {
    // //     return $this->belongsTo(Activity::class);
    // // }

}