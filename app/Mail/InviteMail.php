<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $currOrgName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($currOrgName) 
    {
        // $this->position = $position;
        // $this->role = $role;
        $this->currOrgName = $currOrgName;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.invite')
                    ->subject('SAO Invitation');
    }
}
