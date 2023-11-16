<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityClass;
use App\Models\Branch;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\YearTrain;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(string $id)
    {
        $classes = ActivityClass::where('branch_id',$id)->get();
        return view('admin.class.index',compact('classes'));
    }

    public function create()
    {
        $faculties = Faculty::all();
        return view('admin.class.add',compact('faculties'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if(ActivityClass::create($data)){
            return redirect()->back()->with('success','Thêm lớp sinh hoạt thành công');
        }else{
            return redirect()->back()->withErrors('Thêm lớp sinh hoạt thất bại');
        }
    }

    public function getListStudent(string $id)
    {
        $students = Student::where('class_id',$id)->get();
        return view('admin.student.index',compact('students'));
    }

    public function getListTeacher(Request $request)
    {
        $id = $request->id;
        $teacher = Teacher::where('faculty_id',$id)->get();
        return $teacher;
    }

    public function getYearTrain(Request $request)
    {
        $id = $request->id;
        $yeartrain = YearTrain::where('faculty_id',$id)->get();
        return $yeartrain;
    }

    public function getBranch(Request $request)
    {
        $id = $request->id;
        $branch = Branch::where('yeartrain_id',$id)->get();
        return $branch;
    }
}
