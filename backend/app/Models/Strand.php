<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Strand extends Model
{
    protected $fillable = [
        'description',
        'track',
        'cluster',
        'specialization'
    ];

    public function students() {
        return $this->hasMany(Student::class);
    }
}
