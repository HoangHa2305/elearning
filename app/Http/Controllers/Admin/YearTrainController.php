<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\YearTrain;
use Illuminate\Http\Request;

class YearTrainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $faculty = Faculty::findOrFail($id);
        $yeartrains = YearTrain::where('faculty_id',$id)->get();
        return view('admin.year-train.index',compact('yeartrains','faculty'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = Faculty::all();
        return view('admin.year-train.add',compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if(YearTrain::create($data)){
            return redirect()->back()->with('success','Thêm niên khóa đào tạo thành công');
        }else{
            return redirect()->back()->withErrors('Thêm niên khóa đào tạo thất bại');
        }
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
        //
    }
}
