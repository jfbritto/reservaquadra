<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduledClasses extends Model
{
    protected $fillable = [
        'id',
        'id_court',
        'id_user',
        'week_day',
        'start_time',
        'end_time',
        'status',
        'created_at',
        'updated_at',
    ];
}