<?php

use App\Http\Controllers\Api\StudentApiController;
use App\Http\Controllers\Api\TeacherApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('semester',[StudentApiController::class,'getSemester']);
Route::post('check/mail',[StudentApiController::class,'checkEmail']);
Route::post('sendmail',[StudentApiController::class,'sendMail']);
Route::post('check/otp',[StudentApiController::class,'checkOtp']);
Route::post('password/new',[StudentApiController::class,'newPassword']);
Route::prefix('student')->group(function(){
    Route::post('login',[StudentApiController::class,'Login']);
    Route::get('index/{id}',[StudentApiController::class,'getListSubject']);
    Route::get('list/{id}',[StudentApiController::class,'getListScore']);
    Route::get('list/semester/subject/{id}',[StudentApiController::class,'getSubjectSemester']);
    Route::post('get/subject/schedule',[StudentApiController::class,'getSubjectSchedule']);
    Route::get('score/detail/{id}',[StudentApiController::class,'getDetailScore']);
    Route::post('get/projectclass',[StudentApiController::class,'getProjectClass']);
    Route::post('get/detail/project',[StudentApiController::class,'detailProject']);
    Route::get('detail/subject/{id}',[StudentApiController::class,'detailSubject']);
    Route::post('tution',[StudentApiController::class,'getTution']);
    Route::get('tution/paid/{id}',[StudentApiController::class,'getPaid']);
    Route::post('get/group',[StudentApiController::class,'getGroup']);
    Route::post('get/subject/by/group',[StudentApiController::class,'getSubjectByGroup']);
    Route::post('credit/section',[StudentApiController::class,'registerCredits']);
    Route::post('credit/all',[StudentApiController::class,'registerAllGroup']);
    Route::post('destroy/credit',[StudentApiController::class,'destroyCredit']);
    Route::post('credit/project',[StudentApiController::class,'creditProject']);
    Route::post('destroy/project',[StudentApiController::class,'destroyProject']);
});
Route::prefix('teacher')->group(function(){
    Route::get('get/subject/{id}',[TeacherApiController::class,'getAllSubject']);
    Route::post('get/subject/schedule',[TeacherApiController::class,'getSubjectSchedule']);
    Route::get('detail/subject/{id}',[TeacherApiController::class,'detailSubject']);
    Route::post('post/content',[TeacherApiController::class,'postContent']);
    Route::post('post/attendance',[TeacherApiController::class,'postAttendance']);
    Route::post('post/attendance/all',[TeacherApiController::class,'postAllAttendance']);
    Route::get('show/attendance/{id}',[TeacherApiController::class,'showAttendance']);
    Route::get('show/score/{id}',[TeacherApiController::class,'showScore']);
    Route::get('detail/score/{id}',[TeacherApiController::class,'detailScore']);
    Route::post('post/score',[TeacherApiController::class,'postScore']);
    Route::post('confirm/score',[TeacherApiController::class,'confirmScore']);
});
