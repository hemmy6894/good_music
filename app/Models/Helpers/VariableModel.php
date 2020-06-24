<?php

namespace App\Models\Helpers;

use Illuminate\Database\Eloquent\Model;

class VariableModel extends Model
{
    //
    //
    protected $table = "variables";
    protected $fillable = ['name','body'];

    public function scopeActive($query){
        return $query->where('status','=',1);
    }

    public function scopeField_Select($query,$id ,$default = ""){
        $v = $query->where('id',$id);
        if($v->count()){
            return $v->get()[0]->body;
        }
        return $default;
    }

    public function scopeCc_Mail($query,$default = ""){
        return VariableModel::field_select(3,$default);
    }

    public function scopeReply_To($query,$default = ""){
        return VariableModel::field_select(2,$default);
    }

    public function scopeCompany($query,$default = ""){
        return VariableModel::field_select(1,$default);
    }

    public function scopeSignature($query,$default = ""){
        return VariableModel::field_select(4,$default);
    }
}
