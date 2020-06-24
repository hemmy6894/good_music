<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class SystemFunctionModel extends Model
{
    //
    protected $table = "system_functions";
    protected $fillable = ['function_name'];

    public function scopeActive($query){
        return $query->where('status','=',1);
    }
}
