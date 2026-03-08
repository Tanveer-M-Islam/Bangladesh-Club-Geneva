<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bangladesh Club Geneva</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind Play CDN -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8f9fa;
            color: #1a1a1a;
        }
        .glass-navbar {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            background-color: rgba(0, 0, 0, 0.7);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Typography Fixes for Tailwind Reset */
        .prose ul, .content-area ul {
            list-style-type: disc !important;
            padding-left: 1.5rem !important;
            margin-top: 0.5rem !important;
            margin-bottom: 0.5rem !important;
        }

        .prose ol, .content-area ol {
            list-style-type: decimal !important;
            padding-left: 1.5rem !important;
            margin-top: 0.5rem !important;
            margin-bottom: 0.5rem !important;
        }

        .prose li, .content-area li {
            margin-bottom: 0.25rem !important;
            display: list-item !important;
        }

        .prose p, .content-area p {
            margin-bottom: 1rem !important;
        }

        /* Notice Beep Animation */
        @keyframes notice-beep {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
            70% { transform: scale(1.05); box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }

        .notice-beep-highlight {
            position: relative;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 9999px;
            padding: 0.5rem 1rem !important;
            animation: notice-beep 2s infinite;
        }

        .notice-beep-highlight::after {
            content: '';
            position: absolute;
            top: 4px;
            right: 4px;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            display: block;
        }

        /* Custom Scrollbar */
        .scrollbar-custom::-webkit-scrollbar {
            width: 4px;
        }
        .scrollbar-custom::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .scrollbar-custom::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        .scrollbar-custom::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
    @stack('styles')
</head>
<body class="antialiased overflow-x-hidden">
    <!-- Navbar -->
    <nav x-data="{ mobileMenuOpen: false }" class="fixed top-0 left-0 right-0 z-50 glass-navbar transition-all duration-300 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        @if($siteSetting && $siteSetting->navbar_logo_path)
                            <img src="{{ asset('storage/' . $siteSetting->navbar_logo_path) }}" alt="Bangladesh Club Geneva" class="h-16 w-auto">
                        @else
                            <img src="{{ asset('images/logo.png') }}" alt="Bangladesh Club Geneva" class="h-16 w-auto">
                        @endif
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ url('/') }}" class="text-sm font-medium transition-colors {{ request()->is('/') ? 'text-red-500' : 'hover:text-red-500' }}">Home</a>
                    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                        <button class="text-sm font-medium transition-colors flex items-center gap-1 {{ request()->routeIs(['about-us', 'speech', 'executive-committee', 'general-members', 'membership.policy']) ? 'text-red-500' : 'hover:text-red-500' }}">
                            About BCG <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" x-transition class="absolute pt-4 -left-4 w-48">
                            <div class="bg-black/90 border border-white/10 rounded-lg shadow-xl py-2 backdrop-blur-xl">
                                <a href="{{ route('about-us') }}" class="block px-4 py-2 text-sm {{ request()->routeIs('about-us') ? 'text-red-500 bg-white/10' : 'hover:bg-white/10' }}">About us</a>
                                <a href="{{ route('speech') }}" class="block px-4 py-2 text-sm {{ request()->routeIs('speech') ? 'text-red-500 bg-white/10' : 'hover:bg-white/10' }}">Speech</a>
                                <a href="{{ route('executive-committee') }}" class="block px-4 py-2 text-sm {{ request()->routeIs('executive-committee') ? 'text-red-500 bg-white/10' : 'hover:bg-white/10' }}">Executive Committee</a>
                                <a href="{{ route('general-members') }}" class="block px-4 py-2 text-sm {{ request()->routeIs('general-members') ? 'text-red-500 bg-white/10' : 'hover:bg-white/10' }}">General Member</a>
                                <a href="{{ route('membership.policy') }}" class="block px-4 py-2 text-sm {{ request()->routeIs('membership.policy') ? 'text-red-500 bg-white/10' : 'hover:bg-white/10' }}">Membership Policy</a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('gallery.index') }}" class="text-sm font-medium transition-colors {{ request()->routeIs('gallery.index') ? 'text-red-500' : 'hover:text-red-500' }}">Photo Gallery</a>
                    <a href="{{ route('news') }}" class="text-sm font-medium transition-colors {{ request()->routeIs('news') ? 'text-red-500' : 'hover:text-red-500' }}">News</a>
                    <a href="{{ route('contact') }}" class="text-sm font-medium transition-colors {{ request()->routeIs('contact') ? 'text-red-500' : 'hover:text-red-500' }}">Contact Us</a>
                    <a href="{{ route('membership') }}" class="text-sm font-medium transition-colors {{ request()->routeIs('membership') ? 'text-red-500' : 'hover:text-red-500' }}">Be a Member</a>
                    <a href="{{ route('donation') }}" class="text-sm font-medium transition-colors {{ request()->routeIs('donation') ? 'text-red-500' : 'hover:text-red-500' }}">Donation</a>
                    <a href="{{ route('notice') }}" class="text-sm font-medium transition-all duration-300 {{ request()->routeIs('notice') ? 'text-red-500' : 'hover:text-red-500' }} {{ $hasNotices ? 'notice-beep-highlight flex items-center gap-2 px-6' : '' }}">
                        @if($hasNotices)
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                        </span>
                        @endif
                        Notice
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white hover:text-red-500">
                        <svg x-show="!mobileMenuOpen" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                        <svg x-show="mobileMenuOpen" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="md:hidden bg-black/95 backdrop-blur-3xl border-b border-white/10">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="{{ url('/') }}" class="block px-3 py-4 text-base font-semibold border-b border-white/5 {{ request()->is('/') ? 'text-red-500' : 'hover:text-red-500' }}">Home</a>
                <div x-data="{ openAbout: false }">
                    <button @click="openAbout = !openAbout" class="w-full flex items-center justify-between px-3 py-4 text-base font-semibold border-b border-white/5 focus:outline-none text-left {{ request()->routeIs(['about-us', 'speech', 'executive-committee', 'general-members', 'membership.policy']) ? 'text-red-500' : 'hover:text-red-500' }}">
                        About BCG
                        <svg :class="openAbout ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="openAbout" x-cloak class="bg-white/5 border-b border-white/5">
                        <a href="{{ route('about-us') }}" class="block px-6 py-3 text-sm font-medium border-b border-white/5 {{ request()->routeIs('about-us') ? 'text-red-500' : 'text-white/80 hover:text-white' }}">About us</a>
                        <a href="{{ route('speech') }}" class="block px-6 py-3 text-sm font-medium border-b border-white/5 {{ request()->routeIs('speech') ? 'text-red-500' : 'text-white/80 hover:text-white' }}">Speech</a>
                        <a href="{{ route('executive-committee') }}" class="block px-6 py-3 text-sm font-medium border-b border-white/5 {{ request()->routeIs('executive-committee') ? 'text-red-500' : 'text-white/80 hover:text-white' }}">Executive Committee</a>
                        <a href="{{ route('general-members') }}" class="block px-6 py-3 text-sm font-medium border-b border-white/5 {{ request()->routeIs('general-members') ? 'text-red-500' : 'text-white/80 hover:text-white' }}">General Member</a>
                        <a href="{{ route('membership.policy') }}" class="block px-6 py-3 text-sm font-medium {{ request()->routeIs('membership.policy') ? 'text-red-500' : 'text-white/80 hover:text-white' }}">Membership Policy</a>
                    </div>
                </div>
                <a href="{{ route('gallery.index') }}" class="block px-3 py-4 text-base font-semibold border-b border-white/5 {{ request()->routeIs('gallery.index') ? 'text-red-500' : 'hover:text-red-500' }}">Photo Gallery</a>
                <a href="{{ route('news') }}" class="block px-3 py-4 text-base font-semibold border-b border-white/5 {{ request()->routeIs('news') ? 'text-red-500' : 'hover:text-red-500' }}">News</a>
                <a href="{{ route('contact') }}" class="block px-3 py-4 text-base font-semibold border-b border-white/5 {{ request()->routeIs('contact') ? 'text-red-500' : 'hover:text-red-500' }}">Contact Us</a>
                <a href="{{ route('membership') }}" class="block px-3 py-4 text-base font-semibold border-b border-white/5 {{ request()->routeIs('membership') ? 'text-red-500' : 'hover:text-red-500' }}">Be a Member</a>
                <a href="{{ route('donation') }}" class="block px-3 py-4 text-base font-semibold border-b border-white/5 {{ request()->routeIs('donation') ? 'text-red-500' : 'hover:text-red-500' }}">Donation</a>
                <a href="{{ route('notice') }}" class="block px-3 py-4 text-base font-semibold {{ request()->routeIs('notice') ? 'text-red-500' : 'hover:text-red-500' }} relative group">
                    <div class="flex items-center gap-3">
                        @if($hasNotices)
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                        </span>
                        @endif
                        Notice
                    </div>
                </a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Brand & About -->
                <div class="lg:col-span-2">
                    <a href="{{ url('/') }}" class="inline-block mb-6">
                        @if($siteSetting && $siteSetting->navbar_logo_path)
                            <img src="{{ asset('storage/' . $siteSetting->navbar_logo_path) }}" alt="BCG Logo" class="h-16 w-auto">
                        @else
                            <img src="{{ asset('images/logo.png') }}" alt="BCG Logo" class="h-16 w-auto">
                        @endif
                    </a>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-md">
                        {{ $footerSetting->footer_info ?? 'Bangladesh Club Geneva (BCG) is a community organization dedicated to promoting Bangladeshi culture and supporting the community in Geneva.' }}
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-bold mb-6 text-white uppercase tracking-wider">Quick Links</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('about-us') }}" class="text-gray-400 hover:text-red-500 transition-colors text-sm">About Us</a></li>
                        <li><a href="{{ route('notice') }}" class="text-gray-400 hover:text-red-500 transition-colors text-sm">Notice Board</a></li>
                        <li><a href="{{ route('membership') }}" class="text-gray-400 hover:text-red-500 transition-colors text-sm">Membership</a></li>
                        <li><a href="{{ route('donation') }}" class="text-gray-400 hover:text-red-500 transition-colors text-sm">Donation</a></li>
                    </ul>
                </div>

                <!-- Social Links -->
                <div>
                    <h4 class="text-lg font-bold mb-6 text-white uppercase tracking-wider">Connect With Us</h4>
                    <div class="flex flex-wrap gap-4">
                        @if(!empty($footerSetting->facebook_url))
                            <a href="{{ $footerSetting->facebook_url }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-blue-600 transition-all border border-white/10 group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                        @endif
                        @if(!empty($footerSetting->twitter_url))
                            <a href="{{ $footerSetting->twitter_url }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-sky-500 transition-all border border-white/10 group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                        @endif
                        @if(!empty($footerSetting->instagram_url))
                            <a href="{{ $footerSetting->instagram_url }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-pink-600 transition-all border border-white/10 group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.245 2.242 1.308 3.607.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.063 1.366-.333 2.633-1.308 3.608-.975.975-2.242 1.245-3.607 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.063-2.633-.333-3.608-1.308-.975-.975-1.245-2.242-1.308-3.607-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.245 3.607-1.308 1.266-.058 1.646-.07 4.85-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-1.28.058-2.153.261-2.919.559-.791.307-1.463.719-2.135 1.391-.672.672-1.084 1.344-1.391 2.135-.298.766-.501 1.639-.559 2.919-.058 1.28-.072 1.688-.072 4.947s.014 3.667.072 4.947c.058 1.28.261 2.153.559 2.919.307.791.719 1.463 1.391 2.135.672.672 1.344 1.084 2.135 1.391.766.298 1.639.501 2.919.559 1.28.058 1.688.072 4.947.072s3.667-.014 4.947-.072c1.28-.058 2.153-.261 2.919-.559.791-.307 1.463-.719 2.135-1.391.672-.672 1.084-1.344 1.391-2.135.298-.766.501-1.639.559-2.919.058-1.28.072-1.688.072-4.947s-.014-3.667-.072-4.947c-.058-1.28-.261-2.153-.559-2.919-.307-.791-.719-1.463-1.391-2.135-.672-.672-1.344-1.084-2.135-1.391-.766-.298-1.639-.501-2.919-.559-1.28-.058-1.688-.072-4.947-.072zM12 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </a>
                        @endif
                        @if(!empty($footerSetting->youtube_url))
                            <a href="{{ $footerSetting->youtube_url }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-red-600 transition-all border border-white/10 group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505a3.017 3.017 0 00-2.122 2.136C0 8.055 0 12 0 12s0 3.945.501 5.814a3.015 3.015 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.945 24 12 24 12s0-3.945-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
                <p class="text-xs text-gray-500 font-medium tracking-wide">
                    {{ $footerSetting->copyright_text ?? 'Copyright © ' . date('Y') . ' Bangladesh Club Geneva. All Rights Reserved.' }}
                </p>
                <p class="text-[10px] text-gray-600 uppercase tracking-widest font-bold">
                    Developed By Limmex Automation
                </p>
            </div>
        </div>
    </footer>

    <script>
        // GSAP Initialization logic can go here
        window.addEventListener('DOMContentLoaded', () => {
            // Any global animations if needed
        });
    </script>
    @yield('scripts')
    @stack('scripts')
</body>
</html>
