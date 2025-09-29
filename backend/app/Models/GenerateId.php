<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Generateid extends Model
{
    protected $table = 'generatedids';
    protected $fillable = [
        'student_id',
        'print_count',  
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
