<?php

namespace App\Http\Controllers\Frontend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Score;
use App\Models\Section;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function showListScore()
    {
        $teacher_id = session('teacher_id');
        $semester_id = session('semester_id');
        $sections = Section::join('subject','section.id_subject','=','subject.id')
        ->select('section.name AS name',
                'section.id AS id')
        ->where('section.id_teacher',$teacher_id)
        ->where('subject.semester_id',$semester_id)
        ->get();
        return view('frontend.teacher.listscore',compact('sections'));
    }

    public function manageScore(string $id)
    {
        $absent = [];
        $semester_id = session('semester_id');
        $section = Section::findOrFail($id);
        $items = Score::where('id_section',$id)->where('id_semester',$semester_id)->get();
        $attendances = Attendance::where('id_section',$id)->get();
        foreach($attendances as $attendance){
            if(isset($attendance->absent)){
                $absent = array_merge($absent,json_decode($attendance->absent));
            }
        }
        return view('frontend.teacher.managescore',compact('section','items','absent'));
    }

    public function importScore(Request $request)
    {
        $semester_id = session('semester_id');

        $student_id = $request->student_id;
        $section_id = $request->section_id;
        $homework_score = $request->homework_score;
        $midterm_score = $request->midterm_score;
        $final_score = $request->final_score;
        $attendance_score = $request->attendance_score;
        $total_score = $request->total_score;

        $score = Score::where('id_student',$student_id)
                        ->where('id_section',$section_id)
                        ->where('id_semester',$semester_id)
                        ->first();
        if($attendance_score){
            $score->diligence_score = $attendance_score;
        }
        if($homework_score){
            $score->homework_score = $homework_score;
        }
        if($midterm_score){
            $score->midterm_score = $midterm_score;
        }
        if($final_score){
            $score->final_score = $final_score;
        }
        if($total_score){
            if($total_score >= 8.5){
                $sum_t4_score = 4;
            }elseif($total_score >= 7 && $total_score <= 8.4){
                $sum_t4_score = 3;
            }elseif($total_score >= 5.5 && $total_score <= 6.9){
                $sum_t4_score = 2;
            }elseif($total_score >= 4 && $total_score <= 5.4){
                $sum_t4_score = 1;
            }else{
                $sum_t4_score = 0;
            }		
            $score->sum_t10_score = $total_score;
            $score->sum_t4_score = $sum_t4_score;
        }
        $score->save();
    }

    public function postScore(Request $request)
    {
        $semester_id = session('semester_id');
        $section_id = $request->section_id;

        $scores = Score::where('id_section',$section_id)->where('id_semester',$semester_id)->get();

        foreach($scores as $score){
            $result = Score::findOrFail($score->id);
            $result->active = 1;
            $result->save();
        }
        
        return redirect()->back();
    }
}
