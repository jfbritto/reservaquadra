<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceType extends Model
{
    protected $fillable = [
        'id',
        'name',
        'status',
        'created_at',
        'updated_at',
    ];
}