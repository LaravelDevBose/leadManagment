<?php

namespace App\Mail;

use App\Models\Inbox;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $inbox;

    /**
     * Create a new message instance.
     *
     * @param Inbox $inbox
     */
    public function __construct(Inbox $inbox)
    {
        $this->inbox = $inbox;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->view('emails.admin_mail')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject(!empty($this->inbox->mail_subject)? $this->inbox->mail_subject : ' ')
            ->to($this->inbox->mail_tos);
            if (!empty($this->inbox->mail_ccs)){
                $this->cc($this->inbox->mail_ccs);
            }
            return $this;
    }
}
