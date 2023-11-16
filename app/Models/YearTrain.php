<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearTrain extends Model
{
    use HasFactory;

    protected $table = 'yeartrain';

    protected $fillable = [
        'id',
        'name',
        'year',
        'faculty_id'
    ];
}
