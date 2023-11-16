<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $table = 'credits';

    protected $fillable = [
        'id',
        'student_id',
        'section_id',
        'time'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }
}
