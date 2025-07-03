<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $fillable = [
        'patient_id',
        'specialty_id',
        'user_id',
        'symptoms',
        'diagnosis',
        'treatment',
        'note',
        'status',
        'examined_at',
    ];
}
