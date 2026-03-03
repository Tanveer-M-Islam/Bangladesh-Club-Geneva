@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative pt-40 pb-20 lg:pt-56 lg:pb-32 overflow-hidden bg-gray-900">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/about-hero-bg.jpg') }}'); opacity: 0.2;"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" id="members-hero-content">
        <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight">General Members</h1>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto font-light">The heartbeat of Bangladesh Club Geneva. Our vibrant community of members.</p>
        <div class="w-24 h-1.5 bg-red-600 mx-auto mt-8 rounded-full"></div>
    </div>
</section>

<!-- Members Section with Search -->
<div class="bg-gray-50 py-12 lg:py-24 min-h-screen" x-data="{ 
    search: '',
    membersData: @js(is_array($generalMembers ?? []) ? array_values(array_map(function($m) { 
        return [
            'name' => strtolower($m['name'] ?? ''), 
            'phone' => strtolower($m['phone'] ?? ''),
            'email' => strtolower($m['email'] ?? ''),
            'blood_group' => strtolower($m['blood_group'] ?? '')
        ]; 
    }, $generalMembers ?? [])) : []),
    get hasResults() {
        if (this.search === '') return this.membersData.length > 0;
        const s = this.search.toLowerCase();
        return this.membersData.some(m => 
            m.name.includes(s) || 
            m.phone.includes(s) || 
            m.email.includes(s) || 
            m.blood_group.includes(s)
        );
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search Bar -->
        <div class="max-w-xl mx-auto mb-16 relative group" id="search-container">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-6 w-6 text-gray-400 group-focus-within:text-red-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input 
                type="text" 
                x-model="search" 
                class="block w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-2xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-0 sm:text-lg transition-all shadow-sm hover:border-gray-300 text-gray-900 font-medium" 
                placeholder="Search by name, email, or blood group..."
            >
        </div>

        <!-- Members Grid -->
        @if(!empty($generalMembers) && is_array($generalMembers))
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 lg:gap-8" id="members-grid">
                @foreach($generalMembers as $member)
                    <div 
                        x-data="{ 
                            name: @js(strtolower($member['name'] ?? '')), 
                            phone: @js(strtolower($member['phone'] ?? '')),
                            email: @js(strtolower($member['email'] ?? '')),
                            blood: @js(strtolower($member['blood_group'] ?? ''))
                        }"
                        class="member-card bg-white rounded-2xl sm:rounded-3xl shadow-lg border border-gray-100 flex flex-col items-center p-2 sm:p-3 relative group transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 text-center"
                        x-show="search === '' || name.includes(search.toLowerCase()) || phone.includes(search.toLowerCase()) || email.includes(search.toLowerCase()) || blood.includes(search.toLowerCase())"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                    >
                        <!-- Member Photo (Full-Width Square-Rounded) -->
                        <div class="relative w-full aspect-[4/5] sm:aspect-square mb-5 rounded-2xl overflow-hidden bg-gray-100 border-4 border-white shadow-md transition-transform duration-500">
                            @if(!empty($member['image_path']))
                                <img src="{{ asset('storage/' . $member['image_path']) }}" alt="{{ $member['name'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300 bg-gray-50">
                                    <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                </div>
                            @endif
                        </div>

                        <!-- Member Name & Blood Group -->
                        <div class="mb-4 sm:mb-5 px-2 sm:px-4 w-full">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-1 sm:mb-2 leading-tight break-words" title="{{ $member['name'] ?? '' }}">{{ $member['name'] ?? 'Unknown Member' }}</h3>
                            @if(!empty($member['blood_group']))
                                <span class="inline-flex items-center text-[10px] sm:text-sm font-black text-red-600 bg-red-50 px-2 py-0.5 sm:px-4 sm:py-1 rounded-full uppercase tracking-widest border border-red-100">
                                    Blood: {{ $member['blood_group'] }}
                                </span>
                            @endif
                        </div>

                        <!-- Member Details (Centered) -->
                        <div class="space-y-2 sm:space-y-3 w-full border-t border-gray-50 pt-4 sm:pt-6">
                            @if(!empty($member['phone']))
                                <div class="flex flex-col sm:flex-row items-center justify-center gap-1 sm:gap-3 text-gray-600 hover:text-red-600 transition-colors">
                                    <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-gray-50 flex items-center justify-center shrink-0">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                    </div>
                                    <span class="text-[10px] sm:text-sm font-medium break-all leading-tight">{{ $member['phone'] }}</span>
                                </div>
                            @endif
                            @if(!empty($member['email']))
                                <div class="flex flex-col sm:flex-row items-center justify-center gap-1 sm:gap-3 text-gray-600 hover:text-red-600 transition-colors">
                                    <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-gray-50 flex items-center justify-center shrink-0">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                    </div>
                                    <span class="text-[10px] sm:text-sm font-medium break-all leading-tight">{{ $member['email'] }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Accent Decoration -->
                        <div class="absolute inset-x-0 bottom-0 h-1.5 bg-gradient-to-r from-transparent via-red-500 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                @endforeach
            </div>
            
            <!-- Empty State for Search -->
            <div x-show="!hasResults" x-cloak class="text-center py-20">
                <div class="flex flex-col items-center justify-center space-y-4">
                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    <p class="text-xl text-gray-500 font-medium">No results found for your search.</p>
                    <button @click="search = ''" class="text-red-600 hover:text-red-700 font-semibold focus:outline-none">Clear Search</button>
                </div>
            </div>

        @else
            <!-- Empty State when no data -->
            <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-1">No General Members Yet</h3>
                <p class="text-gray-500">The member list will be available once updated by the admin.</p>
            </div>
        @endif

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        gsap.registerPlugin(ScrollTrigger);

        // Hero Content Entrance
        gsap.from("#members-hero-content > *", {
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
