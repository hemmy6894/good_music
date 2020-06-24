<?php

namespace App\Http\Helpers;

class PaginateHelper
{
    public static function per_page($num = 10){
        if(isset($_GET['per_page'])){
            if(!empty($_GET['per_page'])){
                $per_page = $_GET['per_page'];
                if(\is_numeric($per_page)){
                    return $per_page;
                }
                return 9999999999;
            }
        }
        return $num;
    }
}