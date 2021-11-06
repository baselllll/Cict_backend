<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employer_job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Employer_jobController extends Controller{
    /**
     * handle user registration request
     */
    public function registerEmp_Job(Request $request){
        $request['employer_password']=bcrypt($request->employer_password);
        $user= Employer_job::create($request->all());
 
        return response()->json(
            [
                'status'=>"success",
                'data'=>$user
            ]
            , 200);
    }

    /**
     * login user to our application
     */
    public function loginEmployer(Request $request){
        $login_credentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        $employer = Employer_job::all();
        foreach($employer as $row){
            if($row->employer_email==$login_credentials['email'] && Hash::check($login_credentials['password'], $row->employer_password)){
                $user_login_token=  $row->createToken('Cict')->accessToken;
                return response()->json(
                    [
                        'status'=>"success",
                        'data'=>$login_credentials,
                        'token' => $user_login_token
                    ]
                    , 200);
            }
        }
        return response()->json(['error' => 'UnAuthorised Access'], 401);
    }

    /**
     * This method returns authenticated user details
     */
    public function Emp_JobDetails(){
        $Employer_job = Employer_job::all();
        return response()->json(['authenticated-admin' => $Employer_job], 200);
    }

    public function SB_Programming_languages(Request $request){
        $skills = $request->skills;
        $arr = [];
        foreach($skills as $item){
            $emp_job = Employee::with('employer_jobs')->where('Skills','LIKE',"%{$item}%")->get();
            array_push($arr,$emp_job);
        }
        return response()->json(
            [
                'Message' => 'success',
                "Data"=>$arr
            ]
        );
    }
    public function SB_City(Request $request){
        $emp_job = Employee::with('employer_jobs')->where('city',$request->city)->get();
        return response()->json(
            [
                'Message' => 'success',
                "Data"=>$emp_job
            ]
        );
    }
    public function SB_Experience(Request $request){
        $emp_job = Employee::with('employer_jobs')->where('Exper_level',$request->Exper_level)->get();
        return response()->json(
            [
                'Message' => 'success',
                "Data"=>$emp_job
            ]
        );
    }
    public function SB_Bio(Request $request){
        $emp_job = Employee::with('employer_jobs')->where('Bio','LIKE',"%{$request->Bio}%")->get();
        return response()->json(
            [
                'Message' => 'success',
                "Data"=>$emp_job
            ]
        );
    }

    public function Change_status(Request $request){
        $Job_id = $request->Job_id;
        $status = $request->status;
        $emp_job = Employee::where('Job_id',$Job_id)->first();
       $emp_job->update(['status_apply'=>$status]);
        return response()->json(
            [
                'Message' => 'status changed and updated successfully',
                "Data"=>$emp_job
            ]
        );
    }

    public function Change_status_job(Request $request){
        $Job_id = $request->Job_id;
        $status = $request->status;
        $emp_job = Employer_job::where('id',$Job_id)->first();
       $emp_job->update(['status'=>$status]);
        return response()->json(
            [
                'Message' => 'status changed and updated successfully',
                "Data"=>$emp_job
            ]
        );
    }
}
