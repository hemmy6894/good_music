<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class EmployeeStatusModel extends Model
{
    //
    protected $table = "employee_statuses";
    protected $fillable = ['name','bg_color'];

    public function scopeActive($query){
        return $query->where('status','=',1);
    }
}
