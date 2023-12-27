<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateSubject extends Model
{
    use HasFactory;

    protected $table = 'rate_subject';

    protected $fillable = [
        'id',
        'id_section',
        'id_type',
        'id_semester',
        'id_student',
        'about_section',
        'about_teaching',
        'about_content_section',
        'about_curriculum',
        'necessary',
        'feedback'
    ];
}
