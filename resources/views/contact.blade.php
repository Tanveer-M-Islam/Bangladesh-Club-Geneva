@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="relative pt-40 pb-20 lg:pt-56 lg:pb-32 overflow-hidden bg-gray-900">
    <div class="absolute inset-0 bg-gray-800 opacity-50"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" id="news-hero-content">
        <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight">Contact Us</h1>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto font-light">We'd love to hear from you. Please reach out to us using the form or the details below.</p>
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
            
            <!-- Left Side: Contact Information (Animated Left to Right) -->
            <div class="space-y-8 py-4 lg:pl-4 contact-info-card">
                
                <!-- Organization -->
                <div class="flex items-start bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="shrink-0 flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-br from-[#2ecc71] to-[#27ae60] shadow-lg shadow-green-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div class="ml-6 flex flex-col justify-center">
                        <h3 class="text-lg font-bold text-gray-900 leading-tight mb-1">Organization</h3>
                        <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                            Bangladesh Club Geneva<br>
                            <span class="text-gray-400 font-medium">Reg No: CHE-420.657.820</span>
                        </p>
                    </div>
                </div>
                
                <!-- Phone -->
                <div class="flex items-start bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="shrink-0 flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-br from-[#2ecc71] to-[#27ae60] shadow-lg shadow-green-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    </div>
                    <div class="ml-6 flex flex-col justify-center">
                        <h3 class="text-lg font-bold text-gray-900 leading-tight mb-1">Phone</h3>
                        <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                            +41798117745, +41798127544, +41787656150
                        </p>
                    </div>
                </div>
                
                <!-- Email -->
                <div class="flex items-start bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="shrink-0 flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-br from-[#2ecc71] to-[#27ae60] shadow-lg shadow-green-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="ml-6 flex flex-col justify-center">
                        <h3 class="text-lg font-bold text-gray-900 leading-tight mb-1">Email</h3>
                        <p class="text-sm md:text-base text-gray-600 leading-relaxed break-all">
                            info@bangladeshclubgeneva.ch
                        </p>
                    </div>
                </div>
                
                <!-- Location -->
                <div class="flex items-start bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="shrink-0 flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-br from-[#2ecc71] to-[#27ae60] shadow-lg shadow-green-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div class="ml-6 flex flex-col justify-center">
                        <h3 class="text-lg font-bold text-gray-900 leading-tight mb-1">Location</h3>
                        <p class="text-sm md:text-base text-gray-600 leading-relaxed max-w-sm">
                            Promenade de la Dentellière 14, 1217 Meyrin Geneva, Switzerland
                        </p>
                    </div>
                </div>
                
            </div>
            
            <!-- Right Side: Contact Form (Animated Right to Left) -->
            <div class="bg-white rounded-3xl shadow-[0_5px_40px_rgb(0,0,0,0.06)] p-8 md:p-12 border border-gray-100 relative overflow-hidden contact-form-card">
                <!-- Decorative subtle element in corner -->
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-green-50 rounded-full blur-3xl opacity-60"></div>

                <h2 class="text-center font-outfit text-xl tracking-wider text-gray-900 mb-10 uppercase font-bold">
                    GET IN TOUCH
                </h2>
                
                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-8 relative z-10 w-full max-w-md mx-auto">
                    @csrf
                    
                    <div>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="block w-full border-0 border-b-2 border-gray-200 bg-transparent py-3 text-sm text-gray-900 focus:border-[#2ecc71] focus:ring-0 placeholder-gray-400 transition-colors bg-white/50"
                               placeholder="Name">
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                               class="block w-full border-0 border-b-2 border-gray-200 bg-transparent py-3 text-sm text-gray-900 focus:border-[#2ecc71] focus:ring-0 placeholder-gray-400 transition-colors bg-white/50"
                               placeholder="Email">
                        @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}"
                               class="block w-full border-0 border-b-2 border-gray-200 bg-transparent py-3 text-sm text-gray-900 focus:border-[#2ecc71] focus:ring-0 placeholder-gray-400 transition-colors bg-white/50"
                               placeholder="Phone Number">
                        @error('phone_number')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <textarea name="message" id="message" rows="4" required
                                  class="block w-full border-0 border-b-2 border-gray-200 bg-transparent py-3 text-sm text-gray-900 focus:border-[#2ecc71] focus:ring-0 placeholder-gray-400 resize-none transition-colors bg-white/50"
                                  placeholder="Message..">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-center pt-6 pb-2">
                        <button type="submit" 
                                class="inline-flex justify-center items-center rounded-full bg-[#2ecc71] hover:bg-[#27ae60] px-12 py-3.5 text-sm font-bold text-white shadow-lg shadow-green-500/20 hover:shadow-green-500/40 hover:-translate-y-0.5 transition-all duration-300">
                            Send
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
            // Animate Contact Info Card (Left to Right)
            gsap.from('.contact-info-card', {
                duration: 1,
                x: -60,
                opacity: 0,
                ease: 'power3.out',
                delay: 0.1
            });

            // Animate Form Card (Right to Left)
            gsap.from('.contact-form-card', {
                duration: 1,
                x: 60,
                opacity: 0,
                ease: 'power3.out',
                delay: 0.3
            });
        }
    });
</script>

@endsection
