<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $fillable = [
        'invoice_id',
        'item_type',
        'item_id',
        'unit_price',
        'quantity',
        'total_price',
    ];
}
