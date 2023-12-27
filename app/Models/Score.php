<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $table = 'score';

    protected $fillable = [
        'id',
        'id_student',
        'id_section',
        'id_type',
        'id_semester',
        'session',
        'active',
        'diligence_score',
        'homework_score',
        'midterm_score',
        'final_score',
        'sum_t10_score',
        'sum_t4_score'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class,'id_section');
    }

    public function student()
    {
        return $this->belongsTo(Student::class,'id_student');
    }

    public function type()
    {
        return $this->belongsTo(Typeproject::class,'id_type');
    }
}
