<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'id',
        'id_company',
        'name',
        'months',
        'status',
        'created_at',
        'updated_at',
    ];
}
