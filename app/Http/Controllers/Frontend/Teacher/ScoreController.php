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

    public function postScore(Request $request)
    {
        $section_id = $request->section_id;
        $attendance_score = $request->attendance_score;
        $homework_score = $request->homework_score;
        $midterm_score = $request->midterm_score;
        $final_score = $request->final_score;
        if($attendance_score){
            foreach($attendance_score as $attendance){
                $attendance = explode('-',$attendance);
                $score = Score::where('id_student',$attendance[0])->where('id_section',$section_id)->first();
                $score->diligence_score = $attendance[1];
                $score->save();
            }
        }
        if($homework_score){
            foreach($homework_score as $homework){
                $homework = explode('-',$homework);
                $score = Score::where('id_student',$homework[0])->where('id_section',$section_id)->first();
                $score->homework_score = $homework[1];
                $score->save();             
            }
        }
        if($midterm_score){
            foreach($midterm_score as $midterm){
                $midterm = explode('-',$midterm);
                $score = Score::where('id_student',$midterm[0])->where('id_section',$section_id)->first();
                $score->midterm_score = $midterm[1];
                $score->save();
            }
        }
        if($final_score){
            foreach($final_score as $final){
                $final = explode('-',$final);
                $score = Score::where('id_student',$final[0])->where('id_section',$section_id)->first();
                $score->final_score = $final[1];
                $score->save();
            }
        }
        if($attendance_score && $homework_score && $midterm_score && $final_score){
            foreach($attendance_score as $attendance){
                $attendance = explode('-',$attendance);
                $score = Score::where('id_student',$attendance[0])->where('id_section',$section_id)->first();
                $total_score = $score->attendance_score * 1 + $score->homework_score * 2 + $score->midterm_score * 2 + $score->final_score * 5;
                $sum_t10_score = $total_score/10;
                $score->sum_t10_score = $sum_t10_score;
                if($sum_t10_score > 8.5){
                    $score->sum_t10_score = 4;
                }elseif($sum_t10_score >= 7 && $sum_t10_score <= 8.4){
                    $score->sum_t10_score = 3;
                }elseif($sum_t10_score >= 5.5 && $sum_t10_score <= 6.9){
                    $score->sum_t10_score = 2;
                }elseif($sum_t10_score >= 4 && $sum_t10_score <= 5.4){
                    $score->sum_t10_score = 1;
                }else{
                    $score->sum_t10_score = 0;
                }
                $score->active = 1;
                $score->save();
            }
        }
        return redirect()->back();
    }
}
