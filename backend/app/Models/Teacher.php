<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Teacher extends Model
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'suffix',
        'contact',
        'email',
        'password',
        'image',
        'role',
        'email_token',
        'email_token_expires_at',
    ];

    public function subjects() {
        return $this->belongsToMany(Subject::class, 'subject_teacher');
    }
}
