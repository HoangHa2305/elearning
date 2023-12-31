<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $table = 'notice';

    protected $fillable = [
        'id',
        'title',
        'desc',
        'zip',
        'date',
        'id_type',
        'active'
    ];
}
