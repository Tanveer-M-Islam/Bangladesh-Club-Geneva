@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="relative pt-40 pb-20 lg:pt-56 lg:pb-32 overflow-hidden bg-gray-900">
    <div class="absolute inset-0 bg-gray-800 opacity-50"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" id="membership-hero-content">
        <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight">Be a Member</h1>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto font-light">Join our community and contribute to the club's vision. Please fill out the form below to apply.</p>
        <div class="w-24 h-1.5 bg-red-600 mx-auto mt-8 rounded-full"></div>
    </div>
</section>

<div class="bg-[#f8f9fa] py-16 md:py-24 min-h-screen overflow-x-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if(session('success'))
            <div class="mb-8 p-4 md:p-6 bg-green-50 border-l-4 border-green-500 rounded-r-lg flex items-start">
                <svg class="w-6 h-6 text-green-500 mt-0.5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div class="text-green-800 font-medium">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-start">
            
            <!-- Left Side: Payment / Bank Information (Animated Left to Right) -->
            <div class="space-y-8 py-4 lg:pl-4 membership-info-card">
                
                <div class="bg-white p-8 md:p-10 rounded-3xl shadow-[0_5px_40px_rgb(0,0,0,0.06)] border border-gray-100">
                    <div class="flex items-center mb-8">
                        <div class="shrink-0 flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-br from-[#2ecc71] to-[#27ae60] shadow-lg shadow-green-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <h2 class="ml-5 text-2xl font-black text-gray-900 uppercase tracking-tight">Payment Details</h2>
                    </div>

                    <div class="prose prose-green max-w-none text-gray-600">
                        @if($setting && $setting->payment_details)
                            {!! $setting->payment_details !!}
                        @else
                            <p class="italic text-gray-400">Bank and payment details will be appearing here soon. Please contact the administrator for more information.</p>
                        @endif
                    </div>
                </div>

                <!-- Why Join Card -->
                <div class="bg-gradient-to-br from-gray-900 to-gray-800 p-8 md:p-10 rounded-3xl shadow-xl border border-gray-700 text-white overflow-hidden relative group">
                    <div class="absolute -bottom-12 -right-12 w-48 h-48 bg-red-600/10 rounded-full blur-3xl group-hover:bg-red-600/20 transition-colors duration-500"></div>
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <span class="w-2 h-8 bg-red-600 mr-4 rounded-full"></span>
                        Why Join Us?
                    </h3>
                    <ul class="space-y-4 text-gray-300 font-light">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-[#2ecc71] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Connect with the Bangladeshi community in Geneva.
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-[#2ecc71] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Access to exclusive club events and facilities.
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-[#2ecc71] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Support cultural and social initiatives.
                        </li>
                    </ul>
                </div>
                
            </div>
            
            <!-- Right Side: Registration Form (Animated Right to Left) -->
            <div class="bg-white rounded-3xl shadow-[0_5px_40px_rgb(0,0,0,0.06)] p-8 md:p-12 border border-gray-100 relative overflow-hidden membership-form-card">
                <!-- Decorative subtle element in corner -->
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-green-50 rounded-full blur-3xl opacity-60"></div>

                <h2 class="text-center font-outfit text-xl tracking-wider text-gray-900 mb-10 uppercase font-bold">
                    Registration Form
                </h2>
                
                <form action="{{ route('membership.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6 relative z-10 w-full">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2" for="name">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                   class="block w-full border-0 border-b-2 border-gray-200 bg-transparent py-3 text-sm text-gray-900 focus:border-[#2ecc71] focus:ring-0 placeholder-gray-400 transition-colors bg-white/50"
                                   placeholder="John Doe">
                            @error('name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2" for="email">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                   class="block w-full border-0 border-b-2 border-gray-200 bg-transparent py-3 text-sm text-gray-900 focus:border-[#2ecc71] focus:ring-0 placeholder-gray-400 transition-colors bg-white/50"
                                   placeholder="john@example.com">
                            @error('email')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2" for="contact_number">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number') }}" required
                                   class="block w-full border-0 border-b-2 border-gray-200 bg-transparent py-3 text-sm text-gray-900 focus:border-[#2ecc71] focus:ring-0 placeholder-gray-400 transition-colors bg-white/50"
                                   placeholder="+41 79 123 45 67">
                            @error('contact_number')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2" for="blood_group">Blood Group</label>
                            <select name="blood_group" id="blood_group" required
                                    class="block w-full border-0 border-b-2 border-gray-200 bg-transparent py-3 text-sm text-gray-900 focus:border-[#2ecc71] focus:ring-0 placeholder-gray-400 transition-colors bg-white/50">
                                <option value="" disabled selected>Select Group</option>
                                <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>O-</option>
                            </select>
                            @error('blood_group')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2" for="gender">Gender</label>
                            <select name="gender" id="gender" required
                                    class="block w-full border-0 border-b-2 border-gray-200 bg-transparent py-3 text-sm text-gray-900 focus:border-[#2ecc71] focus:ring-0 placeholder-gray-400 transition-colors bg-white/50">
                                <option value="" disabled selected>Select Gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Payment Proof & Member Photo -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4">
                        <div class="space-y-3">
                            <label for="payment_proof" class="block text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Payment Proof <span class="text-red-500">*</span></label>
                            <div class="relative group">
                                <div class="absolute -inset-0.5 bg-gradient-to-r from-green-500 to-[#2ecc71] rounded-xl blur opacity-10 group-hover:opacity-30 transition duration-300"></div>
                                <input type="file" name="payment_proof" id="payment_proof" required
                                    class="relative w-full px-3 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#2ecc71] focus:border-transparent outline-none transition-all cursor-pointer file:mr-3 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                                    accept="image/*">
                            </div>
                            <p class="text-[10px] text-gray-400 ml-1 italic leading-relaxed">Please upload a receipt or screenshot of your payment.</p>
                            @error('payment_proof')
                                <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-3">
                            <label for="member_photo" class="block text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Profile Picture <span class="text-red-500">*</span></label>
                            <div class="relative group">
                                <div class="absolute -inset-0.5 bg-gradient-to-r from-green-500 to-[#2ecc71] rounded-xl blur opacity-10 group-hover:opacity-30 transition duration-300"></div>
                                <input type="file" name="member_photo" id="member_photo" required
                                    class="relative w-full px-3 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#2ecc71] focus:border-transparent outline-none transition-all cursor-pointer file:mr-3 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                                    accept="image/*">
                            </div>
                            <p class="text-[10px] text-gray-400 ml-1 italic leading-relaxed">This photo will be used for your ID card and directory.</p>
                            @error('member_photo')
                                <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2" for="address">Residential Address</label>
                        <textarea name="address" id="address" rows="3" required
                                  class="block w-full border-0 border-b-2 border-gray-200 bg-transparent py-3 text-sm text-gray-900 focus:border-[#2ecc71] focus:ring-0 placeholder-gray-400 resize-none transition-colors bg-white/50"
                                  placeholder="Your full address in Geneva..">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-center pt-8">
                        <button type="submit" 
                                class="inline-flex justify-center items-center rounded-full bg-[#2ecc71] hover:bg-[#27ae60] px-16 py-4 text-sm font-bold text-white shadow-lg shadow-green-500/20 hover:shadow-green-500/40 hover:-translate-y-0.5 transition-all duration-300 w-full md:w-auto uppercase tracking-widest">
                            Submit Application
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        if (typeof gsap !== 'undefined') {
            // Animate Info Card (Left to Right)
            gsap.from('.membership-info-card', {
                duration: 1,
                x: -60,
                opacity: 0,
                ease: 'power3.out',
                delay: 0.1
            });

            // Animate Form Card (Right to Left)
            gsap.from('.membership-form-card', {
                duration: 1,
                x: 60,
                opacity: 0,
                ease: 'power3.out',
                delay: 0.3
            });

            // Hero content animation
            gsap.from('#membership-hero-content', {
                duration: 1.2,
                y: 40,
                opacity: 0,
                ease: 'back.out(1.7)'
            });
        }
    });
</script>

@endsection
