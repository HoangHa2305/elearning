<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $fillable = [
        'id',
        'name',
        'branch_id',
        'semester_id',
        'active'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class,'semester_id');
    }
}
