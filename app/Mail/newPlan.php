<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newPlan extends Mailable
{
    use Queueable, SerializesModels;
    public $title;
    public $content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.newplan')
            ;
    }
}
