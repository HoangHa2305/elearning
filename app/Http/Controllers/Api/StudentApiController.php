<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\MailNotify;
use App\Models\ForgotPassword;
use App\Models\Score;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
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

        $student = Student::where('email',$email)->first();
        $student['birth'] = date('d/m/Y',strtotime($student->birth));
        $student['class'] = $student->activity_class->code;
        $student['branch'] = $student->get_branch->name;
        if($student->sex == 0){
            $student['sex'] = "Nam";
        }else{
            $student['sex'] = "Nữ";
        }
        $semester_id = Semester::orderBy('id','desc')->first();
        if($student && Hash::check($password,$student->password)){
            return response()->json([
                'status' => 200,
                'student' => $student,
                'semester_id' => $semester_id->id
            ]);
        }else{
            return response()->json(['errors' => 'Đăng nhập thất bại']);
        }
    }

    public function checkEmail(Request $request)
    {
        $data = $request->json()->all();
        $email = $data['email'];

        $check = Student::where('email',$email)->first();
        if($check){
            return response()->json(['status'=>200]);
        }else{
            return response()->json(['errors'=>404]);
        }
    }

    public function sendMail(Request $request)
    {
        $email = $request->email;

        $student = Student::where('email',$email)->first();
        $code = substr($student->id*1000000+time(),-6);
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

        $student = Student::where('email',$email)->first();
        $student->password = bcrypt($new_password);
        if($student->save()){
            return response()->json(['status'=>400]);
        }else{
            return response()->json(['errors'=>404]);
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
}
