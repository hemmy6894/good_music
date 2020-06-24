<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class DepartmentModel extends Model
{
    //
    protected $table = "departments";
    protected $fillable = ['name','bg_color'];

    public function scopeActive($query){
        return $query->where('status','=',1);
    }
}
