<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employer_job;
use Illuminate\Http\Request;

class EmployeeController extends Controller{
    /**
     * handle user registration request
     */
    public function register(Request $request){
        $user= Employee::create($request->all());
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
    public function login(Request $request){
        $arr=[];
        $token='';
        $login_credentials=[
            'email'=>$request->email
        ];
        $employee = Employee::with('employer_jobs')->get();
        foreach($employee as $row){
            if($row->email==$login_credentials['email']){
                $user_login_token=  $row->createToken('Cict')->accessToken;
                global $token;
                $token = $user_login_token;
                array_push($arr, $row);
            }
        }
        if(count($arr)>0){
            return response()->json(
                [
                    'status'=>"success",
                    'data'=>$arr,
                    'token'=>$token
                ]
                , 200);
        }
        return response()->json(['error' => 'UnAuthorised Access'], 401);
    }
    public function getJobs(Request $request){
        $employee = Employer_job::where('status',$request->status)->get();
        if(count($employee)>0){
            return response()->json(
                [
                    'status'=>"success",
                    'data'=>$employee
                ]
                , 200);
        }else{
            return response()->json(
                [
                    'status'=>"success",
                    'data'=>"not exsit any job Avaliable yet" 
                ]
                , 200);
        }
     
    }
}