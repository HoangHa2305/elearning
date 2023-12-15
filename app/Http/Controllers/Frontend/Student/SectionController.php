<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\Group;
use App\Models\Score;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Typeproject;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function showRegistration()
    {
        $student_id = session('student_id');
        $semester_id = session('semester_id');
        $student = Student::findOrFail($student_id);
        $yeartrain_id = $student->get_yeartrain->id;
        $datas = [];
        $credits = Credit::where('student_id',$student_id)->where('semester_id',$semester_id)->where('section_id','!=',null)->get();
        $types = Credit::join('type_project','credits.type_id','=','type_project.id')
                        ->join('subject','type_project.id_subject','=','subject.id')
                        ->select('type_project.title AS title',
                                'credits.type_id AS type_id',
                                'credits.id AS id',
                                'subject.code AS code',
                                'subject.teacher AS teacher',
                                'subject.credits AS credit') 
                        ->where('credits.student_id',$student_id)
                        ->where('credits.semester_id',$semester_id)
                        ->where('credits.type_id','!=',null)
                        ->get();
        foreach($types as $type){
            $teachers = json_decode($type->teacher);
            foreach($teachers as $teacher){
                $teacher_id = intval($teacher);
                $name = Teacher::findOrFail($teacher);
            }
            $datas[] = [
                'title' => $type->title,
                'code' => $type->code,
                'id' => $type->id,
                'type_id' => $type->type_id,
                'teacher' => $name->name,
                'credit' => $type->credit
            ];
        }
        $projects = Subject::join('type_project','subject.id','=','type_project.id_subject')
                    ->select('type_project.title AS name',
                            'type_project.id AS id',
                            'subject.code AS code',
                            'subject.credits AS credit')
                    ->where('subject.semester_id',$semester_id)
                    ->where('subject.yeartrain_id',$yeartrain_id)
                    ->where('subject.group',1)
                    ->get();
        $groups = Group::where('branch_id',$student->branch_id)->where('semester_id',$semester_id)->where('active',1)->get();
        $results = [];
        foreach($credits as $credit){
            $monday = json_decode($credit->section->monday);
            $tuesday = json_decode($credit->section->tuesday);
            $wednesday = json_decode($credit->section->wednesday);
            $thursday = json_decode($credit->section->thursday);
            $friday = json_decode($credit->section->friday);
            $saturday = json_decode($credit->section->saturday);
            $sunday = json_decode($credit->section->sunday);
            $output = '';
            
            if($monday){
                $output .= "T.Hai ".$monday[0].'->'.$monday[count($monday)-1]."<br>";
            }
            if($tuesday){
                $output .= "T.Ba ".$tuesday[0].'->'.$tuesday[count($tuesday)-1]."<br>";
            }
            if($wednesday){
                $output .= "T.Tư ".$wednesday[0].'->'.$wednesday[count($wednesday)-1]."<br>";
            }
            if($thursday){
                $output .= "T.Năm ".$thursday[0].'->'.$thursday[count($thursday)-1]."<br>";
            }
            if($friday){
                $output .= "T.Sáu ".$friday[0].'->'.$friday[count($friday)-1]."<br>";
            }
            if($saturday){
                $output .= "T.Bảy ".$saturday[0].'->'.$saturday[count($saturday)-1]."<br>";
            }
            if($sunday){
                $output .= "C.Nhật ".$sunday[0].'->'.$sunday[count($sunday)-1]."<br>";
            }

            $results[] = [
                'id' => $credit->id,
                'code' => $credit->section->code,
                'name' => $credit->section->name,
                'credit' => $credit->section->subject->credits,
                'teacher' => $credit->section->teacher->name,
                'desc' => $output,
                'week' => $credit->section->week,
            ];
        }
        return view('frontend.section.register',compact('groups','results','projects','datas'));
    }

    public function getSection(Request $request)
    {
        $id = $request->id;
        $type = $request->type;
        if($type==0){
            $student_id = session('student_id');
            $semester_id = session('semester_id');
            $credits = Credit::where('student_id',$student_id)->where('section_id','!=',null)->where('semester_id',$semester_id)->get();
            
            $sections = Section::where('id_group',$id)->get();
            $result = [];
            foreach($sections as $section){
                $monday = json_decode($section['monday']);
                $tuesday = json_decode($section['tuesday']);
                $wednesday = json_decode($section['wednesday']);
                $thursday = json_decode($section['thursday']);
                $friday = json_decode($section['friday']);
                $saturday = json_decode($section['saturday']);
                $sunday = json_decode($section['sunday']);
                $output = '';
                $alert = '';
                foreach($credits as $credit){
                    if($credit->section->subject->id == $section->subject->id){
                        $alert = "<div class='custom-danger'><p>Đã đăng kí</p></div>";
                    }
                }
                
                if($monday){
                    $output .= "T.Hai ".$monday[0].'->'.$monday[count($monday)-1]."<br>";
                }
                if($tuesday){
                    $output .= "T.Ba ".$tuesday[0].'->'.$tuesday[count($tuesday)-1]."<br>";
                }
                if($wednesday){
                    $output .= "T.Tư ".$wednesday[0].'->'.$wednesday[count($wednesday)-1]."<br>";
                }
                if($thursday){
                    $output .= "T.Năm ".$thursday[0].'->'.$thursday[count($thursday)-1]."<br>";
                }
                if($friday){
                    $output .= "T.Sáu ".$friday[0].'->'.$friday[count($friday)-1]."<br>";
                }
                if($saturday){
                    $output .= "T.Bảy ".$saturday[0].'->'.$saturday[count($saturday)-1]."<br>";
                }
                if($sunday){
                    $output .= "C.Nhật ".$sunday[0].'->'.$sunday[count($sunday)-1]."<br>";
                }
                $result[] = [
                    'id' => $section->id,
                    'name' => $section->name,
                    'credits' => $section->subject->credits,
                    'register' => $section->register,
                    'count' => $section->count,
                    'week' => $section->week,
                    'teacher' => $section->teacher->name,
                    'desc' => $output,
                    'alert' => $alert
                ];
            }
        }else{
            $projects = Typeproject::join('subject','type_project.id_subject','=','subject.id')
                    ->select('type_project.title AS title',
                            'type_project.id AS id',
                            'subject.teacher AS teacher')
                    ->where('type_project.id',$id)
                    ->get();
            $result = [];
            foreach($projects as $project){
                $item['id'] = $project->id;
                $item['title'] = $project->title;
                $teachers = json_decode($project->teacher);
                foreach($teachers as $teacher){
                    $teacher_id = intval($teacher);
                    $name = Teacher::findOrFail($teacher_id);
                    $item['teacher'] = $name->name;
                }

                $result[] = $item;
            }
        }
        
        return $result;
    }

    public function postRegistration(Request $request)
    {
        $student_id = session('student_id');
        $semester_id = session('semester_id');
        $time = date("h:i:s d-m-Y");
        $sections = $request->section_id;
        
        foreach($sections as $section){
            $credit = new Credit();
            $credit->student_id = $student_id;
            $credit->semester_id = $semester_id;
            $credit->section_id = $section;
            $credit->time = $time;
            if($credit->save()){
                $getSection = Section::findOrFail($section);
                $score = new Score();
                $score->id_student = $student_id;
                $score->id_section = $section;
                $score->id_semester = $getSection->subject->semester_id;
                $score->session = 1;
                $score->active = 0;
                $score->save();
            }
        }
        return redirect()->back();
    }

    public function registerCredits(string $id)
    {
        $student_id = session('student_id');
        $semester_id = session('semester_id');
        $time = date("h:i:s d-m-Y");
        
        $credit = new Credit();
        $credit->student_id = $student_id;
        $credit->semester_id = $semester_id;
        $credit->section_id = $id;
        $credit->time = $time;

        if($credit->save()){
            Section::where('id',$id)->increment('register');

            $section = Section::findOrFail($id);
            $score = new Score();
            $score->id_student = $student_id;
            $score->id_section = $id;
            $score->id_semester = $section->subject->semester_id;
            $score->session = 1;
            $score->active = 0;
            if($score->save()){
                return redirect()->back();
            };
        }
    }

    public function destroyCredits(string $id)
    {
        $student_id = session('student_id');
        $semester_id = session('semester_id');
        $result = Credit::findOrFail($id);
        if($result){
            Section::where('id',$result->section_id)->decrement('register');
            Score::where('id_section',$result->section_id)->where('id_semester',$semester_id)->where('id_student',$student_id)->delete();
            $result->delete();
            return redirect()->back();
        }
    }

    public function creditProject(string $id)
    {
        $student_id = session('student_id');
        $semester_id = session('semester_id');
        $time = date("h:i:s d-m-Y");
        
        $credit = new Credit();
        $credit->student_id = $student_id;
        $credit->semester_id = $semester_id;
        $credit->type_id = $id;
        $credit->time = $time;

        if($credit->save()){
            $score = new Score();
            $score->id_student = $student_id;
            $score->id_type = $id;
            $score->id_semester = $semester_id;
            $score->session = 1;
            $score->active = 0;
            if($score->save()){
                return redirect()->back();
            };
        }
    }

    public function destroyCreditProject(string $id)
    {
        $student_id = session('student_id');
        $semester_id = session('semester_id');
        $result = Credit::findOrFail($id);
        if($result){
            Score::where('id_type',$result->type_id)->where('id_semester',$semester_id)->where('id_student',$student_id)->delete();
            $result->delete();
            return redirect()->back();
        }
    }
}
