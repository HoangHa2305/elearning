<?php

namespace App\Http\Controllers\Frontend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\GroupProject;
use App\Models\Report;
use App\Models\Score;
use App\Models\Typeproject;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function showManageProject()
    {
        $teacher_id = session('teacher_id');
        $semester_id = session('semester_id');

        $projects = Typeproject::join('group_project','type_project.id','=','group_project.id_type')
                    ->join('subject','type_project.id_subject','=','subject.id')
                    ->select('group_project.title AS title',
                            'group_project.id AS group_id',
                            'type_project.id AS type_id',
                            'subject.name AS subject')
                    ->where('group_project.id_teacher',$teacher_id)
                    ->where('type_project.id_semester',$semester_id)
                    ->get();
        return view('frontend.teacher.project',compact('projects'));
    }

    public function manageReport(string $id)
    {
        $group = GroupProject::findOrFail($id);
        $projects = GroupProject::join('reports','group_project.id','=','reports.id_group')
                    ->join('student','reports.id_student','=','student.id')
                    ->select('student.code AS code',
                            'student.name AS name',
                            'reports.id AS id',
                            'reports.title AS title')
                    ->where('group_project.id',$id)
                    ->where('reports.parent',0)
                    ->get();
        $parents = Report::where('id_group',$id)->where('parent','!=',0)->get();
        return view('frontend.teacher.managereport',compact('projects','group','parents'));
    }

    public function detailReport(string $id)
    {
        $report = Report::findOrFail($id);
        $parents = Report::where('parent','!=',0)->get();
        return view('frontend.teacher.detailreport',compact('report','parents'));
    }

    public function confirmTopic(Request $request)
    {
        $id = $request->id;
        $type = $request->type;

        $report = Report::findOrFail($id);
        if($type==1){
            $report->confirm = 1;
        }else{
            $report->confirm = 0;
        } 
        $report->save();

        return response()->json(['success'=>400]);
    }

    public function confirmReport(Request $request)
    {
        $id = $request->id;
        $type = $request->type;

        $report = Report::findOrFail($id);
        if($type==1){
            $report->status = 1;
        }else{
            $report->status = 0;
        } 
        $report->save();

        return response()->json(['success'=>400]);
    }

    public function manageProjectScore(string $id)
    {
        $group = GroupProject::findOrFail($id);
        $projects = GroupProject::join('type_project','group_project.id_type','=','type_project.id')
                    ->join('score','type_project.id','=','score.id_type')
                    ->join('student','score.id_student','=','student.id')
                    ->join('class','student.class_id','=','class.id')
                    ->select('student.name AS name',
                            'student.code AS code',
                            'student.id AS id',
                            'class.code AS class',
                            'type_project.id AS type_id',
                            'score.diligence_score AS diligence_score',
                            'score.final_score AS final_score'
                            )
                    ->where('score.id_type','!=',null)
                    ->where('group_project.id',$id)
                    ->get();
        return view('frontend.teacher.scoreproject',compact('projects','group'));
    }

    public function postScoreProject(Request $request)
    {
        $semester_id = session('semester_id');
        $diligence_score = $request->diligence_score;
        $final_score = $request->final_score;
        $sum_t10_score = $request->sum_t10_score;
        $id_student = $request->id_student;
        $id_type = $request->id_type;

        $score = Score::where('id_student',$id_student)
                        ->where('id_type',$id_type)
                        ->where('id_semester',$semester_id)
                        ->first();
        if($diligence_score){
            $score->diligence_score = $diligence_score;
        }
        if($final_score){
            $score->final_score = $final_score;
        }
        if($sum_t10_score){
            if($sum_t10_score >= 8.5){
                $sum_t4_score = 4;
            }elseif($sum_t10_score >= 7 && $sum_t10_score <= 8.4){
                $sum_t4_score = 3;
            }elseif($sum_t10_score >= 5.5 && $sum_t10_score <= 6.9){
                $sum_t4_score = 2;
            }elseif($sum_t10_score >= 4 && $sum_t10_score <= 5.4){
                $sum_t4_score = 1;
            }else{
                $sum_t4_score = 0;
            }		
            $score->sum_t10_score = $sum_t10_score;
            $score->sum_t4_score = $sum_t4_score;
        }
        $score->save();
    }
}
