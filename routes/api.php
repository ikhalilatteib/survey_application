<?php

use App\Http\Controllers\Auth\PassportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SurveyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->group(function (){
    Route::resource('/survey',SurveyController::class);
    Route::post('/logout',[PassportController::class,'logout']);

    Route::get('/dashboard/index',[DashboardController::class,'index']);
});

Route::get('/survey-by-slug/{survey:slug}',[SurveyController::class,'showForGuest']);
Route::post('/survey/{survey}/answer',[SurveyController::class,'storeAnswer']);

Route::post('/register',[PassportController::class,'register']);
Route::post('/login',[PassportController::class,'login']);

