<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $fillable = [
        'user_id',
        'symptoms',
        'diagnosis',
        'note',
        'examined_at',
    ];
}
