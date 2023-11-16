<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';

    protected $fillable = [
        'id',
        'code',
        'name',
        'birth',
        'country',
        'sex',
        'citizen',
        'nation',
        'religion',
        'phone',
        'address',
        'union',
        'date_admission',
        'faculty_id',
        'branch_id',
        'yeartrain_id',
        'class_id',
        'email',
        'avatar',
        'password',
        'physical',
        'defense',
        'english'
    ];

    public function activity_class()
    {
        return $this->belongsTo(ActivityClass::class,'class_id');
    }

    public function get_yeartrain()
    {
        return $this->belongsTo(YearTrain::class,'yeartrain_id');
    }

    public function get_branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function get_faculty()
    {
        return $this->belongsTo(Faculty::class,'faculty_id');
    }
}
