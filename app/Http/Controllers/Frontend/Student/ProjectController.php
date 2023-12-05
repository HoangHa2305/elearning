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
        $parents = Report::where('id_student','!=',$student_id)->get();
        $reports = Report::join('group_project','reports.id_group','=','group_project.id')
                ->join('type_project','group_project.id_type','=','type_project.id')
                ->join('teacher','group_project.id_teacher','=','teacher.id')
                ->select('group_project.title AS title',
                        'type_project.date_start AS date_start',
                        'type_project.time_start AS time_start',
                        'type_project.date_end AS date_end',
                        'type_project.time_end AS time_end',
                        'teacher.name AS name_teacher',
                        'teacher.avatar AS avatar',
                        'teacher.phone AS phone',
                        'teacher.email AS email',
                        'teacher.level AS level_teacher',
                        'reports.id as id',
                        'reports.parent AS parent',
                        'reports.title AS name',
                        'reports.topic AS topic',
                        'reports.report AS report',
                        'reports.id_parent AS id_parent'
                        )
                ->where('reports.id_student',$student_id)
                ->where('type_project.id_semester',$semester_id)
                ->get();
        return view('frontend.member.project',compact('reports','parents'));
    }

    public function showAddTopic(string $id)
    {
        $student_id = session('student_id');
        $report = Report::findOrFail($id);
        $leaders = Report::where('id_student','!=',$student_id)->with('student')->get(); 
        return view('frontend.member.addtopic',compact('report','leaders'));
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
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $semester_id = session('semester_id');
        $student_id = session('student_id');
        $date = date('h:i:sa d-m-Y');
        $year = date('Y');

        $data = $request->all();
        $report = Report::find($id);
        if($data['parent']==0){
            $student = Student::findOrFail($student_id);
            $name = $this->custom_name($student->name);

            $type = $this->translate_topic($report->group->type->subject->name);
   
            $file = $request->file('topic');
            if($file){
                $file_name = time().'-'.$type.'-'.$year.'-'.$name.'.docx';
                $data['topic'] = $file_name;
            }
            $data['id_parent'] = null;
            $data['confirm'] = 0;
            $data['date_topic'] = $date;
        }else if($data['parent']==1){
            $data['title'] = null;
            $data['topic'] = null;
            $data['desc_topic'] = null;
            $data['date_topic'] = null;
            $data['confirm'] = null;
        }
       
        if($report->update($data)){
            if(isset($file)){
                $file->storeAs('documents',$file_name,'public');
            }
            return redirect()->back()->with('success','Nộp đề cương thành công');
        }else{
            return redirect()->back()->withErrors('Nộp đề cương thất bại');
        }
    }

    public function showReport(string $id)
    {
        return view('frontend.member.addreport');
    }

    public function postReport(Request $request, string $id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $data = $request->all();
        $report = Report::find($id);
        $type = $this->translate_topic($report->group->type->title);
        $title = $report->title;
        $title = explode(' ',$title);
        $content = implode(' ',array_slice($title,-6));
        $content = strtolower($content);
        $content = $this->custom_name($content);

        $file = $request->file('report');
        if($file){
            $file_name = time().'-bao-cao-'.$type.'-'.$content.'.docx';
            $data['report'] = $file_name;
            $data['date_report'] = date('h:i:sa d-m-Y');
            $data['status'] = 0;
        }
        
        if($report->update($data)){
            if(isset($file)){
                $file->storeAs('documents',$file_name,'public');
            }
            return redirect()->back()->with('success','Nộp báo cáo thành công');
        }else{
            return redirect()->back()->withErrors('Nộp báo cáo thất bại');
        }
    }
}
