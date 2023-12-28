<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Score;
use App\Models\Section;
use App\Models\Semester;
use App\Models\YearStudy;
use App\Models\YearTrain;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id, $year, $semester)
    {
        $groups = Group::where('branch_id',$id)->where('semester_id',$semester)->get();
        return view('admin.group.index',compact('groups','id','year','semester'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id, $year, $semester)
    {
        $branch = Branch::findOrFail($id);
        $semester = Semester::findOrFail($semester);
        return view('admin.group.add',compact('branch','year','semester'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        if(Group::create($data)){
            return redirect()->back()->with('success','Thêm nhóm học phần thành công');
        }else{
            return redirect()->back()->withErrors('Thêm nhóm học phần thất bại');
        }
    }

    public function getFaculty()
    {
        $faculties = Faculty::all();
        return view('admin.group.faculty',compact('faculties'));
    }

    public function getYearTrain(string $id)
    {
        $faculty = Faculty::findOrFail($id);
        $yeartrains = YearTrain::where('faculty_id',$id)->get();
        return view('admin.group.yeartrain',compact('yeartrains','faculty'));
    }

    public function getBranch(string $id)
    {
        $branchs = Branch::where('yeartrain_id',$id)->get();
        return view('admin.group.branch',compact('branchs'));
    }

    public function getYearStudy(string $id)
    {
        $yearstudies = YearStudy::all();
        return view('admin.group.yearstudy',compact('yearstudies','id'));
    }

    public function getSemester(string $id ,$year)
    {
        $semesters = Semester::where('year',$year)->get();
        return view('admin.group.semester',compact('semesters','id','year'));
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
    public function getSubject(string $id)
    {
        $group = Group::findOrFail($id);
        $sections = Section::where('id_group',$id)->get();
        return view('admin.group.subject',compact('sections','group'));
    }

    public function manageScore(string $id)
    {
        $section = Section::findOrFail($id);
        $scores = Score::join('section','score.id_section','=','section.id')
                ->join('student','score.id_student','=','student.id')
                ->join('class','student.class_id','=','class.id')
                ->select('score.id AS id',
                        'student.code AS code',
                        'student.name AS name',
                        'class.code AS class',
                        'score.diligence_score AS diligence_score',
                        'score.homework_score AS homework_score',
                        'score.midterm_score AS midterm_score',
                        'score.final_score AS final_score',
                        'score.sum_t10_score AS sum_t10_score',
                        'score.sum_t4_score AS sum_t4_score')
                ->where('score.id_section',$id)
                ->get();
        return view('admin.group.score',compact('scores','section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function confirmScore(Request $request, string $id)
    {
        $semester_id = session('semester_id');
        $type = $request->type;

        $scores = Score::where('id_section',$id)->where('id_semester',$semester_id)->get();

        foreach($scores as $score){
            $result = Score::findOrFail($score->id);
            if($type==2){
                $result->active = 2;
            }
            $result->save();
        }
        
        return redirect()->back();
    }

    public function cancelConfirm(string $id)
    {
        $semester_id = session('semester_id');

        $scores = Score::where('id_section',$id)->where('id_semester',$semester_id)->get();

        foreach($scores as $score){
            $result = Score::findOrFail($score->id);
            $result->active = 0;
            $result->save();
        }
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
