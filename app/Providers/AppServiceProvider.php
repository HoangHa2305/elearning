<?php

namespace App\Providers;

use App\Models\Semester;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('frontend.layouts.app',function($view){
            $teacherId = session('teacher_id');
            $studentId = session('student_id');
            $semester = Semester::orderBy('id','desc')->get();
            $semester_id = Semester::orderBy('id','desc')->first();
            if ($semester_id) {
                session()->put('semester_id',$semester_id->id);
            } else {
                session()->put('semester_id', null);
            }

            if($teacherId){
                $teacher = Teacher::findOrFail($teacherId);
                $view->with('teacher',$teacher)->with('semesters',$semester);
            }

            if($studentId){
                $student = Student::findOrFail($studentId);
                $view->with('student',$student)->with('semesters',$semester);
            }
        });
    }
}
