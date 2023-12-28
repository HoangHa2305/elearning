<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\MailNotify;
use App\Models\Attendance;
use App\Models\Credit;
use App\Models\ForgotPassword;
use App\Models\Group;
use App\Models\Score;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Tution;
use App\Models\Typeproject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StudentApiController extends Controller
{
    public function Login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $role = $request->role;

        $semester_id = Semester::orderBy('id','desc')->first();

        if($role==1){
            $student = Student::where('email',$email)->first();
            $student['birth'] = date('d/m/Y',strtotime($student->birth));
            $student['class'] = $student->activity_class->code;
            $student['branch'] = $student->get_branch->name;
            if($student->sex == 0){
                $student['sex'] = "Nam";
            }else{
                $student['sex'] = "Nữ";
            }

            if($student && Hash::check($password,$student->password)){
                return response()->json([
                    'status' => 200,
                    'student' => $student,
                    'semester_id' => $semester_id->id
                ]);
            }else{
                return response()->json(['errors' => 'Đăng nhập thất bại']);
            }
        }elseif($role==2){
            $teacher = Teacher::where('email',$email)->first();

            if($teacher && Hash::check($password,$teacher->password)){
                $teacher['faculty_name'] = $teacher->faculty->name;
                return response()->json([
                    'status' => 200,
                    'teacher' => $teacher,
                    'semester_id' => $semester_id->id
                ]);
            }else{
                return response()->json(['errors' => 'Đăng nhập thất bại']);
            }
        }
    }

    public function checkEmail(Request $request)
    {
        $data = $request->json()->all();
        $email = $data['email'];
        $role = $data['role'];

        if($role==1){
            $check = Student::where('email',$email)->first();
        }elseif($role==2){
            $check = Teacher::where('email',$email)->first();
        }
 
        if($check){
            return response()->json(['status'=>200]);
        }else{
            return response()->json(['errors'=>404]);
        }
    }

    public function sendMail(Request $request)
    {
        $email = $request->email;
        $role = $request->role;

        if($role==1){
            $student = Student::where('email',$email)->first();
            $code = substr($student->id*1000000+time(),-6);
        }elseif($role==2){
            $teacher = Teacher::where('email',$email)->first();
            $code = substr($teacher->id*1000000+time(),-6);
        }
    
        $data = [
            'subject' => 'Đặt lại mật khẩu',
            'body' => 'Mã đặt lại mật khẩu của bạn là:',
            'code' => $code
        ];
        try{
            Mail::to($email)->send(new MailNotify($data));

            $forgot = new ForgotPassword();
            $forgot->email = $email;
            $forgot->code = $code;
            $forgot->save();
            return response()->json(['status'=>200]);
        }catch(Exception $th){
            return response()->json(['errors'=>404]);
        }
    }

    public function checkOtp(Request $request)
    {
        $email = $request->email;
        $code = $request->otp_pin;

        $check = ForgotPassword::where('email',$email)->latest()->first();
        $confirm = $check->code;

        if($confirm == $code){
            return response()->json(['status'=>400]);
        }else{
            return response()->json(['errors'=>$confirm]);
        }
    }

    public function newPassword(Request $request)
    {
        $email = $request->email;
        $new_password = $request->new_password;
        $role = $request->role;

        if($role==1){
            $student = Student::where('email',$email)->first();
            $student->password = bcrypt($new_password);
            if($student->save()){
                return response()->json(['status'=>400]);
            }else{
                return response()->json(['errors'=>404]);
            }
        }elseif($role==2){
            $teacher = Teacher::where('email',$email)->first();
            $teacher->password = bcrypt($new_password);
            if($teacher->save()){
                return response()->json(['status'=>400]);
            }else{
                return response()->json(['errors'=>404]);
            }
        }  
    }

    public function getListSubject(string $id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $day = date('l');

        $day = strtolower($day);

        $semester = Semester::orderByDesc('id')->first();

        $sectionId = Score::where('id_student',$id)->where('id_semester',$semester->id)->pluck('id_section')->toArray();

        $sections = Section::whereIn('id',$sectionId)->where($day,'!=',null)->select('name','room',$day)->get();

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

    public function getSubjectSchedule(Request $request)
    {
        $id = $request->id;
        $id_student = $request->id_student;

        $semester = Semester::orderByDesc('id')->first();
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

        $sections = Score::join('section','score.id_section','=','section.id')
                    ->select('section.id AS id',
                            'section.name AS name',
                            'section.room AS room',
                            'section.'.$day)
                    ->where('score.id_student',$id_student)
                    ->where('score.id_semester',$semester->id)
                    ->where('score.id_section','!=',null)
                    ->where('section.'.$day,'!=',null)
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

    public function getListScore(string $id)
    {
        $semester = Semester::orderByDesc('id')->first();

        $subject = DB::table('score')
            ->where('id_student',$id)
            ->where('id_semester','!=',$semester->id)
            ->join('section', 'score.id_section', '=', 'section.id')
            ->join('subject', 'section.id_subject', '=', 'subject.id')
            ->select('subject.name','score.id','score.sum_t4_score')
            ->get()
            ->map(function ($item) {
                $total = $item->sum_t4_score;
                $item->sum_t4_score = $this->getGradeByTotal($total);
                return $item;
            });

            return response()->json(['subject' => $subject]);
    }

    public function getSubjectSemester(string $id)
    {
        $semester = Semester::orderByDesc('id')->first();

        $todays = Section::join('score','section.id','=','score.id_section')
        ->join('teacher','section.id_teacher','=','teacher.id')
        ->where('score.id_student',$id)
        ->where('score.id_semester',$semester->id)
        ->select('section.name AS name',
            'section.id AS section_id',
            'score.id AS id',
            'teacher.name AS teacher',
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
                'section_id' => $today->section_id,
                'name' => $today->name,
                'teacher' => $today->teacher,
                'week' => $today->week,
                'room' => $today->room,
                'sections' => $formatDay
            ];
            $results[] = $result;
        }

            return response()->json(['subject' => $results]);
    }

    public function getGradeByTotal($total) {
        if ($total == 4) {
            return 'A';
        } elseif ($total == 3) {
            return 'B';
        } elseif ($total == 2) {
            return 'C';
        } elseif ($total == 1) {
            return 'D';
        } elseif ($total == 0) {
            return 'F';
        }

        return ''; 
    }

    public function getSemester()
    {
        $semester = Semester::orderByDesc('id')->first();

        return response()->json(['semester' => $semester]);
    }

    public function getDetailScore(string $id)
    {
        $score = Score::findOrFail($id);

        $total_score = ($score->diligence_score * 1 + $score->homework_score * 2 + $score->midterm_score * 2 + $score->final_score * 5) / 10 ;

        $item['session'] = $score->session;
        $item['credit'] = $score->section->subject->credits;
        $item['diligence'] = $score->diligence_score;
        $item['homework'] = $score->homework_score;
        $item['midterm'] = $score->midterm_score;
        $item['final'] = $score->final_score;
        $item['full'] = $total_score;

        return response()->json(['score' => $item]);
    }

    public function getProjectClass(Request $request)
    {
        $student_id = $request->student_id;
        $semester_id = $request->semester_id;
        $project = Score::join('type_project','score.id_type','=','type_project.id')
                    ->select('type_project.title AS title',
                             'type_project.id AS id')
                    ->where('score.id_student',$student_id)
                    ->where('score.id_semester',$semester_id)
                    ->get();

        return response()->json(['project' => $project]);
    }

    public function detailProject(Request $request)
    {
        $student_id = $request->id_student;
        $semester_id = $request->id_semester;
        $type_id = $request->id;

        $data = [];
        $projects = Typeproject::join('group_project','group_project.id_type','=','type_project.id')
                    ->join('reports','reports.id_group','=','group_project.id')
                    ->join('teacher','group_project.id_teacher','=','teacher.id')
                    ->join('score','type_project.id','=','score.id_type')
                    ->select('reports.title AS title',
                            'group_project.title AS group_title',
                            'teacher.level AS level',
                            'teacher.name AS name',
                            'teacher.phone AS phone',
                            'teacher.email AS email',
                            'reports.topic AS topic',
                            'reports.confirm AS confirm',
                            'reports.report AS report',
                            'reports.status AS status',
                            'score.diligence_score AS diligence_score',
                            'type_project.date_start AS date_start',
                            'type_project.time_start AS time_start',
                            'type_project.date_end AS date_end',
                            'type_project.time_end AS time_end')
                    ->where('reports.id_student',$student_id)
                    ->where('type_project.id_semester',$semester_id)
                    ->where('type_project.id',$type_id)
                    ->get();
        foreach($projects as $project){
            $data['title'] = $project->group_title;
            $data['title'] = $project->title;
            if($project->level=='Tiến sĩ'){
                $data['name'] = 'TS. '.$project->name;
            }elseif($project->level=='Thạc sĩ'){
                $data['name'] = 'ThS. '.$project->name;
            }
            $data['phone'] = $project->phone;
            $data['email'] = $project->email;
            if(!empty($project->topic)){
                $data['topic'] = 1;
            }else{
                $data['topic'] = 0;
            }
            if($project->confirm==1){
                $data['confirm'] = 1;
            }else{
                $data['confirm'] = 0;
            }
            if(!empty($project->report)){
                $data['report'] = 1;
            }else{
                $data['report'] = 0;
            }
            if($project->status==1){
                $data['status'] = 1;
                $data['diligence_score'] = $project->diligence_score;
            }else{
                $data['status'] = 0;
            }
            $data['start'] = $project->date_start.' '.$project->time_start;
            $data['end'] = $project->date_end.' '.$project->time_end;
        }

        return response()->json(['project' => $data]);
    }

    public function detailSubject(string $id)
    {
        $data = [];

        $sections = Section::join('teacher','section.id_teacher','=','teacher.id')
                    ->select('section.name AS title',
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
                    ->get();
        foreach($sections as $section){
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
        }

        $attendances = Attendance::where('id_section',$id)->get();
        foreach($attendances as $attendance){
            $result['content'] = $attendance->content;
            $result['time'] = $attendance->time.' '.$attendance->date;
            $arrays = json_decode($attendance->absent);
            foreach($arrays as $array){
                $absent = [];
                $student = Student::findOrFail($array);
                $absent[] = $student->name;
            }
            $result['absent'] = $absent;
            $results[] = $result;
        }

        return response()->json(['section' => $data,'content' => $results]);
    }

    public function getTution(Request $request)
    {
        $student_id = $request->id_student;
        $semester_id = $request->id_semester;

        $tution = [];
        $credit = 0;

        $scores = Score::where('id_student',$student_id)->where('id_section','!=',null)->where('id_semester',$semester_id)->get();
        $projects = Score::where('id_student',$student_id)->where('id_type','!=',null)->where('id_semester',$semester_id)->get();
        foreach($scores as $score){
            $data['name'] = $score->section->name;
            $data['credit'] = $score->section->subject->credits;
            $data['session'] = $score->session;
            $credit += $score->section->subject->credits;
            $tution[] = $data;
        }
        foreach($projects as $project){
            $data['name'] = $project->type->title;
            $data['credit'] = $project->type->subject->credits;
            $data['session'] = $score->session;
            $credit += $project->type->subject->credits;

            $tution[] = $data;
        }
        return response()->json(['tution' => $tution,'credit' => $credit]);
    }

    public function getPaid(string $id)
    {
        $data = [];
        $gtotal = 0;
        $tutions = Tution::where('id_student',$id)->get();

        foreach($tutions as $tution){
            $result['code'] = $tution->code;
            $result['date'] = $tution->date;
            $result['total'] = $tution->total;
            $result['description'] = $tution->desc;
            $result['collector'] = $tution->collector;
            $gtotal += $tution->total;

            $data[] = $result;
        }
        return response()->json(['tution' => $data,'total' => $gtotal]);
    }

    public function getGroup(Request $request)
    {
        $semester_id = $request->semester_id;
        $student_id = $request->student_id;
        $student = Student::findOrFail($student_id);
        $branch_id = $student->branch_id;
        $yeartrain_id = $student->yeartrain_id;

        $data = [];

        $groups = Group::where('branch_id',$branch_id)
                ->where('semester_id',$semester_id)
                ->where('active',1)->get();
        foreach($groups as $group){
            $result['id'] = $group->id;
            $result['name'] = $group->name;

            $data[] = $result;
        }

        $result = [];
        $credits = Credit::where('student_id',$student_id)->where('semester_id',$semester_id)->where('section_id','!=',null)->get();
        foreach($credits as $credit){
            $monday = json_decode($credit->section->monday);
            $tuesday = json_decode($credit->section->tuesday);
            $wednesday = json_decode($credit->section->wednesday);
            $thursday = json_decode($credit->section->thursday);
            $friday = json_decode($credit->section->friday);
            $saturday = json_decode($credit->section->saturday);
            $sunday = json_decode($credit->section->sunday);
            $output = '';
            
            if($monday){
                $output .= "Mon_".$monday[0].'-'.$monday[count($monday)-1];
            }
            if($tuesday){
                $output .= "Tue_".$tuesday[0].'-'.$tuesday[count($tuesday)-1];
            }
            if($wednesday){
                $output .= "Wed_".$wednesday[0].'-'.$wednesday[count($wednesday)-1];
            }
            if($thursday){
                $output .= "Thu_".$thursday[0].'-'.$thursday[count($thursday)-1];
            }
            if($friday){
                $output .= "Fri_".$friday[0].'-'.$friday[count($friday)-1];
            }
            if($saturday){
                $output .= "Sat_".$saturday[0].'-'.$saturday[count($saturday)-1];
            }
            if($sunday){
                $output .= "Sun_".$sunday[0].'-'.$sunday[count($sunday)-1];
            }

            if($credit->section->teacher->level == 'Tiến sĩ'){
                $teacher = "TS. ".$credit->section->teacher->name;  
            }elseif($credit->section->teacher->level == 'Thạc sĩ'){
                $teacher = "ThS. ".$credit->section->teacher->name; 
            }

            $results[] = [
                'id' => $credit->id,
                'code' => $credit->section->code,
                'name' => $credit->section->name,
                'credit' => $credit->section->subject->credits,
                'teacher' => $teacher,
                'desc' => $output,
                'week' => $credit->section->week,
            ];
        }
        $types = Credit::join('type_project','credits.type_id','=','type_project.id')
                        ->join('subject','type_project.id_subject','=','subject.id')
                        ->select('type_project.title AS title',
                                'credits.type_id AS type_id',
                                'credits.id AS id',
                                'subject.code AS code',
                                'subject.teacher AS teacher',
                                'subject.credits AS credit') 
                        ->where('credits.student_id',$student_id)
                        ->where('credits.semester_id',$semester_id)
                        ->where('credits.type_id','!=',null)
                        ->get();
        foreach($types as $type){
            $teachers = json_decode($type->teacher);
            foreach($teachers as $teacher){
                $teacher_id = intval($teacher);
                $name = Teacher::findOrFail($teacher_id);
            }
            $results[] = [
                'title' => $type->title,
                'code' => $type->code,
                'id' => $type->id,
                'type_id' => $type->type_id,
                'teacher' => $name->name,
                'credit' => $type->credit
            ];
        }

        $result_project = [];
        $projects = Subject::join('type_project','subject.id','=','type_project.id_subject')
                    ->select('type_project.title AS name',
                            'type_project.id AS id',
                            'subject.code AS code',
                            'subject.credits AS credit')
                    ->where('subject.semester_id',$semester_id)
                    ->where('subject.yeartrain_id',$yeartrain_id)
                    ->where('subject.group',1)
                    ->get();
        foreach($projects as $project){
            $data_project['id'] = $project->id; 
            $data_project['name'] = $project->name;
            $data_project['code'] = $project->code;
            $data_project['credit'] = $project->credit;
            $data_project['active'] = 0;
            foreach($types as $type){
                if($project->id == $type->type_id){
                    $data_project['active'] = 1;
                }
            }
            $result_project[] = $data_project;
        }
        return response()->json(['group' => $data,'project' => $result_project,'result' => $results]);        
    }

    public function getSubjectByGroup(Request $request)
    {
        $id = $request->id;
        $student_id = $request->student_id;
        $semester_id = $request->semester_id;
        $credits = Credit::where('student_id',$student_id)->where('section_id','!=',null)->where('semester_id',$semester_id)->get();
            
            $sections = Section::where('id_group',$id)->get();
            $result = [];
            foreach($sections as $section){
                $monday = json_decode($section['monday']);
                $tuesday = json_decode($section['tuesday']);
                $wednesday = json_decode($section['wednesday']);
                $thursday = json_decode($section['thursday']);
                $friday = json_decode($section['friday']);
                $saturday = json_decode($section['saturday']);
                $sunday = json_decode($section['sunday']);
                $output = '';
                $alert = 0;
                foreach($credits as $credit){
                    if($credit->section->subject->id == $section->subject->id){
                        $alert = 1;
                    }
                }
                
                if($monday){
                    $output .= "Mon_".$monday[0].'-'.$monday[count($monday)-1];
                }
                if($tuesday){
                    $output .= "Tue_".$tuesday[0].'-'.$tuesday[count($tuesday)-1];
                }
                if($wednesday){
                    $output .= "Wed_".$wednesday[0].'-'.$wednesday[count($wednesday)-1];
                }
                if($thursday){
                    $output .= "Thu_".$thursday[0].'-'.$thursday[count($thursday)-1];
                }
                if($friday){
                    $output .= "Fri_".$friday[0].'-'.$friday[count($friday)-1];
                }
                if($saturday){
                    $output .= "Sat_".$saturday[0].'-'.$saturday[count($saturday)-1];
                }
                if($sunday){
                    $output .= "Sun_".$sunday[0].'-'.$sunday[count($sunday)-1];
                }
                if($section->teacher->level == 'Tiến sĩ'){
                    $teacher = "TS. ".$section->teacher->name;  
                }elseif($section->teacher->level == 'Thạc sĩ'){
                    $teacher = "ThS. ".$section->teacher->name; 
                }
                $result[] = [
                    'id' => $section->id,
                    'name' => $section->name,
                    'credits' => $section->subject->credits,
                    'register' => $section->register,
                    'count' => $section->count,
                    'week' => $section->week,
                    'teacher' => $teacher,
                    'desc' => $output,
                    'alert' => $alert
                ];
            }
        
        return $result;
    }

    public function registerCredits(Request $request)
    {
        $id = $request->id;
        $student_id = $request->student_id;
        $semester_id = $request->semester_id;
        $time = date("h:i:s d-m-Y");

        $credit = new Credit();
        $credit->student_id = $student_id;
        $credit->semester_id = $semester_id;
        $credit->section_id = $id;
        $credit->time = $time;

        if($credit->save()){
            Section::where('id',$id)->increment('register');

            $section = Section::findOrFail($id);
            $score = new Score();
            $score->id_student = $student_id;
            $score->id_section = $id;
            $score->id_semester = $section->subject->semester_id;
            $score->session = 1;
            $score->active = 0;
            if($score->save()){
                return response()->json(['success' => 200]); 
            };
        }
    }

    public function registerAllGroup(Request $request)
    {
        $student_id = $request->student_id;
        $semester_id = $request->semester_id;
        $group_id = $request->group_id;
        $time = date("h:i:s d-m-Y");

        $sections = Section::where('id_group',$group_id)->get();

        foreach($sections as $section){
            $credit = new Credit();
            $credit->student_id = $student_id;
            $credit->semester_id = $semester_id;
            $credit->section_id = $section;
            $credit->time = $time;
            if($credit->save()){
                $getSection = Section::findOrFail($section);
                $score = new Score();
                $score->id_student = $student_id;
                $score->id_section = $section;
                $score->id_semester = $getSection->subject->semester_id;
                $score->session = 1;
                $score->active = 0;
                $score->save();
            }
        }
        return response()->json(['success' => 200]); 
    }

    public function destroyCredit(Request $request)
    {
        $student_id = $request->student_id;
        $semester_id = $request->semester_id;
        $id = $request->id;
        $result = Credit::findOrFail($id);
        if($result){
            Section::where('id',$result->section_id)->decrement('register');
            Score::where('id_section',$result->section_id)->where('id_semester',$semester_id)->where('id_student',$student_id)->delete();
            $result->delete();
            return response()->json(['success' => 200]);
        }
    }

    public function creditProject(Request $request)
    {
        $student_id = $request->student_id;
        $semester_id = $request->semester_id;
        $id = $request->id;
        $time = date("h:i:s d-m-Y");

        $credit = new Credit();
        $credit->student_id = $student_id;
        $credit->semester_id = $semester_id;
        $credit->type_id = $id;
        $credit->time = $time;

        if($credit->save()){
            $score = new Score();
            $score->id_student = $student_id;
            $score->id_type = $id;
            $score->id_semester = $semester_id;
            $score->session = 1;
            $score->active = 0;
            if($score->save()){
                return response()->json(['success' => 200]);
            };
        }
    }

    public function destroyProject(Request $request)
    {
        $student_id = $request->student_id;
        $semester_id = $request->semester_id;
        $id = $request->id;
        $result = Credit::findOrFail($id);
        if($result){
            Score::where('id_type',$result->type_id)->where('id_semester',$semester_id)->where('id_student',$student_id)->delete();
            $result->delete();
            return response()->json(['success' => 200]);
        }
    }
}
