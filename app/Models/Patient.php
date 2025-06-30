<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'national_id',
        'full_name',
        'date_of_birth',
        'gender',
        'address',
        'insurance_number',
        'insurance_expiry_date',
        'updated_by',
    ];
}
