<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function showProject()
    {
        $semester_id = session('semester_id');
        $student_id = session('student_id');
        $reports = Report::join('group_project','reports.id_group','=','group_project.id')
                ->join('type_project','group_project.id_type','=','type_project.id')
                ->join('teacher','group_project.id_teacher','=','teacher.id')
                ->select('group_project.title AS title',
                        'teacher.name AS name_teacher',
                        'teacher.level AS level_teacher'
                        )
                ->where('reports.id_student',$student_id)
                ->where('type_project.id_semester',$semester_id)
                ->get();
        return view('frontend.member.project',compact('reports'));
    }
}
