<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactNotification;
use App\Mail\ContactReceivedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Create the contact
        $contact = Contact::create($validated);

        // Send the notification email
        Mail::to($contact->email)->send(new ContactReceivedNotification());

        Mail::to('contato@potiguaragrow.com.br')->send(new ContactNotification($contact));

        return back()->with('success', 'Your message has been sent!');
    }
}
