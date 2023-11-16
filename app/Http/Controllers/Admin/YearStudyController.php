<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\YearStudy;
use Illuminate\Http\Request;

class YearStudyController extends Controller
{
    public function create()
    {
        return view('admin.year-study.add');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if(YearStudy::create($data)){
            return redirect()->back()->with('success','Thêm năm học thành công');
        }else{
            return redirect()->back()->withErrors('Thêm năm học thất bại');
        }
    }

    public function index()
    {
        $yearstudies = YearStudy::all();
        return view('admin.year-study.index',compact('yearstudies'));
    }
}
