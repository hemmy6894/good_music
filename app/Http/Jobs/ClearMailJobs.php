<?php

namespace App\Job;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use App\Models\Helpers\PendingMailModel;
use App\Models\Helpers\VariableModel;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ClearMailJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        //
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $id = $this->user;
        $pendings = PendingMailModel::by_column(['user_id' => $id,'state' => 0]);
        if($pendings->count()){
                    $pendings = $pendings->get();
                    foreach($pendings as $pending){
                        $email =    [
                                        'subject' => $pending->subject,
                                        'signature' =>  $pending->signature,
                                        'status' =>  $pending->subject,
                                        'track_no' =>  $pending->subject,
                                        'link' =>  $pending->attachment,
                                        'to_email' =>  explode(',',$pending->to),
                                        'to_name' => $pending->to_name,
                                        'from_email' => $pending->from, 
                                        'body' => $pending->body, 
                                        'template' => $pending->template,
                                        'from_name' => $pending->from_name,
                                        'reply_email' => $pending->reply_to,
                                        'attachment' => $pending->attachment
                                    ];
                        $email = $this->sendMail($email);
                        // print_r($email);
                        // return;
                        PendingMailModel::where('id',$pending->id)->update(['state' => 1]);
                        echo "pending mail cleared";
                    }
                }else{
                    echo "No pending mail";
                }
    }

    public static function sendMail($email){    $data = $email;
        return  Mail::send('pages.mail', $email, function($message) use ($email) {
            $message->to($email['to_email'], $email['to_name'])
                    ->subject($email['subject']);
            $message->cc(VariableModel::cc_mail(),"Operation Team");
            $message->bcc('hemmy6894@gmail.com',"Developer Mail");
            $message->from(VariableModel::cc_mail(),$email['from_name']);
            $message->replyTo(VariableModel::reply_to());
            if($email['attachment'] != ""){
                $attachements = explode(',',$email['attachment']);
                $i = 0;
                foreach($attachements as $attachement){
                    $message->attach($attachement);
                }
            }
        });
    }
}
