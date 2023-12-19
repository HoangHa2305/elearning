<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Score;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Student;
use Illuminate\Http\Request;

class TeacherApiController extends Controller
{
    public function getAllSubject(string $id)
    {
        $semester = Semester::orderByDesc('id')->first();

        $todays = Section::join('teacher','section.id_teacher','=','teacher.id')
        ->join('subject','section.id_subject','=','subject.id')
        ->where('section.id_teacher',$id)
        ->where('subject.semester_id',$semester->id)
        ->select('section.name AS name',
            'section.id AS id',
            'section.room AS room',
            'section.week AS week',
            'section.monday',
            'section.tuesday',
            'section.wednesday',
            'section.thursday',
            'section.friday',
            'section.saturday',
            'section.sunday')
        ->get();
        $results = [];
        foreach($todays as $today){
            $formatDay = [];
            if(!is_null($today->monday)){
                $formatDay[] = 'Hai / '.implode('->',json_decode($today->monday));
            }
            if(!is_null($today->tuesday)){
                $formatDay[] = 'Ba / '.implode('->',json_decode($today->tuesday));
            }
            if(!is_null($today->wednesday)){
                $formatDay[] = 'Tư / '.implode('->',json_decode($today->wednesday));
            }
            if(!is_null($today->thursday)){
                $formatDay[] = 'Năm / '.implode('->',json_decode($today->thursday));
            }
            if(!is_null($today->friday)){
                $formatDay[] = 'Sáu / '.implode('->',json_decode($today->friday));
            }
            if(!is_null($today->saturday)){
                $formatDay[] = 'Bảy / '.implode('->',json_decode($today->saturday));
            }
            if(!is_null($today->sunday)){
                $formatDay[] = 'Chủ nhật / '.implode('->',json_decode($today->sunday));
            }
            $result = [
                'id' => $today->id,
                'name' => $today->name,
                'week' => $today->week,
                'room' => $today->room,
                'sections' => $formatDay
            ];
            $results[] = $result;
        }

            return response()->json(['subject' => $results]);
    }

    public function getSubjectSchedule(Request $request)
    {
        $semester = Semester::orderByDesc('id')->first();
        $id = $request->id;
        $id_teacher = $request->id_teacher;

        if($id == 2){
            $day = 'monday';
        }elseif($id == 3){
            $day = 'tuesday';
        }elseif($id == 4){
            $day = 'wednesday';
        }elseif($id == 5){
            $day = 'thursday';
        }elseif($id == 6){
            $day = 'friday';
        }elseif($id == 7){
            $day = 'saturday';
        }elseif($id == 8){
            $day = 'sunday';
        }

        $sections = Section::join('subject','section.id_subject','=','subject.id')
                    ->select('section.id AS id',
                            'section.name AS name',
                            'section.room AS room',
                            'section.'.$day)
                    ->where('section.id_teacher',$id_teacher)
                    ->where('section.'.$day,'!=',null)
                    ->where('subject.semester_id',$semester->id)
                    ->get();
        if($sections){
            foreach($sections as $section){
                $section->$day = json_decode($section->$day);
                $section->time = implode('-',$section->$day);
            }
            return response()->json(['section'=>$sections]);
        }else{
            return response()->json(['errors' => 200]);
        }
    }

