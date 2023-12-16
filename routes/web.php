<?php

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\GroupProjectController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TypeProjectController;
use App\Http\Controllers\Admin\YearStudyController;
use App\Http\Controllers\Admin\YearTrainController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\Student\ProjectController;
use App\Http\Controllers\Frontend\Student\ScheduleController;
use App\Http\Controllers\Frontend\Student\SectionController as StudentSectionController;
use App\Http\Controllers\Frontend\Student\UserController;
use App\Http\Controllers\Frontend\Teacher\ProjectController as TeacherProjectController;
use App\Http\Controllers\Frontend\Teacher\ScoreController;
use App\Http\Controllers\Frontend\Teacher\TeacherController as FrontendTeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/index', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function(){
    Route::get('home',[DashboardController::class,'index']);
    //Khoa
    Route::get('faculty/add',[FacultyController::class,'create']);
    Route::post('faculty/add',[FacultyController::class,'store']);
    Route::get('faculty',[FacultyController::class,'index']);
    Route::get('faculty/year-train/{id}',[YearTrainController::class,'index']);
    //Niên khóa đào tạo
    Route::get('year-train/add',[YearTrainController::class,'create']);
    Route::post('year-train/add',[YearTrainController::class,'store']);
    // Route::get('year-train',[YearTrainController::class,'index']);
    Route::get('year-train/branch/{id}',[BranchController::class,'index']);
    //Lớp sinh hoạt
    Route::get('class/add',[ClassController::class,'create']);
    Route::post('class/add',[ClassController::class,'store']);
    Route::get('class/student/{id}',[ClassController::class,'getListStudent']);
    Route::post('class/post/teacher',[ClassController::class,'getListTeacher']);
    Route::post('class/post/yeartrain',[ClassController::class,'getYearTrain']);
    Route::post('class/post/branch',[ClassController::class,'getBranch']);
    //Giảng viên
    Route::get('teacher/add',[TeacherController::class,'create']);
    Route::post('teacher/add',[TeacherController::class,'store']);
    Route::get('teacher',[TeacherController::class,'index']);
    Route::get('teacher/edit/{id}',[TeacherController::class,'show']);
    Route::post('teacher/edit/{id}',[TeacherController::class,'update']);
    Route::get('teacher/delete/{id}',[TeacherController::class,'destroy']);
    //Sinh viên
    Route::get('student/add',[StudentController::class,'create']);
    Route::post('student/add',[StudentController::class,'store']);
    Route::get('student',[StudentController::class,'index']);
    Route::get('student/edit/{id}',[StudentController::class,'show']);
    Route::post('student/edit/{id}',[StudentController::class,'update']);
    Route::get('student/delete/{id}',[StudentController::class,'destroy']);
    //Ngành đào tạo
    Route::get('branch/add',[BranchController::class,'create']);
    Route::post('branch/add',[BranchController::class,'store']);
    Route::get('branch/delete/{id}',[BranchController::class,'destroy']);
    Route::get('branch/get/year-train/{id}',[BranchController::class,'getYeartrain']);
    Route::post('branch/post/year-train',[BranchController::class,'postYeartrain']);
    Route::get('branch/class/{id}',[ClassController::class,'index']);
    //Năm học
    Route::get('year-study/add',[YearStudyController::class,'create']);
    Route::post('year-study/add',[YearStudyController::class,'store']);
    Route::get('year-study',[YearStudyController::class,'index']);
    Route::get('year-study/semester/{id}',[SemesterController::class,'getSemester']);
    //Học kỳ
    Route::get('semester/add',[SemesterController::class,'create']);
    Route::post('semester/add',[SemesterController::class,'store']);
    Route::get('semester',[SemesterController::class,'index']);
    Route::get('semester/edit/{id}',[SemesterController::class,'show']);
    Route::post('semester/edit/{id}',[SemesterController::class,'update']);
    Route::get('semester/subject/{id}',[SubjectController::class,'index']);
    //Môn học
    Route::get('subject/add',[SubjectController::class,'create']);
    Route::post('subject/add',[SubjectController::class,'store']);
    Route::post('subject/faculty/teacher',[SubjectController::class,'getListTeacher']);
    Route::get('subject/edit/{id}',[SubjectController::class,'show']);
    Route::post('subject/edit/{id}',[SubjectController::class,'update']);
    Route::get('subject/teacher/{id}',[SubjectController::class,'getTeacher']);
    Route::get('subject/delete/{id}',[SubjectController::class,'destroy']);
    //Lớp học phần
    Route::get('section/add',[SectionController::class,'create']);
    Route::post('section/add',[SectionController::class,'store']);
    Route::get('subject/section/{id}',[SectionController::class,'index']);
    Route::get('section/edit/{id}',[SectionController::class,'show']);
    Route::post('section/edit/{id}',[SectionController::class,'update']);
    //Nhóm học phần
    Route::get('group/faculty',[GroupController::class,'getFaculty']);
    Route::get('group/faculty/year/{id}',[GroupController::class,'getYearTrain']);
    Route::get('group/branch/{id}',[GroupController::class,'getBranch']);
    Route::get('group/branch/{id}/year',[GroupController::class,'getYearStudy']);
    Route::get('group/branch/{id}/year/{year}',[GroupController::class,'getSemester']);
    Route::get('group/branch/{id}/year/{year}/semester/{semester}/add',[GroupController::class,'create']);
    Route::post('group/branch/{id}/year/{year}/semester/{semester}/add',[GroupController::class,'store']);
    Route::get('group/branch/{id}/year/{year}/semester/{semester}',[GroupController::class,'index']);
    Route::get('group/subject/{id}',[GroupController::class,'getSubject']);
    Route::get('type/branch/{id}/semester/{semester}/project',[TypeProjectController::class,'index']);
    Route::get('type/branch/{id}/semester/{semester}/project/add',[TypeProjectController::class,'create']);
    Route::post('type/branch/{id}/semester/{semester}/project/add',[TypeProjectController::class,'store']);
    Route::get('group/project/{id}',[GroupProjectController::class,'index']);
    Route::get('group/project/{id}/add',[GroupProjectController::class,'create']);
    Route::post('group/project/{id}/add',[GroupProjectController::class,'store']);
    Route::get('project/list/student/{id}',[ReportController::class,'index']);
    Route::get('project/list/student/{id}/add',[ReportController::class,'create']);
    Route::post('project/list/student/{id}/add',[ReportController::class,'store']);
    //Ajax
    Route::post('ajax/post/yeartrain',[StudentController::class,'postYearTrain']);
    Route::post('ajax/post/branch',[StudentController::class,'postBranch']);
    Route::post('ajax/post/class',[StudentController::class,'postClass']);
    Route::post('ajax/post/subject',[StudentController::class,'postSubject']);
    Route::post('ajax/post/one/subject',[StudentController::class,'postOneSubject']);
    Route::post('ajax/post/teacher',[StudentController::class,'getListTeacher']);
    Route::post('ajax/post/group',[StudentController::class,'postGroup']);
    Route::get('ajax/get/yeartrain/{id}',[StudentController::class,'getYearTrain']);
    Route::get('ajax/get/branch/{id}',[StudentController::class,'getBranch']);
    Route::get('ajax/get/class/{id}',[StudentController::class,'getClass']);
    Route::get('ajax/get/subject/{id}',[StudentController::class,'getSubject']);
    Route::get('ajax/get/teacher/{id}',[StudentController::class,'getTeacher']);
    Route::get('ajax/get/branch/{id}/semester/{semester}',[StudentController::class,'getGroup']);
});

