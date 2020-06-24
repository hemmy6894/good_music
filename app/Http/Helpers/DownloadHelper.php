<?php

namespace App\Http\Helpers;

use Carbon\Carbon;

class DownloadHelper
{
    public static function csv($haeder,$field,$array,$name){
        $r = implode(",",$haeder) . "\n";
        foreach($array as $arr){
            foreach($field as $f){
                if(\is_array($f)){
                    $f0 = $f[0];
                    $f1 = $f[1];
                    $r .= $arr->$f0->$f1 . ",";
                }else{
                    $fs = \explode(",",$f);
                    $d = "";
                    foreach($fs as $f){
                        $d .= $arr->$f . " ";
                    }
                    $r .= $d. ",";
                }
            }
            $r .= "\n";
        }
        $name = Carbon::now()->format('YmdHms') . "__" . $name;
        return response()->download_csv($r,$name);

    }
}