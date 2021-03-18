<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    protected $fillable = [
        'id',
        'id_available_date',
        'reservation_date',
        'name_reserved',
        'phone_reserved',
        'status',
        'created_at',
        'updated_at',
    ];
}
