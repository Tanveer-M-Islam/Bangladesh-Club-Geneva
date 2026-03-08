@extends('layouts.app')

@section('content')
<div class="relative min-h-screen overflow-hidden" x-data="{ 
    activeSlide: 0, 
    slides: {{ json_encode($siteSetting && !empty($siteSetting->hero_slider_images) ? $siteSetting->hero_slider_images : ['https://images.unsplash.com/photo-1590059300624-9b884967384a?q=80&w=2670&auto=format&fit=crop', 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=2670&auto=format&fit=crop']) }},
    storageUrl: '{{ asset('storage') }}/',
    init() {
        console.log('Slider initialized with slides:', this.slides);
        if (this.slides.length > 1) {
            setInterval(() => {
                this.activeSlide = (this.activeSlide + 1) % this.slides.length;
            }, 3000);
        }
    }
}">
    <!-- Background Slider -->
    <template x-for="(slide, index) in slides" :key="index">
        <div 
            x-show="activeSlide === index"
            x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0 scale-105"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-700"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0 z-0 bg-cover bg-center transition-all duration-700" 
            :style="'background-image: url(' + (slide.startsWith('http') ? slide : storageUrl + slide) + ');'"
        >
            <div class="absolute inset-0 bg-black/60"></div>
        </div>
    </template>

    <!-- Foreground Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 min-h-screen flex flex-col md:flex-row items-center justify-center md:justify-between gap-12 pt-28 md:pt-20 pb-12 md:pb-0">
        
        <div id="hero-text" class="flex-1 text-center md:text-left order-2 md:order-1 drop-shadow-2xl">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold font-display leading-[1.1] mb-6 md:mb-8 uppercase tracking-tight text-white">
                @if($siteSetting && $siteSetting->hero_title)
                    @php
                        $title = $siteSetting->hero_title;
                        // Split title to style it like the screenshot (Welcome to... in red/white)
                        // This is a simplified split, we can adjust logic later
                    @endphp
                    {!! nl2br($title) !!}
                @else
                    <span class="text-red-600 block">WELCOME TO THE INAUGURATION</span>
                    <span class="text-green-600 block">OF BANGLADESH CLUB</span>
                    <span class="text-white block">GENEVA WEBSITE</span>
                @endif
            </h1>

            <!-- Buttons -->
            <div class="flex flex-wrap justify-center md:justify-start gap-4 md:gap-8 mt-8 md:mt-12 opacity-0" id="hero-buttons">
                <!-- Be a Member - Primary CTA -->
                <a href="{{ route('membership') }}" class="group relative px-10 py-5 bg-gradient-to-br from-red-500 to-red-700 text-white font-extrabold rounded-2xl shadow-[0_20px_50px_rgba(220,38,38,0.3)] transition-all duration-500 hover:scale-[1.05] hover:shadow-[0_25px_60px_rgba(220,38,38,0.5)] active:scale-95 flex items-center gap-4">
                    <span class="relative z-10 uppercase tracking-[0.2em] text-sm">Be a Member</span>
                    <svg class="w-5 h-5 relative z-10 transition-transform duration-500 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                    <!-- Gloss effect -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-white/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>
                </a>

                @if($hasNotices)
                <!-- Announcement - Secondary CTA -->
                <a href="{{ route('notice') }}" class="group relative px-10 py-5 bg-white/10 backdrop-blur-md border border-white/20 text-white font-extrabold rounded-2xl shadow-lg transition-all duration-500 hover:bg-white/20 hover:scale-[1.05] active:scale-95 flex items-center gap-4 overflow-hidden">
                    <span class="absolute right-4 top-4 flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                    </span>
                    <svg class="w-5 h-5 relative z-10 animate-bounce text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                    <span class="relative z-10 uppercase tracking-[0.2em] text-sm">Announcement</span>
                </a>
                @endif

            </div>
        </div>

        <!-- Hero Side Image (Right side) -->
        <div id="hero-logo" class="flex-1 flex justify-center md:justify-end order-1 md:order-2 w-full">
            @if($siteSetting && $siteSetting->hero_logo_path)
                <img src="{{ asset('storage/' . $siteSetting->hero_logo_path) }}" alt="Hero Side Image" class="w-full h-auto max-w-[280px] sm:max-w-[350px] md:max-w-[450px] lg:max-w-[550px] object-contain drop-shadow-[0_0_50px_rgba(255,0,0,0.3)]">
            @else
                <img src="{{ asset('images/logo.png') }}" alt="Default Logo" class="w-full h-auto max-w-[250px] sm:max-w-[300px] md:max-w-[450px] lg:max-w-[550px] object-contain drop-shadow-[0_0_50px_rgba(255,0,0,0.3)] opacity-40">
            @endif
        </div>
    </div>
</div>

<!-- Introduction Section -->
<section id="intro-section" class="relative py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            
            <!-- Writing Part - Modern UI Card -->
            <div id="intro-card" class="flex-1 opacity-0 -translate-x-20">
                <div class="relative p-8 md:p-12 rounded-3xl bg-white border border-gray-100 shadow-2xl overflow-hidden group hover:border-red-600/30 transition-all duration-500">
                    <!-- Subtle gradient background -->
                    <div class="absolute -top-24 -left-24 w-64 h-64 bg-red-600/10 rounded-full blur-3xl group-hover:bg-red-600/20 transition-all duration-700"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center gap-4 mb-6">
                            <span class="w-12 h-1 bg-green-600 rounded-full"></span>
                            <h2 class="text-2xl md:text-3xl font-bold uppercase tracking-tight">
                                Introducing <span class="text-red-600">Bangladesh Club Geneva</span> (BCG)
                            </h2>
                        </div>
                        
                        <div class="prose text-gray-600 leading-relaxed mb-10 text-lg">
                            @if($siteSetting && $siteSetting->introduction)
                                {!! $siteSetting->introduction !!}
                            @else
                                <p>In 1995, Bangladeshi immigrant living in Geneva, Switzerland formed a club named "Probas". After continuing for few years, it was renamed "Bangladesh Club Geneva". The purpose of the club is to make a platform where the interest of the Bangladeshi immigrant living in Geneva will served and secured. Along with to make a multilateral relations with other communities existed in Geneva.</p>
                            @endif
                        </div>

                        <div class="flex flex-wrap items-center gap-6">
                            <a href="{{ route('about-us') }}" class="px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-lg shadow-green-900/20 transition-all active:scale-95">
                                View More
                            </a>
                            <a href="{{ route('news') }}" class="flex items-center gap-3 group/btn text-gray-900 font-semibold">
                                <span class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center group-hover/btn:scale-110 group-hover/btn:rotate-12 transition-all duration-300">
                                    <svg class="w-6 h-6 fill-white" viewBox="0 0 24 24"><path d="M20 12l-1.41-1.41L13 16.17V4h-2v12.17l-5.58-5.59L4 12l8 8 8-8z"/></svg>
                                </span>
                                <span class="group-hover/btn:text-red-600 transition-colors uppercase tracking-widest text-sm">News about us</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Part - Modern UI Frame -->
            <div id="intro-image-container" class="flex-1 opacity-0 translate-x-20">
                <div class="relative group">
                    <!-- Modern Frame Background Decor -->
                    <div class="absolute -inset-4 bg-gradient-to-tr from-green-600/20 to-red-600/20 rounded-[2.5rem] blur-2xl opacity-50 group-hover:opacity-100 transition-opacity duration-700"></div>
                    
                    <div class="relative rounded-[2rem] overflow-hidden border-4 border-white/10 shadow-2xl skew-x-1 group-hover:skew-x-0 transition-all duration-700">
                        @if($siteSetting && $siteSetting->intro_image_path)
                            <img src="{{ asset('storage/' . $siteSetting->intro_image_path) }}" alt="Our Meeting" class="w-full h-full object-contain bg-gray-50 transition-transform duration-1000 min-h-[400px]">
                        @else
                            <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2670&auto=format&fit=crop" alt="Introduction Placeholder" class="w-full h-full object-contain bg-gray-50 transition-transform duration-1000 min-h-[400px]">
                        @endif
                        
                        <!-- Overlay gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                    </div>
                    
                    <!-- Floating Badge -->
                    <div class="absolute -bottom-6 -left-6 bg-white py-4 px-6 rounded-2xl shadow-xl border border-gray-100 animate-bounce">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <span class="text-green-600 font-bold">25+</span>
                            </div>
                            <div>
                                <p class="text-black text-xs font-bold uppercase tracking-tighter">Years of Legacy</p>
                                <p class="text-gray-500 text-[10px]">Since 1995</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Advertisement Section -->
<section id="ads-section" class="py-20 bg-[#f3f4f6]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-black text-gray-900 uppercase tracking-tighter mb-4">
                Our Commercial Partners
            </h2>
            <div class="w-24 h-1.5 bg-red-600 mx-auto rounded-full"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @php
                $ads = [
                    ['path' => $siteSetting->ad1_path ?? null, 'url' => $siteSetting->ad1_url ?? null],
                    ['path' => $siteSetting->ad2_path ?? null, 'url' => $siteSetting->ad2_url ?? null],
                    ['path' => $siteSetting->ad3_path ?? null, 'url' => $siteSetting->ad3_url ?? null],
                    ['path' => $siteSetting->ad4_path ?? null, 'url' => $siteSetting->ad4_url ?? null],
                ];
            @endphp

            @foreach($ads as $index => $ad)
                <div class="ad-card opacity-0 translate-y-20" data-index="{{ $index }}">
                    <div class="relative group rounded-2xl overflow-hidden border-2 border-gray-100 bg-white shadow-lg transition-all duration-500 hover:border-red-600/50 hover:shadow-2xl hover:shadow-red-900/10">
                        @if($ad['path'])
                            @if($ad['url'])
                                <a href="{{ $ad['url'] }}" target="_blank" rel="noopener noreferrer" class="block">
                                    <img src="{{ asset('storage/' . $ad['path']) }}" alt="Advertisement {{ $index + 1 }}" class="w-full h-auto object-contain transition-transform duration-700 group-hover:scale-110">
                                </a>
                            @else
                                <img src="{{ asset('storage/' . $ad['path']) }}" alt="Advertisement {{ $index + 1 }}" class="w-full h-auto object-contain transition-transform duration-700 group-hover:scale-110">
                            @endif
                        @else
                            <div class="w-full h-64 md:h-72 flex flex-col items-center justify-center p-6 text-center">
                                <div class="w-16 h-16 mb-4 rounded-full bg-red-600/10 flex items-center justify-center border border-red-600/20 group-hover:bg-red-600/20 transition-colors">
                                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                </div>
                                <p class="text-gray-900 font-bold uppercase tracking-widest text-sm">Contact for advertisement</p>
                                <p class="text-gray-500 text-[10px] mt-2 italic">Your business here</p>
                            </div>
                        @endif
                        
                        <!-- Premium Shine Overlay -->
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 bg-gradient-to-tr from-white/10 via-transparent to-transparent transition-opacity duration-700 pointer-events-none"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Photo Album Section -->
<section id="album-section" class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 uppercase tracking-tighter mb-4">
                Photo <span class="text-red-600">Album</span>
            </h2>
            <div class="w-24 h-1.5 bg-green-600 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @forelse($featuredAlbums as $index => $album)
                <div class="album-card opacity-0 translate-y-20" data-index="{{ $index }}">
                    <div class="relative group rounded-[2.5rem] overflow-hidden bg-white shadow-2xl border border-gray-100 transition-all duration-700 hover:-translate-y-4 hover:shadow-red-600/10">
                        <!-- Image Container -->
                        <div class="relative h-72 overflow-hidden">
                            @if(!empty($album->images))
                                <img src="{{ asset('storage/' . $album->images[0]) }}" alt="{{ $album->title }}" class="w-full h-full object-contain bg-gray-50 transition-transform duration-1000 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <!-- Date Badge -->
                            @if($album->event_date)
                            <div class="absolute top-6 right-6 px-4 py-2 bg-white/90 backdrop-blur-md rounded-xl shadow-lg border border-white/20">
                                <p class="text-[10px] font-black text-red-600 uppercase tracking-widest">{{ $album->event_date->format('M d, Y') }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Content Part -->
                        <div class="p-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 line-clamp-2 min-h-[3.5rem] leading-tight group-hover:text-red-600 transition-colors">
                                {{ $album->title }}
                            </h3>
                            
                            <div class="flex items-center justify-between gap-4 pt-6 border-t border-gray-50">
                                <a href="{{ route('gallery.show', $album) }}" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white text-xs font-black uppercase tracking-widest rounded-xl shadow-lg shadow-green-900/20 transition-all active:scale-95">
                                    View All Photos
                                </a>
                                <div class="flex -space-x-3">
                                    @php $albumImages = is_array($album->images) ? $album->images : json_decode($album->images, true); @endphp
                                    @foreach(array_slice($albumImages ?? [], 0, 3) as $img)
                                        <div class="w-8 h-8 rounded-full border-2 border-white overflow-hidden shadow-md bg-white">
                                            <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-contain">
                                        </div>
                                    @endforeach
                                    @if(count($albumImages ?? []) > 3)
                                        <div class="w-8 h-8 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-[10px] font-bold text-gray-500 shadow-md">
                                            +{{ count($albumImages) - 3 }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-gray-400 italic">No albums uploaded yet.</div>
            @endforelse
        </div>

        <div class="mt-20 text-center">
            <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-4 px-12 py-5 bg-gray-900 hover:bg-red-600 text-white font-black uppercase tracking-widest rounded-full shadow-2xl transition-all duration-500 hover:scale-[1.05] active:scale-95 group">
                <span>View All Album</span>
                <svg class="w-6 h-6 transition-transform duration-500 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>
</section>

@if($aboutBcgSetting)
<!-- President Message Section -->
<section id="president-section" class="py-32 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-24">
            
            <!-- Left: Image with Decorative Accent -->
            <div class="relative flex-1 w-full max-w-xs lg:max-w-sm" id="president-image">
                <!-- Green Decorative Background -->
                <div class="absolute -top-6 -left-6 w-48 h-64 bg-green-100 rounded-3xl -z-10 translate-x-4 translate-y-4"></div>
                <div class="absolute -top-6 -left-6 w-48 h-64 bg-green-500/10 rounded-3xl -z-10"></div>
                
                <!-- Main Image Card -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gray-900/10 rounded-3xl blur-2xl translate-y-8 group-hover:translate-y-12 transition-all duration-700"></div>
                    <div class="relative rounded-3xl overflow-hidden shadow-[0_50px_100px_-20px_rgba(0,0,0,0.3)] border-[12px] border-white">
                        @if($aboutBcgSetting->president_image_path)
                            <img src="{{ asset('storage/' . $aboutBcgSetting->president_image_path) }}" 
                                 alt="President" 
                                 class="w-full h-auto scale-[1.01] transition-transform duration-1000 group-hover:scale-105">
                        @else
                            <div class="w-full aspect-[4/5] bg-gray-50 flex items-center justify-center text-gray-300">
                                <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right: Content -->
            <div class="flex-1 space-y-8" id="president-content" x-data="{ expanded: false }">
                <div class="space-y-4">
                    <h2 class="text-5xl font-black text-gray-900 uppercase tracking-tighter">
                        President
                    </h2>
                    <div class="w-20 h-1.5 bg-green-600 rounded-full"></div>
                </div>

                <div class="prose prose-lg text-gray-600 leading-relaxed font-medium space-y-6">
                    <div class="transition-all duration-300">
                        {!! $aboutBcgSetting->president_speech !!}
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100">
                    <h4 class="text-gray-900 font-black text-2xl uppercase tracking-tighter">{{ $aboutBcgSetting->president_name }}</h4>
                    <p class="text-gray-500 font-bold uppercase text-xs tracking-[0.2em] mt-1">President</p>
                </div>
            </div>
            
        </div>
    </div>
</section>
@endif

@if($aboutBcgSetting->gs_name)
<!-- General Secretary Message Section -->
<section id="gs-section" class="py-32 bg-gray-50/50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col-reverse lg:flex-row items-center gap-16 lg:gap-24">
            
            <!-- Left: Content -->
            <div class="flex-1 space-y-8 text-right lg:text-left" id="gs-content" x-data="{ expanded: false }">
                <div class="space-y-4">
                    <h2 class="text-5xl font-black text-gray-900 uppercase tracking-tighter">
                        General Secretary
                    </h2>
                    <div class="w-20 h-1.5 bg-green-600 rounded-full ml-auto lg:ml-0"></div>
                </div>

                <div class="prose prose-lg text-gray-600 leading-relaxed font-medium space-y-6 ml-auto lg:ml-0">
                    <div class="transition-all duration-300">
                        {!! $aboutBcgSetting->gs_speech !!}
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-200">
                    <h4 class="text-gray-900 font-black text-2xl uppercase tracking-tighter">{{ $aboutBcgSetting->gs_name }}</h4>
                    <p class="text-gray-500 font-bold uppercase text-xs tracking-[0.2em] mt-1">General Secretary</p>
                </div>
            </div>

            <!-- Right: Image with Decorative Accent (Mirrored) -->
            <div class="relative flex-1 w-full max-w-xs lg:max-w-sm" id="gs-image">
                <!-- Green Decorative Background (Mirrored) -->
                <div class="absolute -top-6 -right-6 w-48 h-64 bg-green-100 rounded-3xl -z-10 -translate-x-4 translate-y-4"></div>
                <div class="absolute -top-6 -right-6 w-48 h-64 bg-green-500/10 rounded-3xl -z-10"></div>
                
                <!-- Main Image Card -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gray-900/10 rounded-3xl blur-2xl translate-y-8 group-hover:translate-y-12 transition-all duration-700"></div>
                    <div class="relative rounded-3xl overflow-hidden shadow-[0_50px_100px_-20px_rgba(0,0,0,0.3)] border-[12px] border-white">
                        @if($aboutBcgSetting->gs_image_path)
                            <img src="{{ asset('storage/' . $aboutBcgSetting->gs_image_path) }}" 
                                 alt="General Secretary" 
                                 class="w-full h-auto scale-[1.01] transition-transform duration-1000 group-hover:scale-105">
                        @else
                            <div class="w-full aspect-[4/5] bg-gray-50 flex items-center justify-center text-gray-300">
                                <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>

        <!-- View All Speeches Button -->
        <div class="mt-16 text-center">
             <a href="{{ route('speech') }}" class="inline-flex items-center gap-4 px-10 py-4 bg-green-600 hover:bg-green-700 text-white font-black uppercase tracking-widest rounded-full shadow-xl shadow-green-900/20 transition-all duration-500 hover:scale-[1.05] active:scale-95 group">
                <span>View All Speeches</span>
                <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Advertisement Section 2 (Below GS) -->
<section id="ads-section-2" class="py-20 bg-[#f3f4f6]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-black text-gray-900 uppercase tracking-tighter mb-4">
                Our Commercial Partners
            </h2>
            <div class="w-24 h-1.5 bg-red-600 mx-auto rounded-full"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @php
                $ads2 = [
                    ['path' => $siteSetting->ad5_path ?? null, 'url' => $siteSetting->ad5_url ?? null],
                    ['path' => $siteSetting->ad6_path ?? null, 'url' => $siteSetting->ad6_url ?? null],
                    ['path' => $siteSetting->ad7_path ?? null, 'url' => $siteSetting->ad7_url ?? null],
                    ['path' => $siteSetting->ad8_path ?? null, 'url' => $siteSetting->ad8_url ?? null],
                ];
            @endphp

            @foreach($ads2 as $index => $ad)
                <div class="ad-card-2 opacity-0 translate-y-20" data-index="{{ $index }}">
                    <div class="relative group rounded-2xl overflow-hidden border-2 border-gray-100 bg-white shadow-lg transition-all duration-500 hover:border-red-600/50 hover:shadow-2xl hover:shadow-red-900/10">
                        @if($ad['path'])
                            @if($ad['url'])
                                <a href="{{ $ad['url'] }}" target="_blank" rel="noopener noreferrer" class="block">
                                    <img src="{{ asset('storage/' . $ad['path']) }}" alt="Advertisement {{ $index + 5 }}" class="w-full h-auto object-contain transition-transform duration-700 group-hover:scale-110">
                                </a>
                            @else
                                <img src="{{ asset('storage/' . $ad['path']) }}" alt="Advertisement {{ $index + 5 }}" class="w-full h-auto object-contain transition-transform duration-700 group-hover:scale-110">
                            @endif
                        @else
                            <div class="w-full h-64 md:h-72 flex flex-col items-center justify-center p-6 text-center">
                                <div class="w-16 h-16 mb-4 rounded-full bg-red-600/10 flex items-center justify-center border border-red-600/20 group-hover:bg-red-600/20 transition-colors">
                                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                </div>
                                <p class="text-gray-900 font-bold uppercase tracking-widest text-sm">Contact for advertisement</p>
                                <p class="text-gray-500 text-[10px] mt-2 italic">Your business here</p>
                            </div>
                        @endif
                        
                        <!-- Premium Shine Overlay -->
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 bg-gradient-to-tr from-white/10 via-transparent to-transparent transition-opacity duration-700 pointer-events-none"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        gsap.registerPlugin(ScrollTrigger);

        // Hero Content Entrance Animations
        const tl = gsap.timeline();

        // Title arrives from left
        tl.from("#hero-text h1", {
            x: -200,
            opacity: 0,
            duration: 1.5,
            ease: "power4.out"
        });

        // Logo arrives from right
        tl.from("#hero-logo", {
            x: 200,
            opacity: 0,
            duration: 1.5,
            ease: "power4.out"
        }, "-=1.2");

        // Buttons fade up
        tl.fromTo("#hero-buttons", 
            { y: 50, opacity: 0 },
            { y: 0, opacity: 1, duration: 1, ease: "back.out(1.7)" },
            "-=0.5"
        );

        // Introduction Section Animations
        gsap.to("#intro-card", {
            scrollTrigger: {
                trigger: "#intro-section",
                start: "top 80%",
            },
            x: 0,
            opacity: 1,
            duration: 1.2,
            ease: "power3.out"
        });

        gsap.to("#intro-image-container", {
            scrollTrigger: {
                trigger: "#intro-section",
                start: "top 80%",
            },
            x: 0,
            opacity: 1,
            duration: 1.2,
            delay: 0.2,
            ease: "power3.out"
        });

        // Ads Section Animations
        gsap.to(".ad-card", {
            scrollTrigger: {
                trigger: "#ads-section",
                start: "top 85%",
            },
            y: 0,
            opacity: 1,
            duration: 0.8,
            stagger: 0.2,
            ease: "back.out(1.4)"
        });

        // Ads Section 2 Animations
        gsap.to(".ad-card-2", {
            scrollTrigger: {
                trigger: "#ads-section-2",
                start: "top 85%",
            },
            y: 0,
            opacity: 1,
            duration: 0.8,
            stagger: 0.2,
            ease: "back.out(1.4)"
        });

        // Photo Album Section Animations
        gsap.to(".album-card", {
            scrollTrigger: {
                trigger: "#album-section",
                start: "top 85%",
            },
            y: 0,
            opacity: 1,
            duration: 1,
            stagger: 0.3,
            ease: "power4.out"
        });

        // President Section Animations
        gsap.from("#president-image", {
            scrollTrigger: {
                trigger: "#president-section",
                start: "top 80%",
            },
            x: -100,
            opacity: 0,
            duration: 1.5,
            ease: "power4.out"
        });

        gsap.from("#president-content", {
            scrollTrigger: {
                trigger: "#president-section",
                start: "top 80%",
            },
            x: 100,
            opacity: 0,
            duration: 1.5,
            delay: 0.2,
            ease: "power4.out"
        });

        // General Secretary Section Animations
        gsap.from("#gs-image", {
            scrollTrigger: {
                trigger: "#gs-section",
                start: "top 80%",
            },
            x: 100,
            opacity: 0,
            duration: 1.5,
            ease: "power4.out"
        });

        gsap.from("#gs-content", {
            scrollTrigger: {
                trigger: "#gs-section",
                start: "top 80%",
            },
            x: -100,
            opacity: 0,
            duration: 1.5,
            delay: 0.2,
            ease: "power4.out"
        });
    });
</script>

    <style>
    /* Custom split styling for hero title */
    #hero-text h1 span:nth-child(2) { color: #16a34a; } /* green */
    #hero-text h1 span:nth-child(1) { color: #dc2626; } /* red */
    
    .font-display { font-family: 'Outfit', sans-serif; }
</style>

@if(isset($latestNotice) && $latestNotice)
<!-- Notice Popup Modal -->
<div 
    x-data="{ 
        showNotice: false,
        init() {
            // Short delay so it feels natural after page load
            setTimeout(() => {
                this.showNotice = true;
            }, 1500);
        },
        closeNotice() {
            this.showNotice = false;
        }
    }"
    x-show="showNotice"
    x-cloak
    class="fixed inset-0 z-[100] overflow-y-auto"
    aria-labelledby="modal-title" role="dialog" aria-modal="true"
>
    <!-- Backdrop -->
    <div 
        x-show="showNotice"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" 
        @click="closeNotice()"
    ></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <!-- Modal Panel -->
        <div 
            x-show="showNotice"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-xl border-4 border-white/50"
        >
            
            <!-- Close Button Corner -->
            <button @click="closeNotice()" class="absolute top-4 right-4 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 text-gray-500 hover:bg-gray-200 hover:text-gray-900 transition-colors">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="bg-white px-6 pb-8 pt-8 sm:p-10 sm:pb-10">
                <div class="sm:flex sm:items-start">
                    
                    <!-- Icon / Indicator -->
                    <div class="mx-auto flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-red-50 sm:mx-0 sm:h-auto sm:w-auto sm:bg-transparent relative">
                        <span class="absolute -top-1 -right-1 flex h-4 w-4 sm:relative sm:top-0 sm:right-0 sm:mr-4">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-4 w-4 bg-red-500"></span>
                        </span>
                        <svg class="h-8 w-8 text-red-600 sm:hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>

                    <div class="mt-5 text-center sm:ml-2 sm:mt-0 sm:text-left w-full">
                        <div class="flex items-center justify-center sm:justify-start gap-3 mb-2">
                             <span class="px-3 py-1 text-[10px] font-black uppercase tracking-widest text-red-600 bg-red-50 rounded-full border border-red-100">Latest Notice</span>
                             @if($latestNotice->type)
                                <span class="px-3 py-1 text-[10px] font-black uppercase tracking-widest text-gray-600 bg-gray-100 rounded-full border border-gray-200">{{ $latestNotice->type }}</span>
                             @endif
                        </div>
                        
                        <h3 class="text-2xl font-black uppercase tracking-tight text-gray-900 mb-4" id="modal-title">{{ $latestNotice->title }}</h3>
                        
                        <div class="mt-2 prose prose-sm text-gray-500 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                            {!! $latestNotice->content !!}
                        </div>

                        @if($latestNotice->attachment)
                            <div class="mt-6 p-4 bg-gray-50 rounded-2xl border border-gray-100 flex items-center gap-4">
                                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm shrink-0">
                                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs font-bold text-gray-900">Attachment Available</p>
                                    <a href="{{ asset('storage/' . $latestNotice->attachment) }}" target="_blank" class="text-xs text-red-600 hover:underline font-medium">Download / View File</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse sm:px-10 gap-3 border-t border-gray-100">
                <a href="{{ route('notice') }}" class="inline-flex w-full justify-center rounded-xl bg-red-600 px-6 py-3 text-sm font-black uppercase tracking-widest text-white shadow-sm hover:bg-red-500 sm:w-auto transition-colors">
                    View All Notices
                </a>
                <button type="button" @click="closeNotice()" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-6 py-3 text-sm font-bold uppercase tracking-widest text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
