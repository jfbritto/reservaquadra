<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $fillable = [
        'id',
        'id_company',
        'name',
        'phone1',
        'phone2',
        'objective',
        'age',
        'sun',
        'sun_period',
        'mon',
        'mon_period',
        'tue',
        'tue_period',
        'wed',
        'wed_period',
        'thu',
        'thu_period',
        'fri',
        'fri_period',
        'sat',
        'sat_period',
        'all_days',
        'all_days_period',
        'avaliation_date',
        'observation',
        'status',
        'created_at',
        'updated_at',
    ];
}
