<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subject';

    protected $fillable = [
        'id',
        'code',
        'name',
        'faculty_charge',
        'faculty_id',
        'teacher',
        'credits',
        'yeartrain_id',
        'semester_id',
        'type',
        'group',
        'branch_id',
        'description'
    ];

    public function yeartrain()
    {
        return $this->belongsTo(YearTrain::class,'yeartrain_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class,'semester_id');
    }
}
