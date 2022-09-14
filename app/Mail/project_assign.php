<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Project;
use App\Models\User;
use LaraSnap\LaravelAdmin\Models\Role;
use Illuminate\Http\Request;


class project_assign extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project,User $user)
    {
        $this->project = $project;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->subject('Zaigo HRMS :New Project Assigned')->view('email.project',['project'=>$this->project,'users'=>$this->user]);
    }
}
