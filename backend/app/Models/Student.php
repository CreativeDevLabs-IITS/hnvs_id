<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'suffix',
        'barangay',
        'municipality',
        'age',
        'contact',
        'lrn',
        'emergency_contact',
        'birthdate',
        'signature',
        'image',
        'qr_code',
        'year_level',
        'student_id'
    ];
}
