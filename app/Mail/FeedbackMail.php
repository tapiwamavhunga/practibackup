<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;
    public $from_email, $from_name, $subject, $body;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from_email, $from_name, $subject, $body)
    {
        $this->from_email = $from_email;
        $this->from_name = $from_name;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->from_email, $this->from_name)
                    ->subject($this->subject)
                    ->markdown('emails.feedback')
                    ->with([
                        'feedback' => $this->body,
                        'brochure_link' => 'https://www.medinformer.co.za/health_subjects/'
                    ]);
    }
}



