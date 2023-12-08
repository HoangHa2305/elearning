<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupProject;
use App\Models\Report;
use App\Models\Student;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $grouproject = GroupProject::findOrFail($id);
        $reports = Report::where('id_group',$id)->get();
        return view('admin.report-project.index',compact('grouproject','reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $grouproject = GroupProject::findOrFail($id);
        return view('admin.report-project.add',compact('grouproject'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $student = Student::where('code',$request->code_student)->first();
        $data['id_student'] = $student->id;
        $data['parent'] = 0;
        $data['confirm'] = 0;
        $data['status'] = 0;
        if(Report::create($data)){
            return redirect()->back()->with('success','Thêm sinh viên nhóm đồ án thành công');
        }else{
            return redirect()->back()->withErrors('Thêm sinh viên nhóm đồ án thất bại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
