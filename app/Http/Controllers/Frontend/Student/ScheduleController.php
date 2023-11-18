<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function showSchedule()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $day = strtolower(date('l'));
        $semester = session('semester_id');
        $student_id = session('student_id');

        $todays = Section::join('score','section.id','=','score.id_section')
        ->join('teacher','section.id_teacher','=','teacher.id')
        ->where('score.id_student',$student_id)
        ->where('score.id_semester',$semester)
        ->whereNotNull('section.'.$day)
        ->select('section.name AS name',
            'section.id AS section_id',
            'score.id AS id',
            'teacher.name AS teacher',
            'section.room AS room',
            'section.week AS week',
            'section.monday',
            'section.tuesday',
            'section.wednesday',
            'section.thursday',
            'section.friday',
            'section.saturday',
            'section.sunday')
        ->get();
        $results = [];
        foreach($todays as $today){
            $formatDay = [];
            if(!is_null($today->monday)){
                $formatDay[] = 'Hai / '.implode('->',json_decode($today->monday));
            }
            if(!is_null($today->tuesday)){
                $formatDay[] = 'Ba / '.implode('->',json_decode($today->tuesday));
            }
            if(!is_null($today->wednesday)){
                $formatDay[] = 'Tư / '.implode('->',json_decode($today->wednesday));
            }
            if(!is_null($today->thursday)){
                $formatDay[] = 'Năm / '.implode('->',json_decode($today->thursday));
            }
            if(!is_null($today->friday)){
                $formatDay[] = 'Sáu / '.implode('->',json_decode($today->friday));
            }
            if(!is_null($today->saturday)){
                $formatDay[] = 'Bảy / '.implode('->',json_decode($today->saturday));
            }
            if(!is_null($today->sunday)){
                $formatDay[] = 'Chủ nhật / '.implode('->',json_decode($today->sunday));
            }
            $result = [
                'id' => $today->section_id,
                'name' => $today->name,
                'teacher' => $today->teacher,
                'week' => $today->week,
                'room' => $today->room,
                'sections' => $formatDay
            ];
            $results[] = $result;
        }

        $today_id = $todays->pluck('id')->toArray();

        $sections = Section::join('score','section.id','=','score.id_section')
        ->join('teacher','section.id_teacher','=','teacher.id')
        ->where('score.id_student',$student_id)
        ->where('score.id_semester',$semester)
        ->whereNotIn('score.id',$today_id)
        ->select('section.name AS name',
            'section.id AS section_id',
            'teacher.name AS teacher',
            'section.room AS room',
            'section.week AS week',
            'section.monday',
            'section.tuesday',
            'section.wednesday',
            'section.thursday',
            'section.friday',
            'section.saturday',
            'section.sunday')
        ->get();
        $schedules = [];
        foreach($sections as $section){
            $formatDay = [];
            if(!is_null($section->monday)){
                $formatDay[] = 'Hai / '.implode('->',json_decode($section->monday));
            }
            if(!is_null($section->tuesday)){
                $formatDay[] = 'Ba / '.implode('->',json_decode($section->tuesday));
            }
            if(!is_null($section->wednesday)){
                $formatDay[] = 'Tư / '.implode('->',json_decode($section->wednesday));
            }
            if(!is_null($section->thursday)){
                $formatDay[] = 'Năm / '.implode('->',json_decode($section->thursday));
            }
            if(!is_null($section->friday)){
                $formatDay[] = 'Sáu / '.implode('->',json_decode($section->friday));
            }
            if(!is_null($section->saturday)){
                $formatDay[] = 'Bảy / '.implode('->',json_decode($section->saturday));
            }
            if(!is_null($section->sunday)){
                $formatDay[] = 'Chủ nhật / '.implode('->',json_decode($section->sunday));
            }
            $schedule = [
                'id' => $section->section_id,
                'name' => $section->name,
                'teacher' => $section->teacher,
                'week' => $section->week,
                'room' => $section->room,
                'sections' => $formatDay
            ];
            $schedules[] = $schedule;
        }

        return view('frontend.section.schedule',compact('results','schedules'));
    }

    public function detailSchedule(string $id)
    {
        return view('frontend.section.detail-schedule');
    }
}
