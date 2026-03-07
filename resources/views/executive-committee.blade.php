@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative pt-40 pb-20 lg:pt-56 lg:pb-32 overflow-hidden bg-gray-900">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/executive-hero-bg.jpg') }}'); opacity: 0.3;"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" id="executive-hero-content">
        <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight">Executive Committee</h1>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto font-light">Meet the dedicated leaders guiding the Bangladesh Club Geneva.</p>
        <div class="w-24 h-1.5 bg-red-600 mx-auto mt-8 rounded-full"></div>
    </div>
</section>

<!-- Committee Members Section with Search -->
<div class="bg-gray-50 py-24 min-h-screen" x-data="{ 
    search: '',
    membersData: @js(is_array($executiveMembers ?? []) ? array_values(array_map(function($m) { return ['name' => strtolower($m['name'] ?? ''), 'designation' => strtolower($m['designation'] ?? '')]; }, $executiveMembers ?? [])) : []),
    get hasResults() {
        if (this.search === '') return this.membersData.length > 0;
        const s = this.search.toLowerCase();
        return this.membersData.some(m => m.name.includes(s) || m.designation.includes(s));
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search Bar -->
        <div class="max-w-xl mx-auto mb-16 relative group" id="search-container">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-6 w-6 text-gray-400 group-focus-within:text-green-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input 
                type="text" 
                x-model="search" 
                class="block w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-2xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:border-green-500 focus:ring-0 sm:text-lg transition-all shadow-sm hover:border-gray-300 text-gray-900 font-medium" 
                placeholder="Search committee members by name or role..."
            >
        </div>

        <!-- Members Grid -->
        @if(!empty($executiveMembers) && is_array($executiveMembers))
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-10" id="members-grid">
                @foreach($executiveMembers as $member)
                    <div 
                        x-data="{ name: @js(strtolower($member['name'] ?? '')), desig: @js(strtolower($member['designation'] ?? '')) }"
                        class="member-card bg-white rounded-2xl sm:rounded-3xl shadow-xl overflow-hidden border border-gray-100 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl flex flex-col items-center p-2 sm:p-3 relative group"
                        x-show="search === '' || name.includes(search.toLowerCase()) || desig.includes(search.toLowerCase())"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200 transform"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                    >
                        <!-- Image Container with minimal margin -->
                        <div class="relative w-full aspect-[4/5] sm:aspect-square mb-5 rounded-2xl bg-gradient-to-tr from-green-400 to-blue-500 p-[2px] group-hover:from-green-500 group-hover:to-blue-600 transition-all duration-500">
                            <div class="w-full h-full rounded-2xl overflow-hidden bg-white relative">
                                @if(!empty($member['image_path']))
                                    <img src="{{ asset('storage/' . $member['image_path']) }}" alt="{{ $member['name'] }}" class="absolute inset-0 w-full h-full object-contain p-1 transition-transform duration-700 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300 bg-gray-50 border-4 border-white rounded-2xl">
                                        <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    </div>
                                @endif
                                <!-- Subtle overlay on hover -->
                                <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="text-center w-full relative z-10 px-2 sm:px-4 pb-2 sm:pb-4 flex flex-col items-center">
                            <h3 class="text-lg sm:text-2xl font-black text-gray-900 mb-1 sm:mb-2 leading-tight break-words" title="{{ $member['name'] ?? '' }}">{{ $member['name'] ?? 'Unknown Member' }}</h3>
                            <span class="inline-flex text-center whitespace-normal break-words px-3 py-1 sm:px-4 sm:py-1.5 rounded-full text-[10px] sm:text-sm font-semibold tracking-wide text-green-800 bg-green-100 border border-green-200 leading-tight">
                                {{ $member['designation'] ?? 'Committee Member' }}
                            </span>
                        </div>
                        
                        <!-- Decorative background element -->
                        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-gray-50 rounded-full blur-3xl group-hover:bg-green-50 transition-colors duration-500 z-0"></div>
                    </div>
                @endforeach
            </div>
            
            <!-- Empty State for Search -->
            <div x-show="!hasResults" x-cloak class="text-center py-20">
                <div class="flex flex-col items-center justify-center space-y-4">
                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    <p class="text-xl text-gray-500 font-medium">No committee members found matching your search.</p>
                    <button @click="search = ''" class="text-green-600 hover:text-green-700 font-semibold focus:outline-none">Clear Search</button>
                </div>
            </div>

        @else
            <!-- Empty State when no data -->
            <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-1">No Executive Members Available</h3>
                <p class="text-gray-500">The committee list will be updated shortly.</p>
            </div>
        @endif

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        gsap.registerPlugin(ScrollTrigger);

        // Hero Content Entrance
        gsap.from("#executive-hero-content > *", {
            y: 50,
            opacity: 0,
            duration: 1,
            stagger: 0.2,
            ease: "power3.out"
        });

        // Search Bar Entrance
        gsap.from("#search-container", {
            y: 30,
            opacity: 0,
            duration: 0.8,
            delay: 0.4,
            ease: "power2.out"
        });
    });
</script>
@endsection
