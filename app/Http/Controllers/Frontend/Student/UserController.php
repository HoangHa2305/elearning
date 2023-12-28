<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\Group;
use App\Models\RateSubject;
use App\Models\Report;
use App\Models\Score;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Tution;
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

    public function showRate(string $id)
    {
        $section = Section::findOrFail($id);
        return view('frontend.member.ratesubject',compact('section'));
    }

    public function postRate(string $id, Request $request)
    {
        $semester_id = session('semester_id');
        $student_id = session('student_id');

        $about_section = ($request->section1 + $request->section2 + $request->section3 + $request->section4) / 4;
        $about_teaching = ($request->teaching1 + $request->teaching2 + $request->teaching3 
                        + $request->teaching4 + $request->teaching5 + $request->teaching6) / 6;

        $result = RateSubject::create([
            'id_section' => $id,
            'id_semester' => $semester_id,
            'id_student' => $student_id,
            'about_section' => $about_section,
            'about_teaching' => $about_teaching,
            'about_content_section' => $request->about_content_section,
            'about_curriculum' => $request->about_curriculum
        ]);
        $score = Score::where('id_section',$id)->where('id_student',$student_id)->where('id_semester',$semester_id)->first();
        $score->active = 3;
        $score->save();
        if($result){
            return redirect('sv/diem');
        }
    }

    public function showNecessary(string $id)
    {
        $section = Section::findOrFail($id);
        $semester = $section->subject->semester->name;
        return view('frontend.member.necessary',compact('semester','section'));
    }

    public function postNecessary(string $id, Request $request)
    {
        $semester_id = session('semester_id');
        $student_id = session('student_id');

        $rate = RateSubject::where('id_section',$id)->where('id_semester',$semester_id)->where('id_student',$student_id)->first();
        $rate->necessary = $request->necessary;
        if($request->feedback){
            $rate->feedback = $request->feedback;
        }
        if($rate->save()){
            $score = Score::where('id_section',$id)->where('id_student',$student_id)->where('id_semester',$semester_id)->first();
            $score->active = 4;
            $score->save();
            return redirect()->route('sv.diem',compact('rate'));
        }
    }

    public function historyTution()
    {
        $student_id = session('student_id');
        $tutions = Tution::where('id_student',$student_id)->get();

        return view('frontend.member.historytution',compact('tutions'));
    }

    public function showTuition()
    {
        $semester_id = session('semester_id');
        $student_id = session('student_id');

        $sections = Score::where('id_student',$student_id)->where('id_section','!=',null)->where('id_semester',$semester_id)->get();

        $projects = Score::join('type_project','score.id_type','=','type_project.id')
                    ->join('subject','subject.id','=','type_project.id_subject')
                    ->select('type_project.title AS title',
                            'score.session AS session',
                            'subject.credits AS credits')
                    ->where('score.id_student',$student_id)
                    ->where('score.id_semester',$semester_id)
                    ->where('score.id_type','!=',null)
                    ->get();
        $tutions = Tution::where('id_student',$student_id)->where('id_semester',$semester_id)->get();
        return view('frontend.member.tuition',compact('sections','projects','tutions'));
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
        $semester_id = session('semester_id');
        $student_id = session('student_id');

        $code = date('m').'/'.date('Y').'-HP-Agribank';
        $semester = Semester::findOrFail($semester_id);
        
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

        $tution = new Tution();
        $tution->id_student = $student_id;
        $tution->id_semester = $semester_id;
        $tution->code = $code;
        $tution->desc = 'Thu học phí '.$semester->name.' năm học '.$semester->get_yearstudy->name;
        $tution->total = $request->total;
        $tution->date = date('d/m/Y');
        $tution->collector = 'Bank Agribank';
        $tution->save();
        //Just a example, please check more in there
        return redirect()->to($jsonResult['payUrl']);
        // header('Location: ' . $jsonResult['payUrl']);
    }

    public function payment_success()
    {
        return view('frontend.layouts.success');
    }

}
