<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        
    }

    public function create()
    {
        return view('admin.notice.add');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['date'] = date('d-m-Y');
        $data['active'] = 0;

        $file = $request->file('zip');
        if($file){
            $file_name = time().'-notice'.'.docx';
            $data['zip'] = $file_name;
        }
        if(Notice::create($data)){
            if(isset($file)){
                $file->storeAs('documents',$file_name,'public');
                return redirect()->back()->with('success','Đăng thông báo thành công');
            }
        }else{
            return redirect()->back()->withErrors('Đăng thông báo thất bại');
        }
    }
}
