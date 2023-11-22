<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Teacher;
use Illuminate\Http\Request;

class GroupProjectController extends Controller
{
    public function index(string $branch, $semester)
    {
        return view('admin.group-project.index',compact('branch','semester'));
    }

    public function create(string $branch, $semester)
    {
        $faculty = Branch::findOrFail($branch);
        $teachers = Teacher::where('faculty_id',$faculty->faculty_id)->select('id','name')->get();
        return view('admin.group-project.add',compact('teachers','branch','semester'));
    }

    public function store(Request $request)
    {
        
    }
}