    public function detailSubject(string $id)
    {
        $data = [];

        $section = Section::join('teacher','section.id_teacher','=','teacher.id')
                    ->select('section.id AS id',
                            'section.name AS title',
                            'teacher.level AS level',
                            'teacher.name AS name',
                            'section.week AS week',
                            'section.room AS room',
                            'section.monday AS monday',
                            'section.tuesday AS tuesday',
                            'section.wednesday AS wednesday',
                            'section.thursday AS thursday',
                            'section.friday AS friday',
                            'section.saturday AS saturday',
                            'section.sunday AS sunday')
                    ->where('section.id',$id)
                    ->first();
                    $data['title'] = $section->title; 
                    $data['week'] = $section->week;
                    $data['room'] = $section->room;
                    if($section->level=='Tiến sĩ'){
                        $data['name'] = 'TS. '.$section->name;
                    }elseif($section->level=='Thạc sĩ'){
                        $data['name'] = 'ThS. '.$section->name;
                    }
                    $formatDay = [];
                    $formatTime = [];
                    if(!is_null($section->monday)){
                        $formatDay[] = 'Hai';
                        $formatTime[] = implode(' -> ',json_decode($section->monday));
                    }
                    if(!is_null($section->tuesday)){
                        $formatDay[] = 'Ba';
                        $formatTime[] = implode(' -> ',json_decode($section->tuesday));
                    }
                    if(!is_null($section->wednesday)){
                        $formatDay[] = 'Tư';
                        $formatTime[] = implode(' -> ',json_decode($section->wednesday));
                    }
                    if(!is_null($section->thursday)){
                        $formatDay[] = 'Năm';
                        $formatTime[] = implode(' -> ',json_decode($section->thursday));
                    }
                    if(!is_null($section->friday)){
                        $formatDay[] = 'Sáu';
                        $formatTime[] = implode(' -> ',json_decode($section->friday));
                    }
                    if(!is_null($section->saturday)){
                        $formatDay[] = 'Bảy';
                        $formatTime[] = implode(' -> ',json_decode($section->saturday));
                    }
                    if(!is_null($section->sunday)){
                        $formatDay[] = 'Chủ nhật';
                        $formatTime[] = implode(' -> ',json_decode($section->sunday));
                    }
        
                    $data['date'] = $formatDay;
                    $data['time'] = $formatTime;

        $attendances = Attendance::where('id_section',$id)->get();
        foreach($attendances as $attendance){
            $result['content'] = $attendance->content;
            $result['time'] = $attendance->time.' '.$attendance->date;
            $arrays = json_decode($attendance->absent);
            if(!empty($arrays)){
                foreach($arrays as $array){
                    $absent = [];
                    $student = Student::findOrFail($array);
                    $absent[] = $student->name;
                }
                $result['absent'] = $absent;
            } 
            $results[] = $result;
        }

        return response()->json(['section' => $data,'content' => $results]);
    }

    public function showAttendance(string $id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('d/m/Y');
        $section = Section::findOrFail($id);
        $attendance = Attendance::where('id_section',$id)->where('date',$date)->first(); 
        $absents = Attendance::where('id_section',$id)->get();
        $array = [];
        $data = [];
        $status = 0;    
        $count_absent = 0;
        $count_permission = 0;
        $count_late = 0;
        foreach($absents as $absent){
            if(!is_null($absent->absent)){
                $value = json_decode($absent->absent);
                $array = array_merge($array,$value);
            }
        }
        if(!is_null($attendance->absent)){
            $array_absent = json_decode($attendance->absent);
            $count_absent = count($attendance->absent);
        }
        if(!is_null($attendance->late)){
            $array_late = json_decode($attendance->late);
            $count_late = count($attendance->late);
        }
        if(!is_null($attendance->permission)){
            $array_permission = json_decode($attendance->permission);
            $count_permission = count($attendance->permission);
        }
        
        $students = Score::join('student','score.id_student','=','student.id')
                    ->select('student.id AS id',
                            'student.name AS name')
                    ->where('score.id_section',$id)
                    ->where('score.id_section','!=',null)
                    ->orderBy('student.id','ASC')
                    ->get();
        foreach($students as $student){
            $result['id'] = $student->id;
            $result['name'] = $student->name;
            $counts = array_count_values($array);
            $result['absent'] = $counts[$student->id] ?? 0;
            if(isset($array_absent)){
                if(in_array($student->id,$array_absent)){
                    $status = 1;
                }
            }
            if(isset($array_permission)){
                if(in_array($student->id,$array_permission)){
                    $status = 2;
                }
            }
            if(isset($array_late)){
                if(in_array($student->id,$array_late)){
                    $status = 3;
                }
            }
            $result['status'] = $status; 

            $data[] = $result;
        }
        $count_attend = ($section->count - $count_absent - $count_late - $count_permission);
        return response()->json(['attendance' => $data,
                                'attend' => $count_attend,
                                'absent' => $count_absent,
                                'late' => $count_late,
                                'permission' => $count_permission]);
    }

