<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'id',
        'id_company',
        'name',
        'email',
        'password',
        'group',
        'status',
        'birth',
        'rg',
        'cpf',
        'civil_status',
        'profession',
        'address',
        'address_number',
        'complement',
        'city',
        'neighborhood',
        'uf',
        'zip_code',
        'start_date',
        'health_plan',
        'how_met',
        'created_at',
        'updated_at',
    ];
}
