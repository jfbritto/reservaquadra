<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostCenter extends Model
{
    protected $fillable = [
        'id',
        'id_company',
        'name',
        'status',
        'created_at',
        'updated_at',
    ];
}