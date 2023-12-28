<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\GroupProject;
use App\Models\Teacher;
use App\Models\Typeproject;
use Illuminate\Http\Request;

class GroupProjectController extends Controller
{
    public function index(string $id)
    {
        $type = Typeproject::findOrFail($id);
        $groups = GroupProject::where('id_type',$id)->get();
        return view('admin.group-project.index',compact('groups','id','type'));
    }

    public function create(string $id)
    {
        $type = Typeproject::findOrFail($id);
        $faculty_id = $type->branch->faculty->id;
        $teachers = Teacher::where('faculty_id',$faculty_id)->select('id','name')->get();
        return view('admin.group-project.add',compact('teachers','id'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if(GroupProject::create($data)){
            return redirect()->back()->with('success','Thêm nhóm đồ án thành công');
        }else{
            return redirect()->back()->withErrors('Thêm nhóm đồ án thất bại');
        }
    }

    public function destroy(string $id)
    {
        $result = GroupProject::findOrFail($id);
        $result->delete();
    }
}
