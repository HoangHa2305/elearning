<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function showProject()
    {
        return view('frontend.member.project');
    }
}
