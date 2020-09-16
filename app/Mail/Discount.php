<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Discount extends Mailable
{
    use Queueable, SerializesModels;
    public $percent;
    public $date;
    public $plans;
    public $baseurl;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($percent, $date,$plans,$baseurl)
    {
        $this->percent = $percent;
        $this->date = $date;
        $this->plans = $plans;
          $this->baseurl = $baseurl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.newdiscount')
            ;
    }
}
