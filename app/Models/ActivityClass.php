<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityClass extends Model
{
    use HasFactory;

    protected $table = 'class';

    protected $fillable = [
        'id',
        'code',
        'name',
        'teacher_id',
        'count',
        'faculty_id',
        'yeartrain_id',
        'branch_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
