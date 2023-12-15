<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Student;
use Carbon\Carbon;
use DateTime;
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
        $data = [];
        $section = Section::findOrFail($id);
        $attendances = Attendance::where('id_section',$id)->get();
        foreach($attendances as $attendance){
            $counts = json_decode($attendance->absent);
            $result['content'] = $attendance->content;
            $result['time'] = $attendance->time;
            $result['date'] = DateTime::createFromFormat('d/m/Y',$attendance->date);
            $result['date'] = $result['date']->format('Y-m-d');
            $value = [];
            if($counts){
                $counts = is_array($counts) ? $counts : [$counts];
                foreach($counts as $count){
                    $students = Student::whereIn('id',[$count])
                    ->select('name','code')
                    ->get();
                    foreach($students as $student){
                        $value[] = $student->name." - Mã SV: ".$student->code;
                    }
                }
            }
            $result['absent'] = $value;

            $data[] = $result;
        }
        return view('frontend.section.detail-schedule',compact('section','data'));
    }

    public function showCalendar()
    {
        $date = date('N');
        switch($date){
            case 1:
                $date = 'Thứ Hai';
                break;
            case 2:
                $date = 'Thứ Ba';
                break;
            case 3:
                $date = 'Thứ Tư';
                break;
            case 4:
                $date = 'Thứ Năm';
                break;
            case 5:
                $date = 'Thứ Sáu';
                break;
            case 6:
                $date = 'Thứ Bảy';
                break;
            default:
                $date = 'Chủ nhật';
        }
        $day = strtotime('this week');

        $semester_id = session('semester_id');
        $student_id = session('student_id');

        $todays = Section::join('score','section.id','=','score.id_section')
        ->where('score.id_student',$student_id)
        ->where('score.id_semester',$semester_id)
        ->select('section.name AS name',
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
        $calendars = [];
        foreach($todays as $today){
            $monday = [];
            $tuesday = [];
            $wednesday = [];
            $thursday = [];
            $friday = [];
            $saturday = [];
            $sunday = [];
            if(!is_null($today->monday)){
                $monday = json_decode($today->monday); 
            }
            if(!is_null($today->tuesday)){
                $tuesday = json_decode($today->tuesday); 
            }
            if(!is_null($today->wednesday)){
                $wednesday = json_decode($today->wednesday); 
            }
            if(!is_null($today->thursday)){
                $thursday = json_decode($today->thursday); 
            }
            if(!is_null($today->friday)){
                $friday = json_decode($today->friday); 
            }
            if(!is_null($today->saturday)){
                $saturday = json_decode($today->saturday); 
            }
            if(!is_null($today->sunday)){
                $sunday = json_decode($today->sunday); 
            }
            $calendar = [
                'name' => $today->name,
                'room' => $today->room,
            ];
            if(!is_null($today->monday)){
                $calendar['monday'] = $monday;
            }
            if(!is_null($today->tuesday)){
                $calendar['tuesday'] = $tuesday; 
            }
            if(!is_null($today->wednesday)){
                $calendar['wednesday'] = $wednesday; 
            }
            if(!is_null($today->thursday)){
                $calendar['thursday'] = $thursday; 
            }
            if(!is_null($today->friday)){
                $calendar['friday'] = $friday; 
            }
            if(!is_null($today->saturday)){
                $calendar['saturday'] = $saturday;
            }
            if(!is_null($today->sunday)){
                $calendar['sunday'] = $sunday; 
            }
            $calendars[] = $calendar;
        }
        $semester = Semester::findOrFail($semester_id);
        $start = DateTime::createFromFormat('Y-m-d',$semester->start);
        $end = DateTime::createFromFormat('Y-m-d',$semester->end);
        $at_moment = DateTime::createFromFormat('Y-m-d',date('Y-m-d'));
        $long_date = $start->diff($at_moment);
        $week = floor($long_date->days /7) + 1;
        return view('frontend.section.calendar',compact('date','day','calendars','week'));
    }

    public function nextCalendar(string $tuan)
    {
        $date = date('N');
        switch($date){
            case 1:
                $date = 'Thứ Hai';
                break;
            case 2:
                $date = 'Thứ Ba';
                break;
            case 3:
                $date = 'Thứ Tư';
                break;
            case 4:
                $date = 'Thứ Năm';
                break;
            case 5:
                $date = 'Thứ Sáu';
                break;
            case 6:
                $date = 'Thứ Bảy';
                break;
            default:
                $date = 'Chủ nhật';
        }

        $semester_id = session('semester_id');
        $student_id = session('student_id');

        $semester = Semester::findOrFail($semester_id);
        $start = DateTime::createFromFormat('Y-m-d',$semester->start);
        $end = DateTime::createFromFormat('Y-m-d',$semester->end);
        $at_moment = DateTime::createFromFormat('Y-m-d',date('Y-m-d'));
        $long_date = $start->diff($at_moment);
        $week = floor($long_date->days /7) + 1;

        $day = Carbon::now();
        if($tuan > $week){
            $day = $day->startOfWeek()->addWeeks($tuan-$week);
            $day = strtotime($day);
            
        }elseif($tuan == $week){
            $day = strtotime("this week");
        }else{
            $day = $day->startOfWeek()->subWeeks($week-$tuan);
            $day = strtotime($day);
        }
        
        $week = $tuan;

        $todays = Section::join('score','section.id','=','score.id_section')
        ->where('score.id_student',$student_id)
        ->where('score.id_semester',$semester_id)
        ->select('section.name AS name',
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
        $calendars = [];
        foreach($todays as $today){
            $monday = [];
            $tuesday = [];
            $wednesday = [];
            $thursday = [];
            $friday = [];
            $saturday = [];
            $sunday = [];
            if(!is_null($today->monday)){
                $monday = json_decode($today->monday); 
            }
            if(!is_null($today->tuesday)){
                $tuesday = json_decode($today->tuesday); 
            }
            if(!is_null($today->wednesday)){
                $wednesday = json_decode($today->wednesday); 
            }
            if(!is_null($today->thursday)){
                $thursday = json_decode($today->thursday); 
            }
            if(!is_null($today->friday)){
                $friday = json_decode($today->friday); 
            }
            if(!is_null($today->saturday)){
                $saturday = json_decode($today->saturday); 
            }
            if(!is_null($today->sunday)){
                $sunday = json_decode($today->sunday); 
            }
            $calendar = [
                'name' => $today->name,
                'room' => $today->room,
            ];
            if(!is_null($today->monday)){
                $calendar['monday'] = $monday;
            }
            if(!is_null($today->tuesday)){
                $calendar['tuesday'] = $tuesday; 
            }
            if(!is_null($today->wednesday)){
                $calendar['wednesday'] = $wednesday; 
            }
            if(!is_null($today->thursday)){
                $calendar['thursday'] = $thursday; 
            }
            if(!is_null($today->friday)){
                $calendar['friday'] = $friday; 
            }
            if(!is_null($today->saturday)){
                $calendar['saturday'] = $saturday;
            }
            if(!is_null($today->sunday)){
                $calendar['sunday'] = $sunday; 
            }
            $calendars[] = $calendar;
        }
        
        return view('frontend.section.calendar',compact('date','day','calendars','week'));
    }
}
