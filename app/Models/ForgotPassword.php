<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForgotPassword extends Model
{
    use HasFactory;

    protected $table = 'forgotpassword';

    protected $fillable = [
        'id',
        'email',
        'code'
    ];
}
