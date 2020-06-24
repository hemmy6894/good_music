<?php

namespace App;

use App\Models\Auth\DepartmentModel;
use App\Models\Auth\EmployeeStatusModel;
use App\Models\Auth\GenderModel;
use App\Models\Auth\RoleModel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'sname',
        'employee_no', 'pension_no', 'national_id',
        'email', 'email_verified_at', 'password',
        'dob', 'gender', 'phone','post_address',
        'basic_salary','department_id','roles','employee_status',
        'bank_name','account_name','account_no'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function departments(){
        return $this->belongsTo(DepartmentModel::class,'department_id','id');
    }

    public function t_roles(){
        return $this->belongsTo(RoleModel::class,'roles','id');
    }

    public function genders(){
        return $this->belongsTo(GenderModel::class,'gender','id');
    }

    public function t_status(){
        return $this->belongsTo(EmployeeStatusModel::class,'employee_status','id');
    }
}
