<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
        'id',
        'id_user',
        'number',
        'status',
        'created_at',
        'updated_at',
    ];
}
