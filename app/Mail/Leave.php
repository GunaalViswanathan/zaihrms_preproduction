<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\LeaveApply;

class Leave extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(LeaveApply $leaveApply, $user)
    {
        $this->leaveApply = $leaveApply;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->leaveApply->leave_type == 1 || $this->leaveApply->leave_type == 3) {
            if (date(setting('date_format'), strtotime($this->leaveApply->leave_from)) == date(setting('date_format'), strtotime($this->leaveApply->leave_to))) {
                $date = date(setting('date_format'), strtotime($this->leaveApply->leave_from));
            } else {
                $date = date(setting('date_format'), strtotime($this->leaveApply->leave_from)).' - '.date(setting('date_format'), strtotime($this->leaveApply->leave_to));
            }
        } elseif ($this->leaveApply->leave_type == 2) {
            $date = date(setting('date_time_format'), strtotime($this->leaveApply->leave_from)).' - '.date(setting('date_time_format'), strtotime($this->leaveApply->leave_to));
        }  
        elseif ($this->leaveApply->leave_type == 4) {
            $date = date(setting('date_format'), strtotime($this->leaveApply->leave_from));
        }    
        return $this->subject($this->leaveApply->status != 1 ? ( $this->leaveApply->status == 2 ? ( $this->leaveApply->leave_type == 1 ? 'Zaigo HRMS Leave Approved : '.date('d-m-Y') : ( $this->leaveApply->leave_type == 4 ? 'Zaigo HRMS Half Day Leave Approved : '.date('d-m-Y') : ( $this->leaveApply->leave_type == 2 ? 'Zaigo HRMS Permission Approved : '.date('d-m-Y') : 'Zaigo HRMS Work From Home Approved : '.date('d-m-Y') ) ) ) : ( $this->leaveApply->leave_type == 1 ? 'Zaigo HRMS Leave Rejected : '.date('d-m-Y') : ( $this->leaveApply->leave_type == 4 ? 'Zaigo HRMS Half Day Leave Rejected : '.date('d-m-Y') : ( $this->leaveApply->leave_type == 2 ? 'Zaigo HRMS Permission Rejected : '.date('d-m-Y') : 'Zaigo HRMS Work From Home Rejected : '.date('d-m-Y') ) ) ) ) : ( $this->leaveApply->leave_type == 1 ? 'Zaigo HRMS Leave Request : '.reportingName($this->leaveApply->user_id).' - '.$date : ( $this->leaveApply->leave_type == 4 ? 'Zaigo HRMS Half Day Leave Request : '.reportingName($this->leaveApply->user_id).' - '.$date : ( $this->leaveApply->leave_type == 2 ? 'Zaigo HRMS Permission Request : '.reportingName($this->leaveApply->user_id).' - '.$date : 'Zaigo HRMS Work From Home Request : '.reportingName($this->leaveApply->user_id).' - '.$date ) ) ) )
            ->from(reportingEmail($this->user->id), reportingName($this->user->id))
            ->view('email.leave',['leaveApply' => $this->leaveApply, 'name' => reportingName($this->user->reporting_to)]);
    }
}
