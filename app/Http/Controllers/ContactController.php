<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Contact;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validate form fields
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Save to database
        Contact::create($validated);

        // Log the form data
        Log::info('Contact form submitted', $validated);

        // Example: Sending email
        try {
            Mail::raw("Name: {$validated['username']}\nPhone: {$validated['phone']}\nMessage: {$validated['message']}", function ($message) use ($validated) {
                $message->to('admin@example.com') // The email you want to receive the contact form
                        ->subject($validated['subject'])
                        ->from($validated['email']) // Your email (the sender's email)
                        ->replyTo($validated['email']); // Set the reply-to address to the user's email
            });

            Log::info('Contact email sent successfully to admin@example.com');
        } catch (\Exception $e) {
            Log::error('Failed to send contact email', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to send your message. Please try again later.');
        }

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
