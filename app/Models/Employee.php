<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens;
    public $table = 'employees';
    public $fillable = ['id','email','city','Name','Bio','Skills','Exper_level','status_apply','Job_id'];
    public function employer_jobs(){
        return $this->belongsTo(Employer_job::class,'Job_id','id');
    }
}
