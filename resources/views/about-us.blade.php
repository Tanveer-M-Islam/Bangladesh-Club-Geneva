@extends('layouts.app')

@section('content')
<!-- Hero Section for About Us -->
<section class="relative pt-40 pb-20 lg:pt-56 lg:pb-32 overflow-hidden bg-gray-900">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/about-hero-bg.jpg') }}'); opacity: 0.3;"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" id="about-hero-content">
        <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight">About Us</h1>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto font-light">Discover the mission, vision, and principles guiding the Bangladesh Club Geneva.</p>
        <div class="w-24 h-1.5 bg-red-600 mx-auto mt-8 rounded-full"></div>
    </div>
</section>

<!-- Content Sections -->
<div class="bg-gray-50 py-12 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 lg:space-y-32">
        
        <!-- Mission Section -->
        <section id="mission-section" class="relative">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 flex flex-col lg:flex-row group">
                <div class="lg:w-1/2 p-6 sm:p-10 lg:p-16 flex flex-col justify-center about-card-content">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-6 lg:mb-8 text-center sm:text-left">
                        <div class="w-16 h-16 mx-auto sm:mx-0 bg-red-50 rounded-2xl flex items-center justify-center text-red-600 shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-black text-gray-900 uppercase tracking-tighter">{{ $aboutBcgSetting?->mission_title ?? 'Our Mission' }}</h2>
                    </div>
                    <div class="prose prose-base lg:prose-lg text-gray-600 leading-relaxed max-w-none text-center sm:text-left overflow-y-auto max-h-[400px] scrollbar-custom pr-4">
                        @if($aboutBcgSetting?->mission_text)
                            {!! $aboutBcgSetting->mission_text !!}
                        @else
                            <p>Our mission is to foster community, preserve cultural heritage, and support our members in Geneva.</p>
                        @endif
                    </div>
                </div>
                <div class="lg:w-1/2 relative min-h-[250px] sm:min-h-[300px] lg:min-h-[400px] overflow-hidden about-card-image">
                    @if($aboutBcgSetting?->mission_image_path)
                        <img src="{{ asset('storage/' . $aboutBcgSetting->mission_image_path) }}" alt="Mission" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                    @else
                        <div class="absolute inset-0 bg-gray-200 flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/20 to-transparent lg:block hidden"></div>
                </div>
            </div>
        </section>

        <!-- Vision Section -->
        <section id="vision-section" class="relative">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 flex flex-col-reverse lg:flex-row group">
                <div class="lg:w-1/2 relative min-h-[250px] sm:min-h-[300px] lg:min-h-[400px] overflow-hidden about-card-image">
                    @if($aboutBcgSetting?->vision_image_path)
                        <img src="{{ asset('storage/' . $aboutBcgSetting->vision_image_path) }}" alt="Vision" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                    @else
                        <div class="absolute inset-0 bg-gray-200 flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-l from-white via-white/20 to-transparent lg:block hidden"></div>
                </div>
                <div class="lg:w-1/2 p-6 sm:p-10 lg:p-16 flex flex-col justify-center about-card-content">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-6 lg:mb-8 text-center sm:text-left">
                        <div class="w-16 h-16 mx-auto sm:mx-0 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-black text-gray-900 uppercase tracking-tighter">{{ $aboutBcgSetting?->vision_title ?? 'Our Vision' }}</h2>
                    </div>
                    <div class="prose prose-base lg:prose-lg text-gray-600 leading-relaxed max-w-none text-center sm:text-left overflow-y-auto max-h-[400px] scrollbar-custom pr-4">
                        @if($aboutBcgSetting?->vision_text)
                            {!! $aboutBcgSetting->vision_text !!}
                        @else
                            <p>To be the premier platform uniting the Bangladeshi diaspora in Geneva for mutual growth and cultural exchange.</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Rules Section -->
        <section id="rules-section" class="relative">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 flex flex-col lg:flex-row group">
                <div class="lg:w-1/2 p-6 sm:p-10 lg:p-16 flex flex-col justify-center about-card-content">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-6 lg:mb-8 text-center sm:text-left">
                        <div class="w-16 h-16 mx-auto sm:mx-0 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-black text-gray-900 uppercase tracking-tighter">Membership Policy</h2>
                    </div>
                    <div class="prose prose-base lg:prose-lg text-gray-600 leading-relaxed max-w-none sm:text-left overflow-y-auto max-h-[400px] scrollbar-custom pr-4">
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
                <div class="lg:w-1/2 relative min-h-[250px] sm:min-h-[300px] lg:min-h-[400px] overflow-hidden about-card-image">
                    @if($aboutBcgSetting?->terms_image_path)
                        <img src="{{ asset('storage/' . $aboutBcgSetting->terms_image_path) }}" alt="Terms" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                    @else
                        <div class="absolute inset-0 bg-gray-200 flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/20 to-transparent lg:block hidden"></div>
                </div>
            </div>
        </section>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        gsap.registerPlugin(ScrollTrigger);

        // Hero Animation
        gsap.from("#about-hero-content > *", {
            y: 50,
            opacity: 0,
            duration: 1,
            stagger: 0.2,
            ease: "power3.out"
        });

        // Setup common scroll animation for each section
        const sections = ['#mission-section', '#vision-section', '#rules-section'];

        sections.forEach((section, index) => {
            const isReverse = index % 2 !== 0; // Vision is reversed
            const content = document.querySelector(`${section} .about-card-content`);
            const image = document.querySelector(`${section} .about-card-image`);

            // Content comes from side (or bottom on mobile)
            const isMobile = window.innerWidth < 1024;
            
            gsap.from(content, {
                scrollTrigger: {
                    trigger: section,
                    start: "top 80%",
                },
                x: isMobile ? 0 : (isReverse ? 100 : -100),
                y: isMobile ? 50 : 0,
                opacity: 0,
                duration: 1.2,
                ease: "power4.out"
            });

            // Image comes from opposite side
            gsap.from(image, {
                scrollTrigger: {
                    trigger: section,
                    start: "top 80%",
                },
                x: isMobile ? 0 : (isReverse ? -100 : 100),
                y: isMobile ? 50 : 0,
                opacity: 0,
                duration: 1.2,
                delay: isMobile ? 0 : 0.2, // no delay on mobile as it's stacked
                ease: "power4.out"
            });
        });
    });
</script>
@endsection
