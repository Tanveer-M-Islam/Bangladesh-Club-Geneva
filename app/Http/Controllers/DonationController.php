<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Donation;

class DonationController extends Controller
{
    public function index()
    {
        $donationSetting = \App\Models\DonationSetting::first();
        return view('donation', compact('donationSetting'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'amount' => 'required|numeric|min:1',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('donations', 'public');
            $validated['payment_proof'] = $path;
        }

        Donation::create($validated);

        return redirect()->back()->with('success', 'Your donation details have been submitted successfully. We will verify and process it shortly.');
    }
}
