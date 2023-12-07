<?php

namespace App\Http\Controllers\Frontend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Score;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use Hamcrest\Core\IsNot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;

class TeacherController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $teacher = Teacher::where('email',$email)->first();
        if($teacher && Hash::check($password,$teacher->password)){
            if(session('student_id')){
                session()->forget('student_id');
            }
            $request->session()->put('teacher_id',$teacher->id);
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

    public function showListSection()
    {
        $teacher_id = session('teacher_id');
        $semester_id = session('semester_id');
        $sections = Section::join('subject','section.id_subject','=','subject.id')
        ->select('section.name AS name',
                'section.id AS id')
        ->where('section.id_teacher',$teacher_id)
        ->where('subject.semester_id',$semester_id)
        ->get();

        return view('frontend.teacher.section',compact('sections'));
    }

    public function showAttendance(string $id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('d/m/Y');
        $section = Section::findOrFail($id);
        $attendance = Attendance::where('id_section',$id)->where('date',$date)->first(); 
        $absents = Attendance::where('id_section',$id)->get();
        $array = [];
        foreach($absents as $absent){
            if(!is_null($absent->absent)){
                $value = json_decode($absent->absent);
                $array = array_merge($array,$value);
            }
        }
        $lists = Score::join('student','score.id_student','=','student.id')
        ->join('class','student.class_id','=','class.id')
        ->where('score.id_section',$id)
        ->select(
            'student.id AS id',
            'student.name AS name',
            'student.code AS code',
            'class.code AS class'
        )
        ->get();
        return view('frontend.teacher.attendance',compact('section','lists','attendance','array'));
    }

    public function postAttendance(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $teacher_id = session('teacher_id');
        $section_id = $request->section_id;
        $student_id = $request->id;
        $date = date('d/m/Y');
        $time = date('h:i:s');
        $type = $request->type;
        $result = Attendance::where('id_section',$section_id)->where('date',$date)->first();
        if(isset($result)){
            $absent = json_decode($result->absent);
            $permission = json_decode($result->permission);
            $late = json_decode($result->late);
            if($type){
                if(is_array($absent)){
                    $index_1 = array_search($student_id,$absent);
                }
                if(is_array($permission)){
                    $index_2 = array_search($student_id,$permission);
                }
                if(is_array($late)){
                    $index_3 = array_search($student_id,$late);
                }
                if($type==1){
                    if(is_null($absent)){
                        $absent[] = $student_id;
                    }else{
                        if(!in_array($student_id,$absent)){
                            $absent[] = $student_id;
                        }
                    }
                    if(isset($index_2)){
                        if($index_2 !== false){
                            unset($permission[$index_2]);
                        }
                    }
                    if(isset($index_3)){
                        if($index_3 !== false){
                            unset($late[$index_3]);
                        }
                    }
                }elseif($type==2){
                    if(is_null($permission)){
                        $permission[] = $student_id;
                    }else{
                        if(!in_array($student_id,$permission)){
                            $permission[] = $student_id;
                        }
                    }
                    if(isset($index_1)){
                        if($index_1 !== false){
                            unset($absent[$index_1]);
                        }
                    }
                    if(isset($index_3)){
                        if($index_3 !== false){
                            unset($late[$index_3]);
                        }
                    }
                }elseif($type==3){
                    if(is_null($late)){
                        $late[] = $student_id;
                    }else{
                        if(!in_array($student_id,$late)){
                            $late[] = $student_id;
                        }
                    }
                    if(isset($index_1)){
                        if($index_1 !== false){
                            unset($absent[$index_1]);
                        }
                    }
                    if(isset($index_2)){
                        if($index_2 !== false){
                            unset($permission[$index_2]);
                        }
                    }
                }elseif($type==4){
                    if(isset($index_1)){
                        if($index_1 !== false){
                            unset($absent[$index_1]);
                        }
                    }
                    if(isset($index_2)){
                        if($index_2 !== false){
                            unset($permission[$index_2]);
                        }
                    }
                    if(isset($index_3)){
                        if($index_3 !== false){
                            unset($late[$index_3]);
                        }
                    }
                }
                if(empty($absent)){
                    $result->absent = null;
                }else{
                    $result->absent = json_encode(array_values($absent));
                }
                if(empty($permission)){
                    $result->permission = null;
                }else{
                    $result->permission = json_encode(array_values($permission));
                }
                if(empty($late)){
                    $result->late = null; 
                }else{
                    $result->late = json_encode(array_values($late));
                }
            }
            $result->save();
        }else{
            $attendance =  new Attendance();
            $value = Attendance::where('id_section',$section_id)->orderBy('id','desc')->first();
            if(isset($value)){
                $attendance->reason = $value->reason;
                $attendance->lesson = ($value->lesson) + 1; 
            }else{
                $attendance->lesson =  1;
            }
            $attendance->id_section = $request->section_id;
            $attendance->id_teacher = $teacher_id;
            if($request->content){
                $attendance->content = $request->content;
            }
            if($type){
                if($type==1){
                    $absent[] = $student_id;
                    $attendance->absent = json_encode($absent);
                }elseif($type==2){
                    $permission[] = $student_id;
                    $attendance->permission = json_encode($permission);
                }elseif($type==3){
                    $late[] = $student_id;
                    $attendance->late = json_encode($late);
                }
            }
            $attendance->date = $date;
            $attendance->time = $time;
            $attendance->save();
        }
    }

    public function postAllAttendance(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('d/m/Y');
        $time = date('h:i:s');
        $teacher_id = session('teacher_id');
        $section_id = $request->section_id;
        $content = $request->content;
        $attendance = Attendance::where('id_section',$section_id)->where('date',$date)->first();
        if(isset($attendance)){
            if($content){
                $attendance->content = $content;
            }else{
                $attendance->absent = null;
                $attendance->permission = null;
                $attendance->late = null;
            }
            $attendance->save();
        }else{
            $attendance = new Attendance();
            $attendance->id_section = $section_id;
            $attendance->id_teacher = $teacher_id;
            if($content){
                $attendance->content = $content;
            }
            $value = Attendance::where('id_section',$section_id)->orderBy('id','desc')->first();
            if(isset($value)){
                $attendance->reason = $value->reason;
                $attendance->lesson = ($value->lesson)+1;
            }else{
                $attendance->lesson = 1;
            }
            $attendance->date = $date;
            $attendance->time = $time;
            $attendance->save();
        }
        return redirect()->back();
    }

    public function getContent(string $id)
    {
        $result = Attendance::where('id_section',$id)->get();
        return $result;
    }

    public function postNotes(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('d/m/Y');
        $time = date('h:i:s');
        $teacher_id = session('teacher_id');
        $section_id = $request->section_id;
        $id = $request->id;
        $value = $request->value;
        $reason = $id .':'. $value;
        $attendance = Attendance::where('id_section',$section_id)->where('date',$date)->first();
        if(isset($attendance)){
            if($attendance->reason != null){
                $reason_old = json_decode($attendance->reason);
                foreach($reason_old as $key => $item){
                    $part = explode(':',$item);
                    $id_old = $part[0];

                    if($id_old == $id){
                        unset($reason_old[$key]);
                    }
                }
            }
            $reason_old[] = $reason;
            $attendance->reason = json_encode(array_values($reason_old));
            $attendance->save();
        }else{
            $attendance = new Attendance();
            $attendance->id_section = $section_id;
            $attendance->id_teacher = $teacher_id;
            $value = Attendance::where('id_section',$section_id)->orderBy('id','desc')->first();
            if(isset($value)){
                $attendance->lesson = ($value->lesson)+1;
            }else{
                $attendance->lesson = 1;
            }
            $reason_new[] = $reason;
            $attendance->reason = json_encode($reason_new);
            $attendance->date = $date;
            $attendance->time = $time;
            $attendance->save();
        }
    }

    public function getNotes(string $id)
    {
        $notes = Attendance::select('reason')
                ->where('id_section',$id)
                ->where('reason','!=',null)
                ->orderBy('id','desc')
                ->first();
        return $notes;
    }

}
