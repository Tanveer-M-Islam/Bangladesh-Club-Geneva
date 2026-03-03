@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative pt-40 pb-20 lg:pt-56 lg:pb-32 bg-gray-900 overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/hero-bg.jpg') }}'); opacity: 0.3;"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" id="donation-hero-content">
        <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight">Support BCG</h1>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto font-light">Your donations help us organize events and support the community.</p>
        <div class="w-24 h-1.5 bg-red-600 mx-auto mt-8 rounded-full"></div>
    </div>
</section>

<div class="bg-gray-50 py-16 lg:py-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if(session('success'))
            <div class="max-w-4xl mx-auto mb-10 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm animate-bounce" role="alert">
                <p class="font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <!-- Left: Payment Details -->
            <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100" id="left-side">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    Payment Methods
                </h2>
                
                <div class="space-y-6">
                    <div class="p-6 bg-gray-50 rounded-2xl border border-gray-200">
                        <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Bank Transfer</h3>
                        <div class="space-y-2 text-gray-700 font-medium">
                            <p class="flex justify-between"><span>Bank:</span> <span class="text-gray-900">{{ $donationSetting->bank_name ?? 'UBS Switzerland AG' }}</span></p>
                            <p class="flex justify-between"><span>IBAN:</span> <span class="text-gray-900">{{ $donationSetting->bank_iban ?? 'CH12 3456 7890 1234 5678 9' }}</span></p>
                            <p class="flex justify-between"><span>Account:</span> <span class="text-gray-900">{{ $donationSetting->bank_account_name ?? 'Bangladesh Club Geneva' }}</span></p>
                        </div>
                    </div>

                    <div class="p-6 bg-red-50 rounded-2xl border border-red-100">
                        <h3 class="text-sm font-bold text-red-600 uppercase tracking-wider mb-2">TWINT</h3>
                        <p class="text-2xl font-black text-red-700">{{ $donationSetting->twint_number ?? '+41 79 123 45 67' }}</p>
                        <p class="text-xs text-red-500 mt-1 italic">Scan or send to this number</p>
                    </div>
                </div>

                <div class="mt-8 p-4 bg-blue-50 text-blue-700 rounded-xl text-sm leading-relaxed">
                    <strong>Note:</strong> {{ $donationSetting->donation_note ?? 'Please upload a screenshot or photo of your payment confirmation using the form on the right.' }}
                </div>
            </div>

            <!-- Right: Form -->
            <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100" id="right-side">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Donation Form
                </h2>

                <form action="{{ route('donation.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none" value="{{ old('name') }}">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none" value="{{ old('email') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Phone</label>
                            <input type="tel" name="phone" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none" value="{{ old('phone') }}">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Amount (CHF)</label>
                        <input type="number" step="0.01" name="amount" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none text-xl font-bold" placeholder="0.00" value="{{ old('amount') }}">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Payment Proof (Image)</label>
                        <input type="file" name="payment_proof" accept="image/*" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none text-sm">
                    </div>

                    <button type="submit" class="w-full py-4 bg-red-600 text-white font-bold rounded-xl shadow-lg hover:bg-red-700 transition-all transform hover:scale-[1.02] active:scale-95">
                        Submit Donation
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Hero Content Entrance
        gsap.from("#donation-hero-content > *", {
            y: 50,
            opacity: 0,
            duration: 1,
            stagger: 0.2,
            ease: "power3.out"
        });

        gsap.from("#left-side", { opacity: 0, x: -50, duration: 1, delay: 0.4, ease: "power2.out" });
        gsap.from("#right-side", { opacity: 0, x: 50, duration: 1, delay: 0.6, ease: "power2.out" });
    });
</script>
@endsection
