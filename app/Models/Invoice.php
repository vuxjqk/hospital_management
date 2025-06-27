<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'patient_id',
        'total_amount',
        'status',
        'paid_by',
        'paid_at',
        'created_by',
    ];
}
