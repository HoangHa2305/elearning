<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typeproject extends Model
{
    use HasFactory;

    protected $table = 'type_project';

    protected $fillable = [
        'id',
        'title',
        'id_branch',
        'id_semester',
        'id_subject',
        'date_start',
        'time_start',
        'date_end',
        'time_end'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class,'id_branch');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class,'id_subject');
    }
}
