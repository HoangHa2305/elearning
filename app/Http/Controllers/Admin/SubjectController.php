<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Faculty;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\YearStudy;
use App\Models\YearTrain;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $subjects = Subject::where('semester_id',$id)->get();
        return view('admin.subject.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = Faculty::all();
        $semesters = Semester::all();
        return view('admin.subject.add',compact('faculties','semesters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['teacher'] = json_encode($request->teacher);
        $data['group'] = $request->section_project;
        if($request->type == 0){
            $data['branch_id'] = 0;
        }
        if($request->section_project == 1){
            $data['branch_id'] = 0;
        }  
        if(Subject::create($data)){
            return redirect()->back()->with('success','Thêm môn học thành công');
        }else{
            return redirect()->back()->withErrors('Thêm môn học thất bại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $faculties = Faculty::all();
        $semesters = Semester::all();
        $yearstudies = YearStudy::all();
        $yeartrains = YearTrain::all();
        $branchs = Branch::all();

        $subject = Subject::findOrFail($id);
        return view('admin.subject.edit',compact('subject','faculties','semesters','yearstudies','yeartrains','branchs'));
    }

    public function getTeacher(string $id)
    {
        $teachers = Teacher::select('id','name')->where('faculty_id',$id)->get();
        return $teachers;
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subject = Subject::findOrFail($id);
        $data = $request->all();
        $data['teacher'] = json_encode($request->teacher);
        if($request->type==0){
            $data['branch_id'] = 0;
        }
        if($subject->update($data)){
            return redirect()->back()->with('success','Chỉnh sửa môn học thành công');
        }else{
            return redirect()->back()->withErrors('Chỉnh sửa môn học thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = Subject::where('id',$id)->delete();
        if($result){
            return redirect()->back()->with('success','Xóa môn học thành công');
        }
    }

    public function getListTeacher(Request $request)
    {
        $id = $request->id;
        $teachers = Teacher::select('id','name')->where('faculty_id',$id)->get();
        return $teachers;
    }
}
