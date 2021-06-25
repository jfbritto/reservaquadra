<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable = [
        'id',
        'id_company',
        'name',
        'day',
        'month',
        'year',
        'status',
        'created_at',
        'updated_at',
    ];
}