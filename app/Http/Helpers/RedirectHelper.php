<?php

namespace App\Http\Helpers;

class RedirectHelper
{
    //
    public static function back_error($sms, $header, $type){
        return redirect()->back()->withErrors(['sms' => $sms, 'heading' => $header, 'type' => $type]);
    }

    public static function back(){
        return redirect()->back();
    }

    public static function link($link){
        return redirect()->route($link);
    }

    public static function link_error($link, $sms, $header, $type){
        return redirect()->route($link)->withErrors(['sms' => $sms, 'heading' => $header, 'type' => $type]);
    }

    public static function valid($validator){
        return redirect()->back()->withErrors($validator);
    }

    public static function valid_link($link, $validator){
        return redirect()->route($link)->withErrors($validator);
    }

    public static function create_sms($state,$link = "no"){
        if($state){
            return RedirectHelper::has_link(__('words.created_success'),__('words.successfully'),"success",$link);
        }
        return RedirectHelper::has_link(__('words.failed_to_create'),__('words.failed'),"danger",$link);
    }

    public static function not_found($sms = "",$link = "no"){
        return RedirectHelper::has_link($sms . __('words.failed_to_create'),__('words.failed'),"danger",$link);
    }

    public static function update_sms($state,$link = "no"){
        if($state){
            return RedirectHelper::has_link(__('words.updated_success'),__('words.successfully'),"success",$link);
        }
        return RedirectHelper::has_link(__('words.failed_to_update'),__('words.failed'),"danger",$link);
    }

    public static function has_link($sms,$header,$type,$link = "no"){
        if($link != "no")
            return RedirectHelper::link_error($link,$sms,$header,$type);
        return RedirectHelper::back_error($sms,$header,$type);
    }


    public static function donwnload_url(){
        if(count($_GET)){
            return \url()->full() . "&download";
        }else{
            return \url()->full() . "?download";
        }
    }

    public static function payslip(){
        if(count($_GET)){
            return \url()->full() . "&payslip";
        }else{
            return \url()->full() . "?payslip";
        }
    }

    public static function block_user($user){
        if(!empty($_GET['block'])){
            $block = $_GET['block'];
            if($block){
                $block = 0;
            }else{
                $block = 1;
            }
        }else{
            $block = 1; 
        }
        $user->update(['status' => $block]);
        if(!$block){
            $sms = __('words.successfull_blocked');
        }else{
            $sms = __('words.successfull_unblocked');
        }
        return RedirectHelper::back_error($sms,__('words.successfully'),'success');
    }
}
