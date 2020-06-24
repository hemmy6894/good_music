<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRoleModel extends Model
{
    //
    protected $table = 'user_roles';

    protected $fillable = [
        'rid','role', 'function_name', 'status'
    ];

    public function scopeActive($query){
        return $query->where('status','=',1);
    }

    public function scopeGet_Roles(){
        return RoleModel::select(DB::raw('role_name'))->distinct()->get();
    }

    public function scopeGet_Function(){
        return SystemFunctionModel::select(DB::raw('function_name'))->distinct()->get();
    }


    public function scopeUser_Per_Role(){
        $roles = $this::get_roles();
        $functions = $this::get_function();

        $array_user_per_function = array();
        foreach($functions as $function){
            foreach($roles as $role){
                $id = $function->function_name ."-".$role->role_name;
                if(UserRoleModel::where(DB::raw('rid'),"=",$id)->count() > 0){
                    $statuses = UserRoleModel::where(DB::raw('rid'),"=",$id)
                                ->first();                                          
                    $array_user_per_function[$role->role_name][$id] = $statuses->status;
                }else{
                    $array_user_per_function[$role->role_name][$id] = 0;
                }
            }
        }

        return $array_user_per_function;
    }

    public function scopeRoles($query){
        $role = Auth::check() == true ? Auth::user()->roles : "";
        if($role != ""){
            $role = RoleModel::where('id',$role);
            if($role->count()){
                $role = $role->get()[0]->role_name;
            }
        }
        $roles =  $query->where('role','=',$role)->get();
        $arrays = array();

        foreach($roles as $role){
            $arrays[$role->function_name] = $role->status;
        }

        return $arrays;
    }
}
