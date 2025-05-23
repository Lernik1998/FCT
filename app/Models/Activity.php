<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Establece slots = capacity si no se ha definido explícitamente
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($activity) {
            if (is_null($activity->slots)) {
                $activity->slots = $activity->capacity;
            }
        });
    }
}
