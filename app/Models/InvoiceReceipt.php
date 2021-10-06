<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceReceipt extends Model
{
    protected $fillable = [
        'id',
        'id_invoice',
        'billing_date',
        'status',
        'price',
        'created_at',
        'updated_at',
    ];
}
