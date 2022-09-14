<?php

namespace App\Mail;

use App\Models\HelpDesk;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Tickets extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $tickets;
    public function __construct(HelpDesk $tickets)
    {
        $this->tickets= $tickets;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(loginUserRole(auth()->user()->id) == 'Employee'){
            return $this->markdown('email.tickets')
                ->subject('Zaigo HRMS : Ticket - Employee has raised new ticket(#' .$this->tickets->ticket_id.').')
                ->with('data',$this->tickets);
        }
        else{
            return $this->markdown('email.tickets')
                ->subject('Zaigo HRMS : Ticket (#' .$this->tickets->ticket_id.')'. ' status has been updated by our admin')
                ->with('data',$this->tickets);
        }


    }
}
