<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:50',
            'message' => 'required|string',
        ]);

        \App\Models\ContactMessage::create($validated);

        return back()->with('success', 'Your message has been sent successfully. We will get in touch with you soon!');
    }
}
