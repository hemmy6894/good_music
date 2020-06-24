<?php

namespace App\Models\Youtube;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChannelModel extends Model
{
    //
    //
    public $incrementing = false;
    protected $table = "channels";
    protected $fillable = ['user_id','channel_id'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (String) Str::uuid();
        });
        if(Auth::check()){
            static::addGlobalScope('user_id', function (Builder $builder) {
                $builder->where('user_id',Auth::user()->id);
            });
        }
    }
    public function scopeActive($query){
        return $query->where('status','=',1);
    }
}
