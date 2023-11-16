<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = 'section';

    protected $fillable = [
        'id',
        'code',
        'name',
        'id_subject',
        'id_teacher',
        'count',
        'room',
        'register',
        'active',
        'week',
        'id_group',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'id_teacher');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class,'id_subject');
    }
}
