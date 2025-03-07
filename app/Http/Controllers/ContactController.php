<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmission;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Store a new contact form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:10'],
        ], [
            'name.required' => 'Please provide your name.',
            'email.required' => 'Please provide your email address.',
            'email.email' => 'Please provide a valid email address.',
            'message.required' => 'Please write your message.',
            'message.min' => 'Your message should be at least 10 characters long.',
        ]);

        try {
            // Store the contact submission in the database
            $contact = Contact::create($validated);
        
            // Send email notification
            Mail::to(config('mail.admin_email', 'alfatiktok02@gmail.com'))
                ->send(new ContactFormSubmission($contact));
        
            // Redirect with success message
            return back()->with('success', 'Thank you for your message! We will get back to you soon.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Contact form submission failed: ' . $e->getMessage());
        
            // Redirect with error message
            return back()
                ->withInput()
                ->with('error', 'Sorry, there was a problem sending your message. Please try again later.');
        }
        
    }
}