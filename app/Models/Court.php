<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    protected $fillable = [
        'id',
        'id_company',
        'name',
        'city',
        'neighborhood',
        'reference',
        'description',
        'status',
        'created_at',
        'updated_at',
    ];
}
