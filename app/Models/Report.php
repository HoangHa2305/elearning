<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $fillable = [
        'id',
        'id_student',
        'code_student',
        'parent',
        'id_parent',
        'id_group',
        'title',
        'topic',
        'desc_topic',
        'date_topic',
        'report',
        'desc_report',
        'date_report',
        'status'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class,'id_student');
    }

    public function group()
    {
        return $this->belongsTo(GroupProject::class,'id_group');
    }
}
