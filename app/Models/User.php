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
        'registration_type',
        'birth',
        'rg',
        'cpf',
        'civil_status',
        'nationality',
        'gender',
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
        'special_care',
        'objective',
        'how_met',
        'responsible_name',
        'responsible_rg',
        'responsible_cpf',
        'responsible_civil_status',
        'responsible_nationality',
        'responsible_profession',
        'responsible_address',
        'responsible_address_number',
        'responsible_complement',
        'responsible_city',
        'responsible_neighborhood',
        'responsible_uf',
        'responsible_zip_code',
        'created_at',
        'updated_at',
    ];
}
