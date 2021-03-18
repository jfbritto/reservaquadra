<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'id',
        'name',
        'responsible',
        'phone',
        'active',
        'created_at',
        'updated_at',
    ];
}
