<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupProject extends Model
{
    use HasFactory;

    protected $table = 'group_project';

    protected $fillable = [
        'id',
        'title',
        'id_type',
        'id_teacher'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'id_teacher');
    }

    public function type()
    {
        return $this->belongsTo(Typeproject::class,'id_type');
    }
}
