<?php

namespace App\Http\Controllers\Frontend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\GroupProject;
use App\Models\Report;
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
        return view('frontend.teacher.detailreport',compact('report'));
    }

    public function confirmTopic(Request $request)
    {
        $id = $request->id;

        $report = Report::findOrFail($id);
        $report->confirm = 1;
        $report->save();

        return response()->json(['success'=>400]);
    }

    public function manageProjectScore(string $id)
    {

    }
}
