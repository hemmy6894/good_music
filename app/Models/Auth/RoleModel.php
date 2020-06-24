<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    //
    protected $table = "roles";
    protected $fillable = ['role_name','bg_color'];

    public function scopeActive($query){
        return $query->where('status','=',1);
    }
}
