<?php

namespace App\Http\Helpers;

class WhereHelper
{
    public static function where_array($query,$array,$sign = "="){
        $where = "";
        if(count($array)){
            if(isset($_GET['search'])){
                if(!empty($_GET['search'])){
                    $search = $_GET['search'];
                    $query->where($array[0],$sign,$search);
                    unset($array[0]);
                    foreach($array as $ar){
                        $query->orWhere($ar,$sign,$search);
                    }
                }
            }
        }
        return $query;
    }
}