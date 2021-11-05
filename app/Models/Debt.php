<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $fillable = [
        'id',
        'id_company',
        'id_user',
        'price',
        'observation',
        'status',
        'created_at',
        'updated_at',
    ];
}
