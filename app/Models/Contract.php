<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'id',
        'id_plan',
        'id_user',
        'start_date',
        'end_date',
        'expiration_day',
        'status',
        'price_per_month',
        'created_at',
        'updated_at',
    ];
}
