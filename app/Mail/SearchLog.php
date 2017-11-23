<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class searchlog extends Mailable
{
    use Queueable, SerializesModels;
    public $searchTerms ;


    public $title = "HOLA!";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->searchTerms = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from('info@bookingapp.com')
        ->view('emails.searchlog');
    }
}
