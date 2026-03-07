@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative pt-40 pb-20 lg:pt-56 lg:pb-32 overflow-hidden bg-gray-900">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/about-hero-bg.jpg') }}'); opacity: 0.3;"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" id="policy-hero-content">
        <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight">Membership Policy</h1>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto font-light">Rules, Regulations and Policies for the members of Bangladesh Club Geneva.</p>
        <div class="w-24 h-1.5 bg-red-600 mx-auto mt-8 rounded-full"></div>
    </div>
</section>

<!-- Content Sections -->
<div class="bg-gray-50 py-12 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <section id="rules-section" class="relative">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 flex flex-col lg:flex-row group">
                <div class="lg:w-1/2 p-6 sm:p-10 lg:p-16 flex flex-col justify-center about-card-content">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-6 lg:mb-8 text-center sm:text-left">
                        <div class="w-16 h-16 mx-auto sm:mx-0 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-black text-gray-900 uppercase tracking-tighter">Membership Policy</h2>
                    </div>
                    <div class="prose prose-base lg:prose-lg text-gray-600 leading-relaxed max-w-none sm:text-left pr-4">
                        @if($aboutBcgSetting?->terms_text)
                            {!! $aboutBcgSetting->terms_text !!}
                        @else
                            <ul>
                                <li>Uphold the constitution of the Bangladesh Club Geneva.</li>
                                <li>Participate actively in scheduled meetings and events.</li>
                                <li>Maintain transparency and integrity in all official duties.</li>
                            </ul>
                        @endif
                    </div>
                </div>
                <!-- Image Side -->
                <div class="lg:w-1/2 relative min-h-[300px] lg:min-h-full overflow-hidden about-card-image">
                    @if($aboutBcgSetting?->terms_image_path)
                        <img src="{{ asset('storage/' . $aboutBcgSetting->terms_image_path) }}" alt="Terms" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000">
                    @else
                        <div class="absolute inset-0 bg-gray-200 flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/40 to-transparent lg:block hidden"></div>
                </div>
            </div>
        </section>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        gsap.registerPlugin(ScrollTrigger);

        // Hero Animation
        gsap.from("#policy-hero-content > *", {
            y: 50,
            opacity: 0,
            duration: 1,
            stagger: 0.2,
            ease: "power3.out"
        });

        // Setup scroll animation for the content card
        const section = '#rules-section';
        const content = document.querySelector(`${section} .about-card-content`);
        const image = document.querySelector(`${section} .about-card-image`);

        const isMobile = window.innerWidth < 1024;
        
        if (content) {
            gsap.from(content, {
                scrollTrigger: {
                    trigger: section,
                    start: "top 80%",
                },
                x: isMobile ? 0 : -100,
                y: isMobile ? 50 : 0,
                opacity: 0,
                duration: 1.2,
                ease: "power4.out"
            });
        }

        if (image) {
            gsap.from(image, {
                scrollTrigger: {
                    trigger: section,
                    start: "top 80%",
                },
                x: isMobile ? 0 : 100,
                y: isMobile ? 50 : 0,
                opacity: 0,
                duration: 1.2,
                delay: isMobile ? 0 : 0.2,
                ease: "power4.out"
            });
        }
    });
</script>
@endsection
