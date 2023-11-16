<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $table = 'semester';

    protected $fillable = [
        'id',
        'code',
        'name',
        'start',
        'end',
        'year'
    ];

    public function get_yearstudy()
    {
        return $this->belongsTo(YearStudy::class,'year');
    }
}
