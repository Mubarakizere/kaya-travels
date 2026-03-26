<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:5',
        ]);

        // Optionally send email (requires mail config)
        /*
        Mail::to('info@kayatravels.rw')->send(new ContactMessage($validated));
        */

        // Just redirect back with a success message for now
        return back()->with('success', 'Thanks for reaching out! We’ll get back to you soon.');
    }
}
