<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Tution;
use Illuminate\Http\Request;

class TutionController extends Controller
{
    public function index()
    {
        $semester_id = session('semester_id');
        $tutions = Tution::where('id_semester',$semester_id)->get();
        return view('admin.tution.index',compact('tutions'));
    }

    public function notSubmit()
    {
        $students = Student::all();
        $semester_id = session('semester_id');
        $tutions = Tution::where('id_semester',$semester_id)->get();

        $datas = [];

        foreach($students as $student){
            foreach($tutions as $tution){
                if($student->id != $tution->id_student){
                    $result['code'] = $student->code;
                    $result['name'] = $student->name;

                    $datas[] = $result;
                }
            }
        } 

        return view('admin.tution.index',compact('datas'));
    }

    public function create()
    {
        return view('admin.tution.add');
    }

    public function store(Request $request)
    {
        $semester_id = session('semester_id');
        $student_code = $request->student;

        $student = Student::where('code',$student_code)->first();

        $tution = new Tution();
        $tution->id_student = $student->id;
        $tution->id_semester = $semester_id;
        $tution->code = $request->code;
        $tution->desc = $request->description;
        $tution->total = $request->total;
        $tution->date = date('d/m/Y');
        $tution->collector = $request->collector;
        if($tution->save()){
            return redirect()->back();
        }
    }
}
