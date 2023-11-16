<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Faculty;
use App\Models\YearTrain;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $branchs = Branch::where('yeartrain_id',$id)->get();
        return view('admin.branch.index',compact('branchs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = Faculty::all();
        return view('admin.branch.add',compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if(Branch::create($data)){
            return redirect()->back()->with('success','Thêm ngành đào tạo thành công');
        }else{
            return redirect()->back()->withErrors('Thêm ngành đào tạo thất bại');
        }
    }

    public function getYeartrain(string $id)
    {
        $yeartrains = YearTrain::where('faculty_id',$id)->get();
        return $yeartrains;
    }

    public function postYeartrain(Request $request)
    {
        $id = $request->id;
        $yeartrains = YearTrain::where('faculty_id',$id)->get();
        return $yeartrains;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Branch::where('id',$id)->delete();
        if($data){
            return redirect()->back()->with('success','Xóa ngành đào tạo thành công');
        }else{
            return redirect()->back()->withErrors('Xóa ngành đào tạo thất bại');
        }
    }
}
