<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'products_id',
        'transactions_id',
        'price',
        'shipping_status',
        'resi',
        'code',
    ];
}
