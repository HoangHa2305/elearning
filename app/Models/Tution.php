<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tution extends Model
{
    use HasFactory;

    protected $table = 'tution';

    protected $fillable = [
        'id',
        'id_student',
        'id_semester',
        'code',
        'desc',
        'total',
        'date',
        'collector'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class,'id_student');
    }
}
