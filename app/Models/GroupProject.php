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
        'id_branch',
        'id_semester',
        'id_teacher',
        'name'
    ];
}
