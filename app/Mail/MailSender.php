<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailSender extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $title;
    public $views;

    /**
     * Create a new message instance.
     */
    public function __construct($title, $views, $data)
    {
        $this->title = $title;
        $this->views = $views;
        $this->data = $data;
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->subject($this->title)->view('emails.'.$this->views)->with(['data' => $this->data]);

    }
}
