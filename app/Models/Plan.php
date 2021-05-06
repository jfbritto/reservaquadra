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
        'price_march',
        'price_april',
        'price_may',
        'price_june',
        'price_july',
        'price_august',
        'price_september',
        'price_october',
        'price_november',
        'price_december',
        'status',
        'created_at',
        'updated_at',
    ];
}