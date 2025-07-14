<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'school_year',
        'descripition',
        'teacher_id',
        'year_level',
        'semester',
        'is_specialized',
        'section'
    ];

    public function teachers() {
        return $this->belongsToMany(Teacher::class, 'subject_teacher', 'subject_id', 'teacher_id');
    }

    public function students() {
        return $this->belongsToMany(Student::class, 'subject_students')->withPivot('student_id');
    }
}
