<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class FunctionModel extends Model
{
    //
    protected $table = "system_functions";
    protected $fillable = ['function_name','bg_color'];

    public function scopeActive($query){
        return $query->where('status','=',1);
    }
}
