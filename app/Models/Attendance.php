<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance';

    protected $fillable = [
        'id',
        'lesson',
        'id_section',
        'id_teacher',
        'content',
        'absent',
        'late',
        'permission',
        'time'
    ];
}
