<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branch';

    protected $fillable = [
        'id',
        'code',
        'name',
        'faculty_id',
        'yeartrain_id',
        'time',
        'degree',
        'description'
    ];
}