Route::get('/set/semester',[HomeController::class,'setSemester']); //Ajax header
Route::get('/',[HomeController::class,'index'])->name('index');
Route::post('/login',[UserController::class,'login'])->name('loginStudent');
Route::get('/logout',[UserController::class,'logout'])->name('logout');
Route::get('quen-mat-khau/{type}',[HomeController::class,'forgotPassword']);
Route::post('xac-minh-email',[HomeController::class,'confirmEmail']);  //ajax
Route::post('kiem-tra-otp',[HomeController::class,'checkOtp']);        //ajax
Route::get('mat-khau-moi',[HomeController::class,'newPassword']);
Route::post('mat-khau-moi',[HomeController::class,'postNewPassword']);
Route::get('dowload/topic/{name}',[HomeController::class,'dowloadTopic']);
Route::post('gv/login',[FrontendTeacherController::class,'login'])->name('loginTeacher');

Route::prefix('sv')->group(function(){
    Route::get('dang-ki-tin-chi',[StudentSectionController::class,'showRegistration']);
    Route::post('dang-ki-tin-chi/mon-hoc',[StudentSectionController::class,'getSection']);    //Ajax
    Route::post('dang-ki-tin-chi',[StudentSectionController::class,'postRegistration']);
    Route::get('dang-ki-tin-chi/mon/{id}',[StudentSectionController::class,'registerCredits']);
    Route::get('dang-ki-tin-chi/huy/mon/{id}',[StudentSectionController::class,'destroyCredits']);
    Route::get('dang-ki-tin-chi/mon/do-an/{id}',[StudentSectionController::class,'creditProject']);
    Route::get('dang-ki-tin-chi/huy/mon/do-an/{id}',[StudentSectionController::class,'destroyCreditProject']);
    Route::get('hoso',[UserController::class,'showProfile']);
    Route::get('diem',[UserController::class,'showResult']);
    Route::get('khao-sat/cau-hoi-khao-sat/{id}',[UserController::class,'showRate']);
    Route::get('lich-hoc',[ScheduleController::class,'showSchedule']);
    Route::get('lich-trinh-giang-day/{id}',[ScheduleController::class,'detailSchedule']);
    Route::get('tkb',[ScheduleController::class,'showCalendar']);
    Route::get('tkb/tuan/{tuan}',[ScheduleController::class,'nextCalendar']);
    Route::get('hoc-phi-sap-nop',[UserController::class,'showTuition']);
    Route::post('thanh-toan-hoc-phi',[UserController::class,'payment_momo']);
    Route::get('thanh-toan-thanh-cong',[UserController::class,'payment_success']);
    Route::get('do-an-cua-toi',[ProjectController::class,'showProject']);
    Route::get('cap-nhat-do-an-cua-toi/{id}',[ProjectController::class,'showAddTopic']);
    Route::post('cap-nhat-do-an-cua-toi/{id}',[ProjectController::class,'postTopic']);
    Route::get('cap-nhat-ket-qua-cua-toi/{id}',[ProjectController::class,'showReport']);
    Route::post('cap-nhat-ket-qua-cua-toi/{id}',[ProjectController::class,'postReport']);
});
Route::prefix('gv')->group(function(){
    Route::get('danh-sach-hoc-phan',[FrontendTeacherController::class,'showListSection']);
    Route::get('diem-danh/{id}',[FrontendTeacherController::class,'showAttendance']);
    Route::post('diem-danh',[FrontendTeacherController::class,'postAttendance']); //Ajax
    Route::post('diem-danh/{id}',[FrontendTeacherController::class,'postAllAttendance']);
    Route::get('diem-danh/noi-dung/{id}',[FrontendTeacherController::class,'getContent']); //Ajax
    Route::post('ghi-chu',[FrontendTeacherController::class,'postNotes']); //Ajax
    Route::get('ghi-chu/{id}',[FrontendTeacherController::class,'getNotes']); //Ajax
    Route::get('quan-ly-diem',[ScoreController::class,'showListScore']);
    Route::get('quan-ly-diem/{id}',[ScoreController::class,'manageScore']);
    Route::post('quan-ly-diem/nhap-diem',[ScoreController::class,'importScore']); //Ajax
    Route::post('quan-ly-diem/xac-nhan',[ScoreController::class,'postScore']);
    Route::get('quan-ly-do-an',[TeacherProjectController::class,'showManageProject']);
    Route::get('quan-ly-do-an/bao-cao/{id}',[TeacherProjectController::class,'manageReport']);
    Route::get('quan-ly-do-an/diem/{id}',[TeacherProjectController::class,'manageProjectScore']);
    Route::post('quan-ly-do-an/diem',[TeacherProjectController::class,'postScoreProject']); //Ajax
    Route::post('quan-ly-do-an/xac-nhan-diem',[TeacherProjectController::class,'confirmScore']);
    Route::get('chi-tiet-bao-cao/{id}',[TeacherProjectController::class,'detailReport']);
    Route::post('xac-nhan-de-cuong',[TeacherProjectController::class,'confirmTopic']); //Ajax
    Route::post('xac-nhan-bao-cao',[TeacherProjectController::class,'confirmReport']); //Ajax
});
