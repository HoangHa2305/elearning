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

    public function showTuition()
    {
        $semester_id = session('semester_id');
        $student_id = session('student_id');

        $sections = Score::where('id_student',$student_id)->where('id_section','!=',null)->where('id_semester',$semester_id)->get();
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
