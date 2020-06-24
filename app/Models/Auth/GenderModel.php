<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class GenderModel extends Model
{
    //
    protected $table = "genders";
    protected $fillable = ['name','bg_color'];

    public function scopeActive($query){
        return $query->where('status','=',1);
    }
}
