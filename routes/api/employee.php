<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::post('register',[EmployeeController::class,'register']);
Route::post('login',[EmployeeController::class,'login']);
//add this middleware to ensure that every request is authenticated

//stop auth
//Route::middleware('auth:employeeapi')->group(function(){
    Route::post('getJobs',[EmployeeController::class,'getJobs']);
//});

