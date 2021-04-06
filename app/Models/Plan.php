<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'id',
        'id_company',
        'name',
        'months',
        'age_range', // 1 = infantil, 2 = juvenil, 3 = adulto
        'day_period', // 1 = diurno, 2 = noturno
        'lessons_per_week',
        'annual_contract',
        'price',
        'status',
        'created_at',
        'updated_at',
    ];
}