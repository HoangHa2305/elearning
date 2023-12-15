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
    Route::get('score/detail/{id}',[StudentApiController::class,'getDetailScore']);
    Route::post('get/projectclass',[StudentApiController::class,'getProjectClass']);
    Route::post('get/detail/project',[StudentApiController::class,'detailProject']);
    Route::get('detail/subject/{id}',[StudentApiController::class,'detailSubject']);
    Route::post('tution',[StudentApiController::class,'getTution']);
});
