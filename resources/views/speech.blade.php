@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="relative pt-40 pb-20 lg:pt-56 lg:pb-32 overflow-hidden bg-gray-900">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/about-hero-bg.jpg') }}'); opacity: 0.3;"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" id="speech-hero-content">
        <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight">Speeches</h1>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto font-light">Messages from the leadership and key members of our community.</p>
        <div class="w-24 h-1.5 bg-red-600 mx-auto mt-8 rounded-full"></div>
    </div>
</section>

<div class="bg-white py-16 md:py-32 min-h-screen overflow-x-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-32">
        
        @if($aboutBcgSetting && $aboutBcgSetting->president_name && $aboutBcgSetting->president_speech)
        <!-- President Speech (Left Image, Right Text) -->
        <div class="flex flex-col md:flex-row items-center gap-12 lg:gap-24 speech-card" id="speech-president">
            <!-- Left Side Image -->
            <div class="w-full max-w-[280px] md:max-w-none md:w-5/12 relative mx-auto md:mx-0">
                <div class="absolute -top-4 -left-4 w-full h-full bg-[#e8f5e9] rounded-3xl -z-10"></div>
                <div class="bg-white p-4 rounded-3xl shadow-xl">
                    @if($aboutBcgSetting->president_image_path)
                    <img src="{{ asset('storage/' . $aboutBcgSetting->president_image_path) }}" alt="{{ $aboutBcgSetting->president_name }}" class="w-full h-auto aspect-[4/5] object-contain bg-white rounded-2xl">
                    @else
                    <div class="w-full aspect-[4/5] bg-gray-200 rounded-2xl flex items-center justify-center">
                        <span class="text-gray-400">No Photo</span>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Right Side Text -->
            <div class="w-full md:w-7/12 flex flex-col items-start group">
                <h2 class="text-4xl md:text-5xl font-black text-[#0f172a] uppercase tracking-tighter mb-4">President</h2>
                <div class="w-16 h-1.5 bg-[#2ecc71] mb-8"></div>
                
                <div class="prose prose-lg text-gray-600 mb-6 speech-text-container relative w-full">
                    <div class="speech-content transition-all duration-300 relative">
                        {!! $aboutBcgSetting->president_speech !!}
                    </div>
                </div>
                
                <div class="pt-6 border-t border-gray-100 w-full">
                    <h3 class="text-xl font-bold text-[#0f172a] uppercase tracking-wide">{{ $aboutBcgSetting->president_name }}</h3>
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-1">President</p>
                </div>
            </div>
        </div>
        @endif

        @if($aboutBcgSetting && $aboutBcgSetting->gs_name && $aboutBcgSetting->gs_speech)
        <!-- General Secretary Speech (Right Image, Left Text) -->
        <div class="flex flex-col md:flex-row-reverse items-center gap-12 lg:gap-24 speech-card" id="speech-gs">
            <!-- Right Side Image -->
            <div class="w-full max-w-[280px] md:max-w-none md:w-5/12 relative mx-auto md:mx-0">
                <div class="absolute -top-4 -right-4 w-full h-full bg-[#e8f5e9] rounded-3xl -z-10"></div>
                <div class="bg-white p-4 rounded-3xl shadow-xl">
                    @if($aboutBcgSetting->gs_image_path)
                    <img src="{{ asset('storage/' . $aboutBcgSetting->gs_image_path) }}" alt="{{ $aboutBcgSetting->gs_name }}" class="w-full h-auto aspect-[4/5] object-contain bg-white rounded-2xl">
                    @else
                    <div class="w-full aspect-[4/5] bg-gray-200 rounded-2xl flex items-center justify-center">
                        <span class="text-gray-400">No Photo</span>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Left Side Text -->
            <div class="w-full md:w-7/12 flex flex-col items-start group">
                <h2 class="text-4xl md:text-5xl font-black text-[#0f172a] uppercase tracking-tighter mb-4 text-left">General Secretary</h2>
                <div class="w-16 h-1.5 bg-[#2ecc71] mb-8"></div>
                
                <div class="prose prose-lg text-gray-600 mb-6 speech-text-container relative w-full">
                    <div class="speech-content transition-all duration-300 relative">
                        {!! $aboutBcgSetting->gs_speech !!}
                    </div>
                </div>
                
                <div class="pt-6 border-t border-gray-100 w-full">
                    <h3 class="text-xl font-bold text-[#0f172a] uppercase tracking-wide">{{ $aboutBcgSetting->gs_name }}</h3>
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-1">General Secretary</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Other Speeches Repeater -->
        @if($aboutBcgSetting && !empty($aboutBcgSetting->other_speeches))
            @foreach($aboutBcgSetting->other_speeches as $index => $other_speech)
                @php
                    // Alternate layout direction based on index (even = Left Image, odd = Right Image)
                    $isEven = $index % 2 == 0;
                @endphp
                
                <div class="flex flex-col {{ $isEven ? 'md:flex-row' : 'md:flex-row-reverse' }} items-center gap-12 lg:gap-24 speech-card" id="speech-other-{{ $index }}">
                    <!-- Image Side -->
                    <div class="w-full max-w-[280px] md:max-w-none md:w-5/12 relative mx-auto md:mx-0">
                        <div class="absolute -top-4 {{ $isEven ? '-left-4' : '-right-4' }} w-full h-full bg-[#e8f5e9] rounded-3xl -z-10"></div>
                        <div class="bg-white p-4 rounded-3xl shadow-xl">
                            @if(isset($other_speech['image_path']) && $other_speech['image_path'])
                            <img src="{{ asset('storage/' . $other_speech['image_path']) }}" alt="{{ $other_speech['name'] }}" class="w-full h-auto aspect-[4/5] object-contain bg-white rounded-2xl">
                            @else
                            <div class="w-full aspect-[4/5] bg-gray-200 rounded-2xl flex items-center justify-center">
                                <span class="text-gray-400">No Photo</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Text Side -->
                    <div class="w-full md:w-7/12 flex flex-col items-start group">
                        <h2 class="text-4xl md:text-5xl font-black text-[#0f172a] uppercase tracking-tighter mb-4 text-left">{{ $other_speech['designation'] ?? 'Representative' }}</h2>
                        <div class="w-16 h-1.5 bg-[#2ecc71] mb-8"></div>
                        
                        <div class="prose prose-lg text-gray-600 mb-6 speech-text-container relative w-full">
                            <div class="speech-content transition-all duration-300 relative">
                                {!! $other_speech['speech'] ?? '' !!}
                            </div>
                        </div>
                        
                        <div class="pt-6 border-t border-gray-100 w-full">
                            <h3 class="text-xl font-bold text-[#0f172a] uppercase tracking-wide">{{ $other_speech['name'] ?? '' }}</h3>
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-1">{{ $other_speech['designation'] ?? '' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // GSAP Animations
        if (typeof gsap !== 'undefined') {
            gsap.from('#speech-hero-content > *', {
                y: 50,
                opacity: 0,
                duration: 1,
                stagger: 0.2,
                ease: "power3.out"
            });

            // Animate cards on scroll
            gsap.utils.toArray('.speech-card').forEach((card, i) => {
                const isEven = i % 2 === 0;
                gsap.from(card, {
                    scrollTrigger: {
                        trigger: card,
                        start: "top 85%",
                        toggleActions: "play none none reverse"
                    },
                    y: 60,
                    opacity: 0,
                    duration: 1,
                    ease: "power3.out"
                });
            });
        }
    });
</script>
@endpush

@endsection
