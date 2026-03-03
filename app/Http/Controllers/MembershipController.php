<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembershipApplication;
use App\Models\MembershipSetting;

class MembershipController extends Controller
{
    public function index()
    {
        $setting = MembershipSetting::first();
        return view('be-a-member', compact('setting'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|string|max:255',
            'blood_group' => 'required|string|max:10',
            'gender' => 'required|string|in:male,female,other',
            'address' => 'required|string',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'member_photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('memberships/proofs', 'public');
            $validated['payment_proof'] = $path;
        }

        if ($request->hasFile('member_photo')) {
            $path = $request->file('member_photo')->store('memberships/photos', 'public');
            $validated['member_photo'] = $path;
        }

        MembershipApplication::create($validated);

        return back()->with('success', 'Your membership application has been submitted successfully! We will review your payment proof and activate your membership soon.');
    }
}
