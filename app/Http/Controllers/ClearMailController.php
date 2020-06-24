<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Job\ClearMailJobs;

class ClearMailController extends Controller
{
    //
    public function index(){
       if(auth()->check()){
         ClearMailJobs::dispatch(auth()->user()->id);
       }
    }
}
