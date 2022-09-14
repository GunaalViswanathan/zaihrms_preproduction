<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use app\Models\User;
use app\Models\Report;
use App\Models\Project;
use Carbon\Carbon;
use DB;

class DailyReport extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, array $report)
    {
        $this->user = $user;
        $this->report = $report;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
        foreach($this->report as $key=> $values){
            $dateArray[$key] = dateFormat($values['date'],'d-m-Y');
            // $projectArray[$key] = $values['project_name'];
        }
        $dateReport =  implode(',',array_unique($dateArray));
        // $getProject = implode(',',array_unique($projectArray));       
        return $this->subject('Zaigo HRMS : ' . reportingName(auth()->user()->id) . ' :: Daily Report :: ' .$dateReport. '')->view('email.daily_report', ['users' => $this->user, 'report' => $this->report, 'name' => reportingName($this->user->reporting_to)]);
    }
}
