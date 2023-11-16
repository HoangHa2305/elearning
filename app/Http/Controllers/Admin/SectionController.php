<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $subject = Subject::findOrFail($id);
        $sections = Section::where('id_subject',$id)->get();
        return view('admin.section.index',compact('sections','subject'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $semesters = Semester::all();
        $faculties = Faculty::all();
        return view('admin.section.add',compact('semesters','faculties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['register'] = 0;
        if($request->monday){
            $data['monday'] = json_encode($request->monday);
        }
        if($request->tuesday){
            $data['tuesday'] = json_encode($request->tuesday);
        }
        if($request->wednesday){
            $data['wednesday'] = json_encode($request->wednesday);
        }
        if($request->thursday){
            $data['thursday'] = json_encode($request->thursday);
        }
        if($request->friday){
            $data['friday'] = json_encode($request->friday);
        }
        if($request->saturday){
            $data['saturday'] = json_encode($request->saturday);
        }
        if($request->sunday){
            $data['sunday'] = json_encode($request->sunday);
        }
        if(Section::create($data)){
            return redirect()->back()->with('success','Thêm lớp học phần thành công');
        }else{
            return redirect()->back()->withErrors('Thêm lớp học phần thất bại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $faculties = Faculty::all();
        $semesters = Semester::all();
        $section = Section::findOrFail($id);
        return view('admin.section.edit',compact('semesters','section','faculties'));
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
        $section = Section::findOrFail($id);
        $data = $request->all();
        
        if($request->monday){
            $data['monday'] = json_encode($request->monday);
        }
        if($request->tuesday){
            $data['tuesday'] = json_encode($request->tuesday);
        }
        if($request->wednesday){
            $data['wednesday'] = json_encode($request->wednesday);
        }
        if($request->thursday){
            $data['thursday'] = json_encode($request->thursday);
        }
        if($request->friday){
            $data['friday'] = json_encode($request->friday);
        }
        if($request->saturday){
            $data['saturday'] = json_encode($request->saturday);
        }
        if($request->sunday){
            $data['sunday'] = json_encode($request->sunday);
        }

        if($section->update($data)){
            return redirect()->back()->with('success','Cập nhật lớp học phần thành công');
        }else{
            return redirect()->back()->withErrors('Cập nhật lớp học phần thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
