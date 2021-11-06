<?php

use App\Http\Controllers\Employer_jobController;
use Illuminate\Support\Facades\Route;


Route::post('register_employer_job',[Employer_jobController::class,'registerEmp_Job']);
Route::post('loginEmployer',[Employer_jobController::class,'loginEmployer']);
//add this middleware to ensure that every request is authenticated
// Route::middleware('auth:employerapi')->group(function(){
    Route::get('getallempJob', [Employer_jobController::class,'Emp_JobDetails']);
    Route::get('SB_Programming_languages', [Employer_jobController::class,'SB_Programming_languages']);
    Route::get('SB_City', [Employer_jobController::class,'SB_City']);
    Route::get('SB_Experience', [Employer_jobController::class,'SB_Experience']);
    Route::get('SB_Bio', [Employer_jobController::class,'SB_Bio']);
    //Change_status_Apply of employee (Accept or Reject)
    Route::get('Change_status', [Employer_jobController::class,'Change_status']);
    //Change Status Job Available or not
    Route::get('Change_status_job', [Employer_jobController::class,'Change_status_job']);
// });
