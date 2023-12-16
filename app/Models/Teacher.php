<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teacher';

    protected $fillable = [
        'id',
        'name',
        'birth',
        'country',
        'level',
        'email',
        'faculty_id',
        'position',
        'phone',
        'address',
        'avatar',
        'password'
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class,'faculty_id');
    }
}
