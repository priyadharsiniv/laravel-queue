<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sender = 'admin@test.com';
        $fullNameUser = $this->data['name'];
        $from_name ='laravelqueues Test';
        $_emailUser = $this->data['email'];
        $subject = $this->data['subject'];
        $data = $this->data;
        Mail::send('welcome_user_mail',$data,function($message)use($subject,$sender,$from_name,$_emailUser,$fullNameUser) {
               $message->to($_emailUser,$fullNameUser)->subject($subject);
               $message->from($sender, $from_name);
            });
        //echo "mail sent";
    }
}
