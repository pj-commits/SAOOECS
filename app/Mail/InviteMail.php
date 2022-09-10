<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $formFields,  $currOrg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($formFields,  $currOrg)
    {
        $this->position = $position;
        $this->role = $role;
        $this->orgName = $orgName;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.invite');
    }
}
