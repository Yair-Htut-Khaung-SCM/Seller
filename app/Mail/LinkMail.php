<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $link;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($link, $email)
    {
        $this->link = $link;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.link', [
            'link' => $this->link,
            'email' => $this->email,
        ]);
    }
}
