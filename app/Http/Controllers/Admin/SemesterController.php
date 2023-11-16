<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Models\YearStudy;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function create()
    {
        $yearstudies = YearStudy::all();
        return view('admin.semester.add',compact('yearstudies'));
    }

    public function store(Request $request)
    {   
        $data = $request->all();
        if(Semester::create($data)){
            return redirect()->back()->with('success','Thêm học kỳ thành công');
        }else{
            return redirect()->back()->withErrors('Thêm học kỳ thất bại');
        }
    }

    public function index()
    {
        $semesters = Semester::all();
        return view('admin.semester.index',compact('semesters'));
    }

    public function getSemester(string $id)
    {
        $semesters = Semester::where('year',$id)->get();
        return view('admin.semester.index',compact('semesters'));
    }

    public function show(string $id)
    {
        $semester = Semester::findOrFail($id);
        $yearstudies = YearStudy::all();
        return view('admin.semester.edit',compact('yearstudies','semester'));
    }

    public function update(Request $request, string $id)
    {
        $semester = Semester::findOrFail($id);
        $data = $request->all();
        if($semester->update($data)){
            return redirect()->back()->with('success','Chỉnh sửa học kỳ thành công');
        }else{
            return redirect()->back()->withErrors('Chỉnh sửa học kỳ thất bại');
        }
    }
}
