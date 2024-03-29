<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'id',
        'id_company',
        'id_provider',
        'generate_date',
        'id_user_generated',
        'due_date',
        'status',
        'price',
        'paid_date',
        'id_user_paid',
        'id_cost_center',
        'id_cost_center_subtype',
        'observation',
        'nf',
        'nfe',
        'created_at',
        'updated_at',
    ];
}