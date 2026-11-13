@extends('layouts.app')

@section('title', 'Portfolio Archive | BECCA PHOTOGRAPHY')
@section('meta_description', 'Explore the complete photographic portfolio of BECCA PHOTOGRAPHY — Fashion lookbooks, intimate portraits, studio sessions, and architectural storytelling.')

@section('content')

<!-- Portfolio Header -->
<section class="pt-20 pb-12 bg-[#0a0b0d] border-b border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 text-center space-y-4">
        <div class="inline-flex items-center space-x-3 text-xs tracking-[0.3em] uppercase text-[#c5a880]">
            <span class="w-8 h-[1px] bg-[#c5a880]"></span>
            <span>Archival Works</span>
            <span class="w-8 h-[1px] bg-[#c5a880]"></span>
        </div>

        <h1 class="font-serif-luxury text-4xl sm:text-5xl lg:text-6xl text-white font-light">
            Selected Portfolio
        </h1>

        <p class="text-base text-[#9e9b93] font-light max-w-xl mx-auto leading-relaxed">
            A curated collection of editorial assignments, intimate portraits, fashion campaigns, and architectural studies photographed by Becca.
        </p>

        <!-- Category Filter Tabs -->
        <div class="pt-8 flex flex-wrap items-center justify-center gap-2 sm:gap-3">
            <a href="{{ route('portfolio.index') }}"
               class="px-5 py-2.5 text-xs uppercase tracking-widest transition-all duration-300 {{ !$selectedCategorySlug || $selectedCategorySlug === 'all' ? 'bg-[#c5a880] text-[#0f1013] font-semibold' : 'bg-[#141519] text-[#9e9b93] hover:text-white border border-white/5 hover:border-white/20' }}">
                All Works ({{ \App\Models\Photo::where('is_published', true)->count() }})
            </a>

            @foreach($categories as $category)
                <a href="{{ route('portfolio.index', ['category' => $category->slug]) }}"
                   class="px-5 py-2.5 text-xs uppercase tracking-widest transition-all duration-300 {{ $selectedCategorySlug === $category->slug ? 'bg-[#c5a880] text-[#0f1013] font-semibold' : 'bg-[#141519] text-[#9e9b93] hover:text-white border border-white/5 hover:border-white/20' }}">
                    {{ $category->name }}
                    <span class="text-[10px] opacity-60 ml-1">({{ $category->published_photos_count }})</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Masonry Gallery Section -->
<section class="py-16 bg-[#0f1013]" x-data="portfolioGallery()">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        @if($photos->isEmpty())
            <div class="text-center py-24 bg-[#141519] border border-white/5 p-12">
                <p class="text-sm text-[#807e78] uppercase tracking-widest">No photographs currently found in this category.</p>
                <div class="mt-4">
                    <a href="{{ route('portfolio.index') }}" class="text-xs uppercase tracking-widest text-[#c5a880] hover:underline">
                        Return to All Works
                    </a>
                </div>
            </div>
        @else
            <!-- Editorial Masonry Columns -->
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-8 space-y-8">
                @foreach($photos as $index => $photo)
                    <div class="break-inside-avoid group relative bg-[#141519] overflow-hidden transition-all duration-500 hover:-translate-y-1 shadow-lg">
                        <!-- Photograph Display (Natural Aspect Ratio) -->
                        <div class="overflow-hidden bg-[#1a1b20]">
                            <img src="{{ $photo->url }}"
                                 alt="{{ $photo->title }}"
                                 class="w-full h-auto object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                                 loading="lazy">
                        </div>

                        <!-- Hover Card Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <span class="text-[10px] tracking-[0.25em] uppercase text-[#c5a880] mb-1">
                                {{ $photo->category->name ?? 'Photography' }}
                            </span>
                            <h2 class="font-serif-luxury text-2xl text-white tracking-wide">
                                {{ $photo->title }}
                            </h2>

                            @if($photo->subtitle)
                                <p class="text-xs text-[#a09e99] mt-1">{{ $photo->subtitle }}</p>
                            @endif

                            <div class="pt-4 mt-3 border-t border-white/20 flex items-center justify-between text-xs">
                                <span class="text-[#807e78] text-[11px]">{{ $photo->location ?? 'Studio / Location' }}</span>
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('portfolio.show', $photo->slug) }}"
                                       class="text-xs uppercase tracking-wider text-white hover:text-[#c5a880]">
                                        Details
                                    </a>
                                    <button @click="openModal({{ $index }})"
                                            class="text-xs uppercase tracking-wider text-[#c5a880] hover:text-white">
                                        Lightbox
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Client Quote Banner -->
<section class="py-16 bg-[#0a0b0d] border-t border-white/5 text-center">
    <div class="max-w-3xl mx-auto px-6">
        <blockquote class="font-serif-luxury text-2xl sm:text-3xl font-light text-white italic">
            "Light is our brush; the camera is our canvas. Every click captures not just an angle, but an emotion."
        </blockquote>
        <div class="text-xs uppercase tracking-[0.25em] text-[#c5a880] mt-4">
            Becca · Lead Photographer
        </div>
    </div>
</section>

<!-- Portfolio Alpine Data Injection -->
<script>
    function portfolioGallery() {
        const photoList = @json($photosJson);

        return {
            openModal(idx) {
                window.dispatchEvent(new CustomEvent('open-lightbox', {
                    detail: {
                        photos: photoList,
                        index: idx
                    }
                }));
            }
        };
    }
</script>

@endsection
