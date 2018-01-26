<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class contactForm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * De gegeven gebruikers invoer.
     *
     * @var $input
     */
    public $input;

    /**
     * Create a new message instance.
     *
     * @param  array $input De gegeven gebruikers invoer.
     * @return void
     */
    public function __construct(array $input)
    {
        $this->input = $input;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->input['email'], $this->input['naam'])
            ->subject($this->input['onderwerp'])
            ->view('emails.contact', ['input' => $this->input]);
    }
}
