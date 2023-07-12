<?php

namespace App\Mail;

use AWS\CRT\HTTP\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;

class Contato extends Mailable
{
    use Queueable, SerializesModels;

    public $fromContato;
    public $nameContato;
    public $lastNameContato;
    public $assuntoContato;
    public $mergeNames;
    public $messageContato;

    /**
     * Create a new message instance.
     */
    public function __construct($from, $name, $lastName, $assunto, $message)
    {
        $this->fromContato = $from;
        $this->nameContato = $name;
        $this->lastNameContato = $lastName;
        $this->assuntoContato = $assunto;
        $this->mergeNames = $name . ' ' . $lastName;
        $this->messageContato = $message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(env('MAIL_USERNAME'), 'Peripherals Contato'),
            replyTo: [
                new Address($this->fromContato, $this->nameContato . ' ' .  $this->lastNameContato),
            ],
            subject: $this->assuntoContato,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-email',
            with: [
                'nome' => $this->mergeNames,
                'email' => $this->fromContato,
                'assunto' => $this->assuntoContato,
                'mensagem' => $this->messageContato,
            ]
        );
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
}
