<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethodSubtype extends Model
{
    protected $fillable = [
        'id',
        'id_payment_method',
        'name',
        'created_at',
        'updated_at',
    ];
}