    public function postContent(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $teacher_id = $request->teacher_id;
        $section_id = $request->section_id;
        $content = $request->content;
        $date = date('d/m/Y');
        $time = date('h:i:s');

        $result = Attendance::where('id_section',$section_id)->where('date',$date)->first();
        if(isset($result)){
            $result->content = $request->content;
            if($result->save()){
                return response()->json(['status' => 200]);
            }else{
                return response()->json(['errors' => 404]);
            }
        }else{
            $attendance = new Attendance();
            $attendance->id_section = $section_id;
            $attendance->id_teacher = $teacher_id;
            $attendance->content = $content;
            $value = Attendance::where('id_section',$section_id)->orderBy('id','desc')->first();
            if(isset($value)){
                $attendance->reason = $value->reason;
                $attendance->lesson = ($value->lesson) + 1; 
            }else{
                $attendance->lesson =  1;
            }
            $attendance->date = $date;
            $attendance->time = $time;
            if($attendance->save()){
                return response()->json(['status' => 200]);
            }else{
                return response()->json(['errors' => 404]);
            }
        }
    }

    public function postAttendance(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $teacher_id = $request->teacher_id;
        $section_id = $request->section_id;
        $student_id = $request->student_id;
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
            if($result->save()){
                return response()->json(['status' => 200]);
            }else{
                return response()->json(['errors' => 404]);
            }
        }else{
            $attendance =  new Attendance();
            $value = Attendance::where('id_section',$section_id)->orderBy('id','desc')->first();
            if(isset($value)){
                $attendance->reason = $value->reason;
                $attendance->lesson = ($value->lesson) + 1; 
            }else{
                $attendance->lesson =  1;
            }
            $attendance->id_section = $section_id;
            $attendance->id_teacher = $teacher_id;
            
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
            if($attendance->save()){
                return response()->json(['status' => 200]);
            }else{
                return response()->json(['errors' => 404]);
            }
        }
    }

    public function postAllAttendance(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('d/m/Y');
        $time = date('h:i:s');
        $teacher_id = $request->teacher_id;
        $section_id = $request->section_id;
        $attendance = Attendance::where('id_section',$section_id)->where('date',$date)->first();
        if(isset($attendance)){
            $attendance->absent = null;
            $attendance->permission = null;
            $attendance->late = null;
            if($attendance->save()){
                return response()->json(['status' => 200]);
            }else{
                return response()->json(['errors' => 404]);
            }
        }else{
            $attendance = new Attendance();
            $attendance->id_section = $section_id;
            $attendance->id_teacher = $teacher_id;
           
            $value = Attendance::where('id_section',$section_id)->orderBy('id','desc')->first();
            if(isset($value)){
                $attendance->reason = $value->reason;
                $attendance->lesson = ($value->lesson)+1;
            }else{
                $attendance->lesson = 1;
            }
            $attendance->date = $date;
            $attendance->time = $time;
            if($attendance->save()){
                return response()->json(['status' => 200]);
            }else{
                return response()->json(['errors' => 404]);
            }
        }
    }

    public function showScore(string $id)
    {
        $data = [];
        $scores = Score::join('student','score.id_student','=','student.id')
                ->join('class','student.class_id','=','class.id')
                ->select('student.name AS name',
                        'student.id AS student_id',
                        'student.code AS code',
                        'score.id AS id',
                        'class.code AS class',
                        'score.sum_t10_score AS sum_t10_score',
                        'score.sum_t4_score AS sum_t4_score')
                ->where('score.id_section',$id)
                ->where('score.id_section','!=',null)
                ->get();
        foreach($scores as $score){
            $result['name'] = $score->name;
            $result['id'] = $score->id;
            $result['student_id'] = $score->student_id;
            $result['code'] = $score->code;
            $result['class'] = $score->class;
            $result['sum_t10_score'] = $score->sum_t10_score;
            if($score->sum_t10_score >= 8.5 && $score->sum_t10_score <= 10.0){
                $result['sum_t4_score'] = 'A';
            }
            elseif($score->sum_t10_score >= 7.0 && $score->sum_t10_score <= 8.4){
                $result['sum_t4_score'] = 'B';
            }
            elseif($score->sum_t10_score >= 5.5 && $score->sum_t10_score <= 6.9){
                $result['sum_t4_score'] = 'C';
            }
            elseif($score->sum_t10_score >= 4.0 && $score->sum_t10_score <= 5.4){
                $result['sum_t4_score'] = 'D';
            }else{
                $result['sum_t4_score'] = 'F';
            }

            $data[] = $result;
        }

        return response()->json(['score' => $data]);
    }

    public function detailScore(string $id)
    {
        $absent = [];
        $score = Score::findOrFail($id);
        $section_id = $score->id_section;
        $id_student = $score->id_student;
        $attendances = Attendance::where('id_section',$section_id)->get();
        foreach($attendances as $attendance){
            if(isset($attendance->absent)){
                $absent = array_merge($absent,json_decode($attendance->absent));
            }
        }
        $counts = array_count_values($absent);
        $count = $counts[$id_student] ?? 0;
        $data['name'] = $score->student->name;
        $data['id_student'] = $score->student->id;
        $data['active'] = $score->active;
        $sum_t10_score = 0;
        $data['diligence_score'] = 10 - $count;
        if(!empty($score->homework_score)){
            $data['homework_score'] = $score->homework_score;
            $sum_t10_score = (10 - $count) + $score->homework_score * 2;
        }else{
            $sum_t10_score = (10 - $count) * 2;
        }
        if(!empty($score->midterm_score)){
            $data['midterm_score'] = $score->midterm_score;
            $sum_t10_score += $score->midterm_score * 2;
        }
        if(!empty($score->final_score)){
            $data['midterm_score'] = $score->final_score;
            if(!empty($score->homework_score)){
                $sum_t10_score += $score->final_score * 5;
            }else{
                $sum_t10_score += $score->final_score * 6;
            }
        }
        $data['sum_t10_score'] = $sum_t10_score / 10;
        if($score->sum_t10_score >= 8.5 && $score->sum_t10_score <= 10.0){
            $data['sum_t4_score'] = 'A';
        }
        elseif($score->sum_t10_score >= 7.0 && $score->sum_t10_score <= 8.4){
            $data['sum_t4_score'] = 'B';
        }
        elseif($score->sum_t10_score >= 5.5 && $score->sum_t10_score <= 6.9){
            $data['sum_t4_score'] = 'C';
        }
        elseif($score->sum_t10_score >= 4.0 && $score->sum_t10_score <= 5.4){
            $data['sum_t4_score'] = 'D';
        }else{
            $data['sum_t4_score'] = 'F';
        }

        return response()->json(['score' => $data]);
    }

    public function postScore(Request $request)
    {
        $student_id = $request->student_id;
        $section_id = $request->section_id;
        $homework_score = $request->homework_score;
        $midterm_score = $request->midterm_score;
        $final_score = $request->final_score;
        $attendance_score = $request->attendance_score;
        $total_score = $request->total_score;

        $score = Score::where('id_student',$student_id)
                        ->where('id_section',$section_id)
                        ->first();
        if($attendance_score){
            $score->diligence_score = $attendance_score;
        }
        if($homework_score){
            $score->homework_score = $homework_score;
        }
        if($midterm_score){
            $score->midterm_score = $midterm_score;
        }
        if($final_score){
            $score->final_score = $final_score;
        }
        if($total_score){
            if($total_score >= 8.5){
                $sum_t4_score = 4;
            }elseif($total_score >= 7 && $total_score <= 8.4){
                $sum_t4_score = 3;
            }elseif($total_score >= 5.5 && $total_score <= 6.9){
                $sum_t4_score = 2;
            }elseif($total_score >= 4 && $total_score <= 5.4){
                $sum_t4_score = 1;
            }else{
                $sum_t4_score = 0;
            }		
            $score->sum_t10_score = $total_score;
            $score->sum_t4_score = $sum_t4_score;
        }
        if($score->save()){
            return response()->json(['status' => 200]);
        }else{
            return response()->json(['errors' => 404]);
        }
    }

    public function confirmScore(Request $request)
    {
        $student_id = $request->student_id;
        $section_id = $request->section_id;

        $score = Score::where('id_student',$student_id)->where('id_section',$section_id)->first();
        $score->active = 1;
        if($score->save()){
            return response()->json(['status' => 200]);
        }else{
            return response()->json(['errors' => 404]);
        }
    }
}
