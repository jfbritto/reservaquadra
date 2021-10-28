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
        'is_emergency',
        'is_responsible_number',
        'created_at',
        'updated_at',
    ];
}
