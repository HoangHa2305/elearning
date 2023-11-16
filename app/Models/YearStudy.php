<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearStudy extends Model
{
    use HasFactory;

    protected $table = 'yearstudy';

    protected $fillable = [
        'id',
        'code',
        'name',
        'start',
        'end'
    ];
}
