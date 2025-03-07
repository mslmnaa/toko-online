<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmission extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    /**
     * Create a new message instance.
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->markdown('emails.contact.submission')
                    ->subject('New Contact Form Submission')
                    ->with([
                        'name' => $this->contact->name,
                        'email' => $this->contact->email,
                        'message' => $this->contact->message,
                    ]);
    }
}

