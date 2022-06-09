<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\gradeController;
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

// public routes
 

 Route::post('/register',   [AuthController::class, 'register']);
 Route::post('/login',   [AuthController::class, 'login']);

//Route::resource('/grades',gradeController::class);

// Protected Routes
Route::group(['middleware'=>['auth:sanctum']],function(){    
    Route::get('/getAllGrades',  [gradeController::class, 'index']); 
    Route::post('/addGrades',   [gradeController::class, 'store']);
    Route::put('/editGrades/{id}',  [gradeController::class, 'update']); 
    Route::delete('/deletestudentgrade/{id}',   [gradeController::class, 'destroy']);
    // Route::get('/grades',  [gradeController::class, 'index']);     
    // Route::post('/grades',   [gradeController::class, 'store']);
    // Route::put('/grades/update/{id}',  [gradeController::class, 'update']);
    // Route::delete('/grades/destroy/{id}',   [gradeController::class, 'destroy']);
    // Route::post('/logout',   [AuthController::class, 'logout']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
