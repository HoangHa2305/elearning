<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\MailNotify;
use App\Models\ForgotPassword;
use App\Models\Notice;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $notices = Notice::limit(3)->get();
        return view('frontend.index',compact('notices'));
    }

    public function detailNotice(string $id)
    {
        $notice = Notice::findOrFail($id);

        return view('frontend.detailnotice',compact('notice'));
    }

    public function setSemester(string $id)
    {
        
    }

    public function dowloadTopic(string $name)
    {
        $path = storage_path('app/public/documents/'.$name);

        return response()->download($path);
    }

    public function forgotPassword(string $type)
    {
        return view('frontend.member.forgotpassword',compact('type'));
    }

    public function confirmEmail(Request $request)
    {
        $type = $request->type;
        $email = $request->email;

        if($email==""){
            return response()->json(['errors'=>'Email không được bỏ trống']);
        }else{
            if($type==1){
                $student = Student::where('email',$email)->first();
                if($student){
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

                        session()->put('email',$email);
                        session()->put('type',$type);
                        return response()->json(['status'=>200]);
                    }catch(Exception $th){
                        return response()->json(['errors'=>404]);
                    }
                }else{
                    return response()->json(['errors'=>'Email không tồn tại']);
                }
            }elseif($type==2){
                $teacher = Teacher::where('email',$email)->first();
                if($teacher){
                    $code = substr($teacher->id*1000000+time(),-6);
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

                        session()->put('email',$email);
                        session()->put('type',$type);
                        return response()->json(['status'=>200]);
                    }catch(Exception $th){
                        return response()->json(['errors'=>404]);
                    }
                }else{
                    return response()->json(['errors'=>'Email không tồn tại']);
                }
            }
        }
    }

    public function checkOtp(Request $request)
    {
        $email = $request->email;
        $pin = $request->pin;
        $url = "/elearning/mat-khau-moi";

        $check = ForgotPassword::where('email',$email)->latest()->first();
        $confirm = $check->code;

        if($confirm == $pin){
            $result = ForgotPassword::where('email',$email)->delete();
            return response()->json(['url'=>$url]);
        }else{
            return response()->json(['errors'=>404]);
        }
    }

    public function newPassword()
    {
        return view('frontend.member.newpassword');
    }

    public function postNewPassword(Request $request)
    {
        $email = session()->get('email');
        $type = session()->get('type');
        $password = $request->password;
        $confirm_password = $request->confirm_password;

        if($password == "" || $confirm_password == ""){
            return redirect()->back()->withErrors('Mật khẩu hoặc xác nhận mật khẩu không được để trống');
        }else{
            if($password == $confirm_password){
                if($type==1){
                    $student = Student::where('email',$email)->first();
                    $student->password = bcrypt($password);
                    $student->save();
        
                    return redirect()->back()->with('success','Mật khẩu mới được đặt thành công');
                }elseif($type==2){
                    $teacher = Teacher::where('email',$email)->first();
                    $teacher->password = bcrypt($password);
                    $teacher->save();

                    return redirect()->back()->with('success','Mật khẩu mới được đặt thành công');
                }
            }else{
                return redirect()->back()->withErrors('Mật khẩu và xác nhận mật khẩu không trùng khớp');
            }   
        }
    }
}
