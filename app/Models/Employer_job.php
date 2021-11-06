<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Employer_job extends Authenticatable
{
    use HasApiTokens;
    public $table = 'employer_jobs';
    public $fillable = ['id','title','content','status','employer_email','employer_password','employer_name','employer_phone'];

    public function employees(){
        return $this->hasMany(Employee::class,'job_id');
    }
}
