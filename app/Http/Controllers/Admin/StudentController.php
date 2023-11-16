<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityClass;
use App\Models\Branch;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\YearTrain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('admin.student.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = Faculty::all();
        return view('admin.student.add',compact('faculties'));
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
            if(Student::create($data)){
                if(!empty($file)){
                    $file->move('uploads/student',$data['avatar']);
                }
                return redirect()->back()->with('success','Thêm sinh viên thành công');
            }else{
                return redirect()->back()->withErrors('Thêm sinh viên thất bại');
            }
        }else{
            return redirect()->back()->withErrors('Mật khẩu không trùng khớp');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::findOrFail($id);
        $faculties = Faculty::all();
        return view('admin.student.edit',compact('student','faculties'));
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
        $student = Student::findOrFail($id);
        $avatar_old = $student->avatar;

        $data = $request->all();
        $checkunion = $request->has('union');
        if(empty($checkunion)){
            $data['union'] = null;
            $data['date_admission'] = null;
        }
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
                return redirect()->back()->withErrors('Vui lòng xác minh mật khẩu');
            }
        }else{
            $data['password'] = $student->password;
        }

        if($student->update($data)){
            if(!empty($file)){
                $file->move('uploads/student',$data['avatar']);
                if(File::exists('uploads/student/'.$avatar_old)){
                    File::delete('uploads/student/'.$avatar_old);
                }
            }
            return redirect()->back()->with('success','Cập nhật thông tin sinh viên thành công');
        }else{
            return redirect()->back()->withErrors('Cập nhật thông tin sinh viên thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        if($student){
            $avatar_old = $student->avatar;
            $student->delete();
            if(File::exists('uploads/student/'.$avatar_old)){
                File::delete('uploads/student/'.$avatar_old);
            } 
            return redirect()->back();
        }
    }

    public function postYearTrain(Request $request)
    {
        $id = $request->id;
        $yeartrain = YearTrain::where('faculty_id',$id)->get();
        return $yeartrain;
    }

    public function postBranch(Request $request)
    {
        $id = $request->id;
        $branch = Branch::where('yeartrain_id',$id)->get();
        return $branch;
    }

    public function postClass(Request $request)
    {
        $id = $request->id;
        $class = ActivityClass::where('branch_id',$id)->get();
        return $class;
    }

    public function postSubject(Request $request)
    {
        $id = $request->id;
        $subject = Subject::where('semester_id',$id)->get();
        return $subject;
    }

    public function postOneSubject(Request $request)
    {
        $id = $request->id;
        $subject = Subject::findOrFail($id);
        return $subject;
    }

    public function postGroup(Request $request)
    {
        $id_branch = $request->id_branch;
        $id_semester = $request->id_semester;
        $group = Group::where('branch_id',$id_branch)->where('semester_id',$id_semester)->get();
        return $group;
    }

    public function getListTeacher(Request $request)
    {
        $id = json_decode($request->id);
        $teachers = Teacher::whereIn('id', $id)->get();

        $teacherArray = $teachers->toArray();

        return $teacherArray;
    }

    public function getYearTrain(string $id)
    {
        $yeartrain = YearTrain::where('faculty_id',$id)->get();
        return $yeartrain;
    }

    public function getBranch(string $id)
    {
        $branch = Branch::where('yeartrain_id',$id)->get();
        return $branch;
    }

    public function getClass(string $id)
    {
        $class = ActivityClass::where('branch_id',$id)->get();
        return $class;
    }

    public function getSubject(string $id)
    {
        $subject = Subject::findOrFail($id);
        $semester_id = $subject->semester_id;

        $result = Subject::where('semester_id',$semester_id)->get();
        return $result;
    }

    public function getTeacher(string $id)
    {
        $subject = $subject = Subject::findOrFail($id);
        $teachers_id = json_decode($subject->teacher);
        $teachers = Teacher::whereIn('id', $teachers_id)->get();
        $result = $teachers->toArray();

        return $result;
    }

    public function getGroup(string $id, $semester)
    {
        $group = Group::where('branch_id',$id)->where('semester_id',$semester)->get();
        return $group;
    }

}
