@extends('layouts.app')

@push('styles')
<style>
    .notice-card {
        opacity: 0;
        transform: translateY(20px);
    }
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="relative pt-40 pb-20 lg:pt-56 lg:pb-32 overflow-hidden bg-gray-900">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/notice-hero-bg.jpg') }}'); opacity: 0.3;"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" id="notice-hero-content">
        <!-- Static Title per user request -->
        <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight">Notice</h1>
        <!-- Dynamic Subtitle per user request -->
        <p class="text-xl text-gray-300 max-w-2xl mx-auto font-light">Important announcements and updates for our community members.</p>
        <div class="w-24 h-1.5 bg-red-600 mx-auto mt-8 rounded-full"></div>
    </div>
</section>

<!-- Notices Sequential Feed Section -->
<div class="bg-[#f8f9fa] py-16 lg:py-24 min-h-screen relative" id="notice-feed">
    
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($notices->count() > 0)
            <div class="space-y-16" id="notice-stack">
                @foreach($notices as $notice)
                    <!-- Notice Board Item -->
                    <div class="notice-item relative bg-white shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] rounded-2xl sm:rounded-3xl border border-gray-100 overflow-hidden group">
                        
                        <!-- Top decorative pin / tape (Notice Board Style) -->
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-3 w-16 h-8 bg-red-600/10 rounded-full flex justify-center items-center backdrop-blur-sm z-10 border border-red-600/20 shadow-sm">
                            <div class="w-3 h-3 bg-red-600 rounded-full shadow-inner z-20 ring-4 ring-white"></div>
                        </div>

                        <!-- Header -->
                        <div class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 px-5 py-6 sm:px-12 sm:pt-12 sm:pb-8 border-b border-gray-100 flex flex-col pt-10 sm:pt-12 relative overflow-hidden">
                            <!-- Background subtle pattern -->
                            <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                            
                            <div class="relative z-10">
                                <h2 class="text-2xl sm:text-4xl font-extrabold text-white mb-4 leading-tight tracking-tight break-words">
                                    {{ $notice->title }}
                                </h2>
                                <div class="flex flex-wrap items-center gap-2 sm:gap-4">
                                    <span class="inline-flex items-center px-3 sm:px-4 py-1 sm:py-1.5 rounded-full text-[10px] sm:text-xs font-bold bg-white/10 text-white uppercase tracking-wider backdrop-blur-md border border-white/20 shadow-sm">
                                        {{ $notice->type }} Notice
                                    </span>
                                    <span class="text-[10px] sm:text-sm text-gray-400 font-medium flex items-center gap-1.5 sm:gap-2 bg-black/20 px-3 sm:px-4 py-1 sm:py-1.5 rounded-full backdrop-blur-sm border border-white/5">
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        {{ $notice->created_at->format('l, F j, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Content Area -->
                        <div class="p-4 sm:p-12 sm:pt-10">
                            @if($notice->type === 'text')
                                <div class="text-gray-800 text-base sm:text-xl leading-relaxed sm:leading-loose prose prose-base sm:prose-lg prose-red max-w-none font-medium text-justify break-words">
                                    {!! $notice->content !!}
                                </div>
                            @elseif($notice->type === 'image' && $notice->attachment)
                                <div class="w-full rounded-2xl overflow-hidden shadow-[0_4px_20px_-5px_rgba(0,0,0,0.1)] border border-gray-100 bg-gray-50/50 p-2 sm:p-4">
                                    <img src="{{ asset('storage/' . $notice->attachment) }}" alt="{{ $notice->title }}" class="w-full h-auto object-contain rounded-xl max-h-[50vh] sm:max-h-[80vh] mx-auto">
                                </div>
                            @elseif($notice->type === 'pdf' && $notice->attachment)
                                <div class="w-full bg-gray-100 rounded-2xl overflow-hidden shadow-inner border border-gray-200 h-[70vh] min-h-[500px] relative group pointer-events-auto overflow-x-hidden">
                                    
                                    <!-- Desktop View (Standard) -->
                                    <div class="hidden sm:block absolute inset-0 w-full h-full">
                                        <iframe src="{{ asset('storage/' . $notice->attachment) }}#view=Fit&toolbar=0&navpanes=0&scrollbar=0" width="100%" height="100%" class="w-full h-full border-0" loading="lazy"></iframe>
                                    </div>

                                    <!-- Mobile View (Improved Preview) -->
                                    <div class="block sm:hidden absolute inset-0 w-full h-full bg-white overflow-hidden">
                                        <iframe src="{{ asset('storage/' . $notice->attachment) }}#view=FitH&toolbar=0&navpanes=0&scrollbar=0" width="100%" height="100%" class="w-full h-full border-0" style="-webkit-overflow-scrolling: touch;" loading="lazy"></iframe>
                                        
                                        <!-- Action Overlay -->
                                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 w-full px-6">
                                            <a href="{{ asset('storage/' . $notice->attachment) }}" target="_blank" class="w-full bg-red-600 text-white py-3.5 rounded-xl text-center text-sm font-bold shadow-2xl flex items-center justify-center gap-2 active:scale-95 transition-transform border border-red-500">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                View Full Document (High Quality)
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <!-- Fallback for browsers that don't support iframes or PDFs natively -->
                                    <div class="absolute inset-0 flex-col items-center justify-center p-6 sm:p-12 bg-white text-center hidden group-[.iframe-fallback]:flex z-10">
                                        <svg class="w-16 sm:w-20 h-16 sm:h-20 text-red-500 mb-4 sm:mb-6 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 9h1.5m1.5 0H15M9 13h6m-6 4h6"></path></svg>
                                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2">PDF Viewer Not Available</h3>
                                        <p class="text-sm sm:text-base text-gray-500 mb-6 sm:mb-8 max-w-sm mx-auto">Your browser does not support inline PDF viewing. You can download the full document to read it locally.</p>
                                        <a href="{{ asset('storage/' . $notice->attachment) }}" target="_blank" class="inline-flex items-center px-6 sm:px-8 py-3 border border-transparent text-sm sm:text-base font-bold rounded-full text-white bg-red-600 hover:bg-red-700 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform">
                                            Open Document <svg class="w-4 sm:w-5 h-4 sm:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($notices->hasPages())
                <div class="mt-20 flex justify-center">
                    {{ $notices->links('pagination::tailwind') }}
                </div>
            @endif

        @else
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center p-16 text-center bg-white rounded-[2rem] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.05)] border border-gray-100 max-w-3xl mx-auto my-12 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-b from-gray-50/50 to-transparent"></div>
                <div class="relative z-10 w-24 h-24 bg-red-50 rounded-full flex items-center justify-center mb-8 border-4 border-white shadow-sm">
                    <svg class="w-12 h-12 text-red-500 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
                <h3 class="relative z-10 text-3xl font-black text-gray-900 mb-3">Notice Board is Empty</h3>
                <p class="relative z-10 text-gray-500 max-w-md text-lg">There are currently no active announcements or circulars. Please check back later.</p>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        if (typeof gsap !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);

            // Hero Content Entrance
            gsap.from('#notice-hero-content > *', {
                duration: 1,
                y: 50,
                opacity: 0,
                stagger: 0.2,
                ease: "power3.out"
            });

            gsap.from('.notice-item', {
                scrollTrigger: {
                    trigger: '#notice-stack',
                    start: 'top 85%',
                },
                duration: 1,
                y: 60,
                opacity: 0,
                stagger: 0.2,
                ease: 'power3.out',
                clearProps: "all"
            });
        }
    });
</script>
@endpush

@endsection
