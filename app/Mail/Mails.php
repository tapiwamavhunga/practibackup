<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Mails extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    /**
     * Create a new message instance.
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Campaign',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function build(): Content
    // {
    //     return new Content(
    //         view: 'mails.campaign',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }


    public function build()

    {

        return $this->subject('Mail from ItSolutionStuff.com')

                    ->view('mails.campaign');

    }

}
