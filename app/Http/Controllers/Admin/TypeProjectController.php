<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Typeproject;
use Illuminate\Http\Request;

class TypeProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $branch, $semester)
    {
        $results = Typeproject::all();
        foreach($results as $type){
            $type['date_start'] = date('d-m-Y',strtotime($type->date_start));

            $types[] = $type;
        }
        
        return view('admin.type-project.index',compact('types','branch','semester'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $branch, $semester)
    {
        return view('admin.type-project.add',compact('branch','semester'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if(Typeproject::create($data)){
            return redirect()->back()->with('success','Thêm loại đồ án thành công');
        }else{
            return redirect()->back()->withErrors('Thêm loại đồ án thất bại');
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
