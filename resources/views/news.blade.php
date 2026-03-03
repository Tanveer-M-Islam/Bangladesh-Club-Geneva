@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative pt-40 pb-20 lg:pt-56 lg:pb-32 overflow-hidden bg-gray-900">
    <div class="absolute inset-0 bg-gray-800 opacity-50"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" id="news-hero-content">
        <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight">News</h1>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto font-light">Stay up-to-date with our latest community stories.</p>
        <div class="w-24 h-1.5 bg-red-600 mx-auto mt-8 rounded-full"></div>
    </div>
</section>

<!-- News Articles Section -->
<div class="bg-gray-50 py-16 lg:py-24 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if(!empty($newsSetting?->news_items) && is_array($newsSetting->news_items))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 lg:gap-12 max-w-[350px] sm:max-w-none mx-auto w-full" id="news-grid">
                @foreach($newsSetting->news_items as $news)
                    @php
                        $preview = \App\Models\NewsSetting::getLinkPreview($news['url'] ?? '');
                        $title = $preview['title'] ? html_entity_decode($preview['title']) : 'Untitled News';
                        $image = $preview['image'];
                        $source = $preview['source'];
                    @endphp
                    <div class="news-card flex flex-col bg-white rounded-xl sm:rounded-3xl shadow-sm border border-gray-100 p-3 sm:p-6 transition-all duration-300 hover:shadow-md h-full">
                        
                        <!-- Header / Date -->
                        <div class="flex items-center text-[11px] sm:text-sm text-gray-500 mb-2 sm:mb-4">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ !empty($news['published_date']) ? \Carbon\Carbon::parse($news['published_date'])->format('F j, Y') : 'Recent' }}
                        </div>

                        <!-- Link Preview Box (WhatsApp / Feed Style) -->
                        <a href="{{ $news['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="group block w-full bg-[#f0f2f5] rounded-xl overflow-hidden border border-gray-200 hover:bg-[#e4e6eb] transition-colors mb-4 relative">
                            @if(!empty($image))
                                <!-- Optional: Small image on right or top image. WhatsApp usually uses a small square or top banner. Since we want an elegant feed UI, we'll do top banner but smaller. -->
                                <div class="w-full aspect-[21/9] sm:aspect-[16/9] bg-gray-200 overflow-hidden relative flex items-center justify-center">
                                    @php
                                        $isFallbackIcon = str_contains($image, '2021_Facebook_icon.svg');
                                    @endphp
                                    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full {{ $isFallbackIcon ? 'object-contain p-6 opacity-80' : 'object-cover' }}">
                                    <div class="absolute inset-0 bg-black/5 group-hover:bg-transparent transition-colors"></div>
                                </div>
                            @endif
                            
                            <!-- Preview Content -->
                            <div class="border-l-[3px] sm:border-l-4 border-red-600 bg-gray-100 p-2 sm:p-4 rounded-r-lg group-hover:bg-gray-200 transition-colors">
                                <h3 class="font-bold text-gray-900 text-sm sm:text-base mb-1 line-clamp-1 break-words pb-0.5">{{ $title }}</h3>
                                <!-- Hide description on very small mobile to save space, or make it very small -->
                                @if(!empty($preview['description']))
                                    <p class="text-[11px] sm:text-sm text-gray-500 mb-1 sm:mb-2 line-clamp-1 sm:line-clamp-2 break-words">{{ $preview['description'] }}</p>
                                @endif
                                <p class="text-[10px] sm:text-xs text-gray-400 font-medium uppercase tracking-wider">{{ $source }}</p>
                            </div>
                        </a>

                        <!-- Original raw URL (mimicking the actual post text) -->
                        <div class="mt-auto pt-2 border-t border-gray-50">
                            <a href="{{ $news['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="text-[11px] sm:text-sm text-blue-600 hover:text-blue-800 break-all line-clamp-1 transition-colors">
                                {{ $news['url'] ?? '' }}
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State when no news -->
            <div class="text-center py-24 bg-white rounded-3xl shadow-sm border border-gray-100">
                <svg class="mx-auto h-20 w-20 text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">No News Yet</h3>
                <p class="text-lg text-gray-500 max-w-md mx-auto">Latest updates and news articles will appear here once they are added by the administration.</p>
            </div>
        @endif

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        gsap.registerPlugin(ScrollTrigger);

        // Hero Content Entrance
        gsap.from("#news-hero-content > *", {
            y: 50,
            opacity: 0,
            duration: 1,
            stagger: 0.2,
            ease: "power3.out"
        });

        // News Cards Entrance - Removed GSAP for stability on dynamic heights
    });
</script>
@endsection
