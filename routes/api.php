<?php

use App\Http\Controllers\Api\StudentApiController;
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

Route::post('student/login',[StudentApiController::class,'Login']);
Route::get('student/index/{id}',[StudentApiController::class,'getListSubject']);
Route::get('student/list/{id}',[StudentApiController::class,'getListScore']);
Route::get('student/list/semester/subject/{id}',[StudentApiController::class,'getSubjectSemester']);
Route::get('student/score/detail/{id}',[StudentApiController::class,'getDetailScore']);
Route::get('semester',[StudentApiController::class,'getSemester']);
Route::post('check/mail',[StudentApiController::class,'checkEmail']);
Route::post('sendmail',[StudentApiController::class,'sendMail']);
Route::post('check/otp',[StudentApiController::class,'checkOtp']);
Route::post('password/new',[StudentApiController::class,'newPassword']);
