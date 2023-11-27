<?php

namespace App\Http\Controllers\Frontend\Student;

use Patchwork\Utf8;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Student;
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
                        'type_project.date_start AS date_start',
                        'type_project.time_start AS time_start',
                        'type_project.date_end AS date_end',
                        'type_project.time_end AS time_end',
                        'teacher.name AS name_teacher',
                        'teacher.level AS level_teacher',
                        'reports.id as id',
                        'reports.parent AS parent',
                        'reports.title AS name',
                        'reports.topic AS topic'
                        )
                ->where('reports.id_student',$student_id)
                ->where('type_project.id_semester',$semester_id)
                ->get();
        return view('frontend.member.project',compact('reports'));
    }

    public function showAddTopic(string $id)
    {
        $report = Report::findOrFail($id);
        return view('frontend.member.addtopic',compact('report'));
    }

    function translate_topic($data)
    {
        $title = strtr($data, 'Đồáàảãạâấầẩẫậăắằẳẵặ', 'Doaaaaaaaâaaaaaaaa');
        $title = explode(' ',$title);
        $new_title = '';
        foreach($title as $result){
            $new_title .= substr($result,0,1); 
        }

        return strtolower($new_title);
    }

    function custom_name($name)
    {
        $name = Utf8::strtolower($name);

        $name = Utf8::toAscii($name);
        $name = str_replace(' ', '-', $name);
        $name = preg_replace('/[^a-z0-9á?^-]/', '', $name);
        return $name;
    }

    public function postTopic(Request $request,string $id)
    {
        $semester_id = session('semester_id');
        $student_id = session('student_id');

        $student = Student::findOrFail($student_id);
        $name = $this->custom_name($student->name);

        $report = Report::find($id);

        $type = $this->translate_topic($report->group->type->title);

        $data = $request->all();
        $file = $request->file('topic');
        if($file){
            $file_name = time().'-'.$type.'-2023-'.$name.'.docx';
            $data['topic'] = $file_name;
        }
        if($report->update($data)){
            if($file){
                $file->storeAs('documents',$file_name,'public');
            }
            return redirect()->back()->with('success','Nộp đề cương thành công');
        }else{
            return redirect()->back()->withErrors('Nộp đề cương thất bại');
        }
    }
}
