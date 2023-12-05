<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\Group;
use App\Models\Report;
use App\Models\Score;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Typeproject;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        
        $student = Student::where('email',$email)->first();

        if($student && Hash::check($password,$student->password)){
            if(session('teacher_id')){
                session()->forget('teacher_id');
            }
            $request->session()->put('student_id',$student->id);
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

    public function logout()
    {
        if(session('student_id')){
            session()->forget('student_id');
        }
        if(session('teacher_id')){
            session()->forget('teacher_id');
        }
        return redirect()->route('index');
    }

    public function showProfile()
    {
        $student_id = session('student_id');
        $student = Student::findOrFail($student_id);
        return view('frontend.member.profile',compact('student'));
    }

    public function showRegistration()
    {
        $student_id = session('student_id');
        $semester_id = session('semester_id');
        $student = Student::findOrFail($student_id);
        $yeartrain_id = $student->get_yeartrain->id;
        $datas = [];
        $credits = Credit::where('student_id',$student_id)->where('semester_id',$semester_id)->where('section_id','!=',null)->get();
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
                $name = Teacher::findOrFail($teacher);
            }
            $datas[] = [
                'title' => $type->title,
                'code' => $type->code,
                'id' => $type->id,
                'type_id' => $type->type_id,
                'teacher' => $name->name,
                'credit' => $type->credit
            ];
        }
        $projects = Subject::join('type_project','subject.id','=','type_project.id_subject')
                    ->select('type_project.title AS name',
                            'type_project.id AS id',
                            'subject.code AS code',
                            'subject.credits AS credit')
                    ->where('subject.semester_id',$semester_id)
                    ->where('subject.yeartrain_id',$yeartrain_id)
                    ->where('subject.group',1)
                    ->get();
        $groups = Group::where('branch_id',$student->branch_id)->where('semester_id',$semester_id)->where('active',1)->get();
        $results = [];
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
                $output .= "T.Hai ".$monday[0].'->'.$monday[count($monday)-1]."<br>";
            }
            if($tuesday){
                $output .= "T.Ba ".$tuesday[0].'->'.$tuesday[count($tuesday)-1]."<br>";
            }
            if($wednesday){
                $output .= "T.Tư ".$wednesday[0].'->'.$wednesday[count($wednesday)-1]."<br>";
            }
            if($thursday){
                $output .= "T.Năm ".$thursday[0].'->'.$thursday[count($thursday)-1]."<br>";
            }
            if($friday){
                $output .= "T.Sáu ".$friday[0].'->'.$friday[count($friday)-1]."<br>";
            }
            if($saturday){
                $output .= "T.Bảy ".$saturday[0].'->'.$saturday[count($saturday)-1]."<br>";
            }
            if($sunday){
                $output .= "C.Nhật ".$sunday[0].'->'.$sunday[count($sunday)-1]."<br>";
            }

            $results[] = [
                'id' => $credit->id,
                'code' => $credit->section->code,
                'name' => $credit->section->name,
                'credit' => $credit->section->subject->credits,
                'teacher' => $credit->section->teacher->name,
                'desc' => $output,
                'week' => $credit->section->week,
            ];
        }
        return view('frontend.section.register',compact('groups','results','projects','datas'));
    }

    public function getSection(Request $request)
    {
        $id = $request->id;
        $type = $request->type;
        if($type==0){
            $student_id = session('student_id');
            $semester_id = session('semester_id');
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
                $alert = '';
                foreach($credits as $credit){
                    if($credit->section->subject->id == $section->subject->id){
                        $alert = "<div class='custom-danger'><p>Đã đăng kí</p></div>";
                    }
                }
                
                if($monday){
                    $output .= "T.Hai ".$monday[0].'->'.$monday[count($monday)-1]."<br>";
                }
                if($tuesday){
                    $output .= "T.Ba ".$tuesday[0].'->'.$tuesday[count($tuesday)-1]."<br>";
                }
                if($wednesday){
                    $output .= "T.Tư ".$wednesday[0].'->'.$wednesday[count($wednesday)-1]."<br>";
                }
                if($thursday){
                    $output .= "T.Năm ".$thursday[0].'->'.$thursday[count($thursday)-1]."<br>";
                }
                if($friday){
                    $output .= "T.Sáu ".$friday[0].'->'.$friday[count($friday)-1]."<br>";
                }
                if($saturday){
                    $output .= "T.Bảy ".$saturday[0].'->'.$saturday[count($saturday)-1]."<br>";
                }
                if($sunday){
                    $output .= "C.Nhật ".$sunday[0].'->'.$sunday[count($sunday)-1]."<br>";
                }
                $result[] = [
                    'id' => $section->id,
                    'name' => $section->name,
                    'credits' => $section->subject->credits,
                    'register' => $section->register,
                    'count' => $section->count,
                    'week' => $section->week,
                    'teacher' => $section->teacher->name,
                    'desc' => $output,
                    'alert' => $alert
                ];
            }
        }else{
            $projects = Typeproject::join('subject','type_project.id_subject','=','subject.id')
                    ->select('type_project.title AS title',
                            'type_project.id AS id',
                            'subject.teacher AS teacher')
                    ->where('type_project.id',$id)
                    ->get();
            $result = [];
            foreach($projects as $project){
                $item['id'] = $project->id;
                $item['title'] = $project->title;
                $teachers = json_decode($project->teacher);
                foreach($teachers as $teacher){
                    $teacher_id = intval($teacher);
                    $name = Teacher::findOrFail($teacher_id);
                    $item['teacher'] = $name->name;
                }

                $result[] = $item;
            }
        }
        
        return $result;
    }

    public function postRegistration(Request $request)
    {
        $student_id = session('student_id');
        $semester_id = session('semester_id');
        $time = date("h:i:s d-m-Y");
        $sections = $request->section_id;
        
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
        return redirect()->back();
    }

    public function registerCredits(string $id)
    {
        $student_id = session('student_id');
        $semester_id = session('semester_id');
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
                return redirect()->back();
            };
        }
    }

    public function creditProject(string $id)
    {
        $student_id = session('student_id');
        $semester_id = session('semester_id');
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
                return redirect()->back();
            };
        }
    }

    public function destroyCredits(string $id)
    {
        $student_id = session('student_id');
        $semester_id = session('semester_id');
        $result = Credit::findOrFail($id);
        if($result){
            Section::where('id',$result->section_id)->decrement('register');
            Score::where('id_section',$result->section_id)->where('id_semester',$semester_id)->where('id_student',$student_id)->delete();
            $result->delete();
            return redirect()->back();
        }
    }

    public function destroyCreditProject(string $id)
    {
        $student_id = session('student_id');
        $semester_id = session('semester_id');
        $result = Credit::findOrFail($id);
        if($result){
            Score::where('id_type',$result->type_id)->where('id_semester',$semester_id)->where('id_student',$student_id)->delete();
            $result->delete();
            return redirect()->back();
        }
    }

    public function showResult()
    {
        $semester_id = session('semester_id');
        $student_id = session('student_id');
        $scores = Score::where('id_student',$student_id)->where('id_section','!=',null)->get();
        $semesters = Semester::all();

        $projects = Score::join('type_project','score.id_type','=','type_project.id')
                    ->join('subject','subject.id','=','type_project.id_subject')
                    ->select('type_project.title AS title',
                            'score.id_semester AS id_semester',
                            'score.session AS session',
                            'score.diligence_score AS diligence_score',
                            'subject.credits AS credits')
                    ->where('score.id_student',$student_id)
                    ->where('score.id_type','!=',null)
                    ->get();
        return view('frontend.member.result',compact('semesters','scores','projects'));
    }

    public function showCalendar()
    {
        $date = date('N');
        switch($date){
            case 1:
                $date = 'Thứ Hai';
                break;
            case 2:
                $date = 'Thứ Ba';
                break;
            case 3:
                $date = 'Thứ Tư';
                break;
            case 4:
                $date = 'Thứ Năm';
                break;
            case 5:
                $date = 'Thứ Sáu';
                break;
            case 6:
                $date = 'Thứ Bảy';
                break;
            default:
                $date = 'Chủ nhật';
        }
        $day = strtotime('this week');

        $semester_id = session('semester_id');
        $student_id = session('student_id');

        $todays = Section::join('score','section.id','=','score.id_section')
        ->where('score.id_student',$student_id)
        ->where('score.id_semester',$semester_id)
        ->select('section.name AS name',
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
        $calendars = [];
        foreach($todays as $today){
            $monday = [];
            $tuesday = [];
            $wednesday = [];
            $thursday = [];
            $friday = [];
            $saturday = [];
            $sunday = [];
            if(!is_null($today->monday)){
                $monday = json_decode($today->monday); 
            }
            if(!is_null($today->tuesday)){
                $tuesday = json_decode($today->tuesday); 
            }
            if(!is_null($today->wednesday)){
                $wednesday = json_decode($today->wednesday); 
            }
            if(!is_null($today->thursday)){
                $thursday = json_decode($today->thursday); 
            }
            if(!is_null($today->friday)){
                $friday = json_decode($today->friday); 
            }
            if(!is_null($today->saturday)){
                $saturday = json_decode($today->saturday); 
            }
            if(!is_null($today->sunday)){
                $sunday = json_decode($today->sunday); 
            }
            $calendar = [
                'name' => $today->name,
                'room' => $today->room,
            ];
            if(!is_null($today->monday)){
                $calendar['monday'] = $monday;
            }
            if(!is_null($today->tuesday)){
                $calendar['tuesday'] = $tuesday; 
            }
            if(!is_null($today->wednesday)){
                $calendar['wednesday'] = $wednesday; 
            }
            if(!is_null($today->thursday)){
                $calendar['thursday'] = $thursday; 
            }
            if(!is_null($today->friday)){
                $calendar['friday'] = $friday; 
            }
            if(!is_null($today->saturday)){
                $calendar['saturday'] = $saturday;
            }
            if(!is_null($today->sunday)){
                $calendar['sunday'] = $sunday; 
            }
            $calendars[] = $calendar;
        }
        $semester = Semester::findOrFail($semester_id);
        $start = DateTime::createFromFormat('Y-m-d',$semester->start);
        $end = DateTime::createFromFormat('Y-m-d',$semester->end);
        $at_moment = DateTime::createFromFormat('Y-m-d',date('Y-m-d'));
        $long_date = $start->diff($at_moment);
        $week = floor($long_date->days /7) + 1;
        return view('frontend.section.calendar',compact('date','day','calendars','week'));
    }

    public function nextCalendar(string $tuan)
    {
        $date = date('N');
        switch($date){
            case 1:
                $date = 'Thứ Hai';
                break;
            case 2:
                $date = 'Thứ Ba';
                break;
            case 3:
                $date = 'Thứ Tư';
                break;
            case 4:
                $date = 'Thứ Năm';
                break;
            case 5:
                $date = 'Thứ Sáu';
                break;
            case 6:
                $date = 'Thứ Bảy';
                break;
            default:
                $date = 'Chủ nhật';
        }

        $semester_id = session('semester_id');
        $student_id = session('student_id');

        $semester = Semester::findOrFail($semester_id);
        $start = DateTime::createFromFormat('Y-m-d',$semester->start);
        $end = DateTime::createFromFormat('Y-m-d',$semester->end);
        $at_moment = DateTime::createFromFormat('Y-m-d',date('Y-m-d'));
        $long_date = $start->diff($at_moment);
        $week = floor($long_date->days /7) + 1;

        $day = Carbon::now();
        if($tuan > $week){
            $day = $day->startOfWeek()->addWeeks($tuan-$week);
            $day = strtotime($day);
            
        }elseif($tuan == $week){
            $day = strtotime("this week");
        }else{
            $day = $day->startOfWeek()->subWeeks($week-$tuan);
            $day = strtotime($day);
        }
        
        $week = $tuan;

        $todays = Section::join('score','section.id','=','score.id_section')
        ->where('score.id_student',$student_id)
        ->where('score.id_semester',$semester_id)
        ->select('section.name AS name',
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
        $calendars = [];
        foreach($todays as $today){
            $monday = [];
            $tuesday = [];
            $wednesday = [];
            $thursday = [];
            $friday = [];
            $saturday = [];
            $sunday = [];
            if(!is_null($today->monday)){
                $monday = json_decode($today->monday); 
            }
            if(!is_null($today->tuesday)){
                $tuesday = json_decode($today->tuesday); 
            }
            if(!is_null($today->wednesday)){
                $wednesday = json_decode($today->wednesday); 
            }
            if(!is_null($today->thursday)){
                $thursday = json_decode($today->thursday); 
            }
            if(!is_null($today->friday)){
                $friday = json_decode($today->friday); 
            }
            if(!is_null($today->saturday)){
                $saturday = json_decode($today->saturday); 
            }
            if(!is_null($today->sunday)){
                $sunday = json_decode($today->sunday); 
            }
            $calendar = [
                'name' => $today->name,
                'room' => $today->room,
            ];
            if(!is_null($today->monday)){
                $calendar['monday'] = $monday;
            }
            if(!is_null($today->tuesday)){
                $calendar['tuesday'] = $tuesday; 
            }
            if(!is_null($today->wednesday)){
                $calendar['wednesday'] = $wednesday; 
            }
            if(!is_null($today->thursday)){
                $calendar['thursday'] = $thursday; 
            }
            if(!is_null($today->friday)){
                $calendar['friday'] = $friday; 
            }
            if(!is_null($today->saturday)){
                $calendar['saturday'] = $saturday;
            }
            if(!is_null($today->sunday)){
                $calendar['sunday'] = $sunday; 
            }
            $calendars[] = $calendar;
        }
        
        return view('frontend.section.calendar',compact('date','day','calendars','week'));
    }

    public function showTuition()
    {
        $semester_id = session('semester_id');
        $student_id = session('student_id');

        $sections = Score::where('id_student',$student_id)->where('id_semester',$semester_id)->get();
        return view('frontend.member.tuition',compact('sections'));
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function payment_momo(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        $amount = $request->total;
        $orderId = time() ."";
        $redirectUrl = "http://localhost/elearning/public/sv/hoc-phi-sap-nop";
        $ipnUrl = "http://localhost/elearning/public/sv/hoc-phi-sap-nop";
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        //Just a example, please check more in there
        return redirect()->to($jsonResult['payUrl']);
        // header('Location: ' . $jsonResult['payUrl']);
    }

    public function payment_success()
    {
        return view('frontend.layouts.success');
    }

}
