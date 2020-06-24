<?php

namespace App\Models\Helpers;

use Illuminate\Database\Eloquent\Model;

class PendingMailModel extends Model
{
    //
    protected $table = "pending_mails";
    protected $fillable = [
        'to','reply_to','subject','body','template','signature','attachment','user_id','state',
        'from','from_name','to_name'
    ];

    public function scopeCreate_Mail($query, $to = "", $service,$data,$email = null,$name = null,$attachment = null,$value = null,$job_body = null){                                       
        $company_name = VariableModel::field_select(1);
        $company_address = VariableModel::field_select(1);
        
        
        //$this->data($vehicle,'vehicle_ref_no','container_ref_no');

        $value = $value == null ? "" : $value;
        $body = $data['sms'];

        if($job_body != null){
            $body .= "\r\n\r\n" . $job_body;
        }
        

        // $tem = Email::by_type($service,1,'vehicle');
        // if($tem){
        //   $tem = $tem->get()[0];
        // }

        $tem = false;
        
        $customer_name = $data['customer_name'];
        $customer_email = $data['customer_email'];

        PendingMailModel::create([
          'to' => $to  == "" ? $customer_email : $to,
          'reply_to' => Variable::ReplyEmail(),
          'subject' => $tem != false ? $tem->getSubject() : "NULL", // BADO,
          'body' => $body, 
          'template' => $tem != false ? $tem->getTemplate() : "NULL", ///badp
          'signature' => $company_address,// . "\r\n\r\n" . $company_bank,
          'attachment' => $attachment,
          'user' => auth()->user()->id,
          'state' => 0,
          'from' => Variable::FromEmail(),
          'from_name' => $company_name,
          'to_name' => $customer_name == "" ? "Un Registered Customer" : $customer_name
        ]);
    }

    public function scopeBy_Column($query,$column){return $query->where($column);}
}
