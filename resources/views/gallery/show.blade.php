@extends('layouts.app')

@section('content')
<div x-data="{ 
    lightboxOpen: false, 
    activeImage: '', 
    openLightbox(img) { 
        this.activeImage = img; 
        this.lightboxOpen = true; 
        document.body.style.overflow = 'hidden';
    },
    closeLightbox() { 
        this.lightboxOpen = false; 
        document.body.style.overflow = 'auto';
    } 
}" class="pt-32 pb-24 bg-white min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs & Header -->
        <nav class="flex mb-12" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-4">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-500 hover:text-red-600 transition-colors flex items-center gap-2">
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <a href="{{ route('gallery.index') }}" class="ml-1 text-sm font-medium text-gray-500 hover:text-red-600 transition-colors">Gallery</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-sm font-black text-gray-900 line-clamp-1">{{ $album->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-16 border-b border-gray-100 pb-12">
            <div class="flex-1">
                <div class="inline-flex items-center px-4 py-2 bg-red-600/10 text-red-600 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">
                    {{ $album->event_date->format('F d, Y') }}
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-gray-900 uppercase tracking-tighter leading-[1.1]">
                    {{ $album->title }}
                </h1>
            </div>
            <div class="flex-shrink-0">
                <p class="text-gray-400 font-bold text-sm uppercase tracking-widest">
                    {{ count($album->images ?? []) }} Photos Captured
                </p>
            </div>
        </div>

        <!-- Photos Grid -->
        <div class="columns-1 sm:columns-2 lg:columns-3 gap-8 space-y-8" id="photos-masonry">
            @php $images = is_array($album->images) ? $album->images : json_decode($album->images, true); @endphp
            @foreach($images ?? [] as $index => $image)
                <div class="photo-item break-inside-avoid opacity-0 translate-y-10">
                    <div @click="openLightbox('{{ asset('storage/' . $image) }}')" class="relative group rounded-3xl overflow-hidden cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100">
                        <img src="{{ asset('storage/' . $image) }}" class="w-full h-auto transition-transform duration-1000 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center">
                            <div class="w-14 h-14 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center border border-white/30 transform scale-50 group-hover:scale-100 transition-transform duration-500">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div x-show="lightboxOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[100] flex items-center justify-center bg-black/95 backdrop-blur-xl p-4 sm:p-12"
         @keydown.escape.window="closeLightbox()">
        
        <button @click="closeLightbox()" class="absolute top-8 right-8 text-white/50 hover:text-white transition-colors">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <div class="max-w-5xl max-h-full flex items-center justify-center">
            <img :src="activeImage" class="max-w-full max-h-screen rounded-xl shadow-2xl object-contain shadow-white/5">
        </div>
    </div>
</div>

<script>
    window.addEventListener('load', () => {
        gsap.to(".photo-item", {
            y: 0,
            opacity: 1,
            duration: 1,
            stagger: 0.1,
            ease: "power4.out",
            scrollTrigger: {
                trigger: "#photos-masonry",
                start: "top 85%"
            }
        });
    });
</script>
@endsection
