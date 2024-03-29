<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethodSubtypeCondition extends Model
{
    protected $fillable = [
        'id',
        'id_payment_method_subtype',
        'parcel',
        'is_flat',
        'percentage_tax',
        'flat_tax',
        'days_for_payment',
        'created_at',
        'updated_at',
    ];
}
