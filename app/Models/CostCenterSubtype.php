<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostCenterSubtype extends Model
{
    protected $fillable = [
        'id',
        'id_cost_center',
        'name',
        'status',
        'created_at',
        'updated_at',
    ];
}