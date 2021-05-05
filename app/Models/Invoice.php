<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'id',
        'id_user',
        'id_contract',
        'due_date',
        'price',
        'discount',
        'paid_price',
        'paid_date',
        'generate_date',
        'cancel_date',
        'id_user_generated',
        'id_user_received',
        'id_user_canceled',
        'id_type',
        'id_payment_method',
        'id_payment_method_subtype',
        'status',
        'created_at',
        'updated_at',
    ];
}
