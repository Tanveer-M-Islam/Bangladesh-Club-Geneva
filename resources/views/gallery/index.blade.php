@extends('layouts.app')

@section('content')
<div class="pt-32 pb-24 bg-[#f8f9fa] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-20" id="gallery-header">
            <h1 class="text-5xl md:text-6xl font-black text-gray-900 uppercase tracking-tighter mb-6">
                Our <span class="text-red-600">Memories</span>
            </h1>
            <p class="text-gray-500 max-w-2xl mx-auto text-lg leading-relaxed">
                Explore the journey and events of Bangladesh Club Geneva through our photo archives.
            </p>
            <div class="w-24 h-1.5 bg-green-600 mx-auto rounded-full mt-8"></div>
        </div>

        <!-- Albums Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10" id="albums-grid">
            @forelse($albums as $index => $album)
                <div class="album-card-full opacity-0 translate-y-20">
                    <div class="relative group rounded-[2.5rem] overflow-hidden bg-white shadow-xl border border-gray-100 transition-all duration-700 hover:-translate-y-4 hover:shadow-2xl">
                        <!-- Image Container -->
                        <div class="relative h-64 overflow-hidden">
                            @php $images = is_array($album->images) ? $album->images : json_decode($album->images, true); @endphp
                            @if(!empty($images))
                                <img src="{{ asset('storage/' . $images[0]) }}" alt="{{ $album->title }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            
                            @if($album->is_featured)
                                <div class="absolute top-6 left-6 px-4 py-1.5 bg-red-600 text-white text-[10px] font-black uppercase tracking-widest rounded-full shadow-lg">
                                    Featured
                                </div>
                            @endif

                            @if($album->event_date)
                            <div class="absolute top-6 right-6 px-4 py-2 bg-white/90 backdrop-blur-md rounded-xl shadow-lg border border-white/20">
                                <p class="text-[10px] font-black text-red-600 uppercase tracking-widest">{{ $album->event_date->format('M d, Y') }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 line-clamp-1 leading-tight group-hover:text-red-600 transition-colors">
                                {{ $album->title }}
                            </h3>
                            
                            <div class="flex items-center justify-between gap-4 pt-6 border-t border-gray-50">
                                <a href="{{ route('gallery.show', $album) }}" class="px-6 py-3 bg-gray-900 hover:bg-green-600 text-white text-xs font-black uppercase tracking-widest rounded-xl transition-all active:scale-95 flex items-center gap-2">
                                    <span>Browse Photos</span>
                                    <span class="text-gray-500 group-hover:text-white transition-colors">({{ count($images ?? []) }})</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-24 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6 text-gray-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="text-gray-400 italic text-xl">Our memories are being collected...</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-16">
            {{ $albums->links() }}
        </div>
    </div>
</div>

<script>
    window.addEventListener('load', () => {
        gsap.to("#gallery-header", {
            y: 0,
            opacity: 1,
            duration: 1,
            ease: "power2.out"
        });

        gsap.to(".album-card-full", {
            y: 0,
            opacity: 1,
            duration: 1,
            stagger: 0.1,
            ease: "back.out(1.2)",
            scrollTrigger: {
                trigger: "#albums-grid",
                start: "top 85%"
            }
        });
    });
</script>
@endsection
