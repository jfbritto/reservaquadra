<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduledClassesResult extends Model
{
    protected $fillable = [
        'id',
        'id_scheduled_classes',
        'status',
        'date',
        'date_remarked',
        'id_scheduled_classes_result_remarked',
        'observation',
        'created_at',
        'updated_at',
    ];
}