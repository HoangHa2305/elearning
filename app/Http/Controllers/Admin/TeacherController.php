<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.teacher.index',compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = Faculty::all();
        return view('admin.teacher.add',compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $file = $request->avatar;
        if(!empty($file)){
            $data['avatar'] = time().'_'.$file->getClientOriginalName();
        }
        if($request->password == $request->confim_password){
            $data['password'] = bcrypt($request->password);
            if(Teacher::create($data)){
                if(!empty($file)){
                    $file->move('uploads/teacher',$data['avatar']);
                }
                return redirect()->back()->with('success','Thêm giảng viên thành công');
            }else{
                return redirect()->back()->withErrors('Thêm giảng viên thất bại'); 
            }
        }else{
            return redirect()->back()->withErrors('Mật khẩu và xác nhận không trùng khớp');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $faculties = Faculty::all();
        $teacher = Teacher::findOrFail($id);
        return view('admin.teacher.edit',compact('teacher','faculties'));
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
        $teacher = Teacher::findOrFail($id);
        $avatar_old = $teacher->avatar;
        $data = $request->all();

        $file = $request->avatar;
        if(!empty($file)){
            $data['avatar'] = time().'_'.$file->getClientOriginalName();
        }
        if(!empty($request->password)){
            if(!empty($request->confim_password)){
                if($request->password == $request->confim_password){
                    $data['password'] = bcrypt($request->password);
                }else{
                    return redirect()->back()->withErrors('Xác minh mật khẩu không trùng khớp');
                }
            }else{
                return redirect()->back()->withErrors('Vui lòng xác minh password');
            }
        }else{
            $data['password'] = $teacher->password;
        }
        if($teacher->update($data)){
            if(!empty($file)){
                $file->move('uploads/teacher',$data['avatar']);
                if(File::exists('uploads/teacher/'.$avatar_old)){
                    File::delete('uploads/teacher/'.$avatar_old);
                }
            }
            return redirect()->back()->with('success','Cập nhật thông tin giảng viên thành công');
        }else{
            return redirect()->back()->withErrors('Cập nhật thông tin giảng viên thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);

        $result = $teacher->delete();
        if($result){
            return redirect()->back();
        }

    }
}
