<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reminder;
use DB;

class reminder_mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $resourceCount;
    public function __construct(Reminder $reminder,int $resourceCount)
    {
        $this->reminder = $reminder;
        $this->resourceCount = $resourceCount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {          
        if($this->resourceCount == 1){
            return $this->subject('Zaigo HRMS ::'.reportingName($this->reminder->user_id).' :: Daily Report : First Reminder')->view('email.first_reminder_mail',['reminder'=>$this->reminder]);
        }
        elseif($this->resourceCount == 2){
            return $this->subject('Zaigo HRMS ::'.reportingName($this->reminder->user_id).' :: Daily Report : Second Reminder')->view('email.second_reminder_mail',['reminder'=>$this->reminder]);
        }
        elseif($this->resourceCount >= 3){
            return $this->subject('Zaigo HRMS :: '.reportingName($this->reminder->user_id).' :: Daily Report : Third Reminder')->view('email.third_reminder_mail',['reminder'=>$this->reminder]);
        }
        return true;
    }
}
