<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailableDates extends Model
{
    protected $fillable = [
        'id',
        'id_court',
        'week_day',
        'start_time',
        'end_time',
        'price',
        'active',
        'created_at',
        'updated_at',
    ];
}
