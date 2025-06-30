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
        'updated_by',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
