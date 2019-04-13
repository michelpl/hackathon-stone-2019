<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::apiResource('/product', ProductController::class);
Route::get('/auth', 'LinkedinController@auth');
Route::get('/linkedin', 'LinkedinController@login');
Route::apiResource('/job', JobController::class);
Route::apiResource('/skill', SkillController::class);
Route::apiResource('/position', PositionController::class);
Route::apiResource('/applicant', ApplicantController::class);
Route::apiResource('/applicantskill', ApplicantSkillController::class);
