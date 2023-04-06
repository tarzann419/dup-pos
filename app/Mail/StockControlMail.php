<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StockControlMail extends Mailable
{
    use Queueable, SerializesModels;
    public $prod_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($prod_name)
    {
        $this->prod_name = $prod_name;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Stock Control Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.stockControl',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }

    /**
     * Build the message
     * 
     * @return $this
     */

    public function build()
    {
        return $this->from('danogbo0@gmail.com')->markdown('emails.stockControl');
    }
}