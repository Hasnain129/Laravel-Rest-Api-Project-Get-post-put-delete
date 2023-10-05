<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//student table records
Route::get('students', [StudentController::class,'index']);
//Create record in database through postman
Route::post('students', [StudentController::class,'store']);
//get records by id
Route::get('students/{id}', [StudentController::class,'show']);
//get edit one record
Route::get('students/{id}/edit', [StudentController::class,'edit']);
//update student record by id
Route::put('students/{id}/edit', [StudentController::class,'update']);
//Delete records by id
Route::delete('students/{id}/delete', [StudentController::class,'destroy']);