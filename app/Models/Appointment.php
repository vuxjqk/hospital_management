<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'specialty_id',
        'queue_number',
        'has_insurance',
        'updated_by'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function examination()
    {
        return $this->belongsTo(Examination::class);
    }
}
