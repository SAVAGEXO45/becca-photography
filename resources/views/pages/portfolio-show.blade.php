@extends('layouts.app')

@section('title', $photo->title . ' | BECCA PHOTOGRAPHY')
@section('meta_description', $photo->description ?? ($photo->title . ' — fine art and editorial photography by BECCA PHOTOGRAPHY.'))

@section('content')

<!-- Back Bar & Navigation Header -->
<div class="bg-[#0b0c0e] border-b border-white/5 py-4 px-6 lg:px-12">
    <div class="max-w-7xl mx-auto flex items-center justify-between text-xs uppercase tracking-widest text-[#807e78]">
        <a href="{{ route('portfolio.index') }}" class="hover:text-white transition-colors flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span>Back to Portfolio</span>
        </a>

        <!-- Prev / Next Navigation -->
        <div class="flex items-center space-x-6">
            @if($previousPhoto)
                <a href="{{ route('portfolio.show', $previousPhoto->slug) }}" class="hover:text-[#c5a880] transition-colors flex items-center space-x-1">
                    <span>&larr; Previous</span>
                </a>
            @endif
            @if($nextPhoto)
                <a href="{{ route('portfolio.show', $nextPhoto->slug) }}" class="hover:text-[#c5a880] transition-colors flex items-center space-x-1">
                    <span>Next &rarr;</span>
                </a>
            @endif
        </div>
    </div>
</div>

<!-- Main Photo Showcase -->
<section class="py-12 lg:py-20 bg-[#0f1013]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            <!-- Large Image Presentation (Full Width / True Aspect Ratio) -->
            <div class="lg:col-span-8 bg-[#141519] p-2 sm:p-4 shadow-2xl relative group">
                <img src="{{ $photo->url }}"
                     alt="{{ $photo->title }}"
                     class="w-full h-auto object-contain mx-auto max-h-[85vh] cursor-zoom-in"
                     @click="$dispatch('open-lightbox', {
                        url: '{{ $photo->url }}',
                        title: '{{ $photo->title }}',
                        category: '{{ $photo->category->name ?? '' }}',
                        gear: '{{ $photo->camera_gear ?? '' }}',
                        location: '{{ $photo->location ?? '' }}'
                     })">

                <div class="absolute bottom-6 right-6 opacity-0 group-hover:opacity-100 transition-opacity">
                    <button @click="$dispatch('open-lightbox', {
                        url: '{{ $photo->url }}',
                        title: '{{ $photo->title }}',
                        category: '{{ $photo->category->name ?? '' }}',
                        gear: '{{ $photo->camera_gear ?? '' }}',
                        location: '{{ $photo->location ?? '' }}'
                    })" class="px-4 py-2 bg-black/80 backdrop-blur text-white text-xs uppercase tracking-wider border border-white/20">
                        View Fullscreen
                    </button>
                </div>
            </div>

            <!-- Metadata & Editorial Narrative -->
            <div class="lg:col-span-4 space-y-8">
                <div>
                    <div class="text-xs uppercase tracking-[0.3em] text-[#c5a880] mb-2">
                        {{ $photo->category->name ?? 'Editorial Work' }}
                    </div>
                    <h1 class="font-serif-luxury text-3xl sm:text-4xl text-white font-light">
                        {{ $photo->title }}
                    </h1>
                    @if($photo->subtitle)
                        <div class="text-sm text-[#a09e99] mt-2 font-light italic">
                            {{ $photo->subtitle }}
                        </div>
                    @endif
                </div>

                @if($photo->description)
                    <div class="border-t border-b border-white/10 py-6 text-sm text-[#cfccc4] font-light leading-relaxed">
                        {{ $photo->description }}
                    </div>
                @endif

                <!-- Shoot Specifications Table -->
                <div class="space-y-3 text-xs tracking-wider uppercase text-[#807e78]">
                    <div class="flex items-center justify-between pb-2 border-b border-white/5">
                        <span class="text-white">Client / Campaign</span>
                        <span class="text-[#cfccc4]">{{ $photo->client_name ?? 'SAVAGE XO' }}</span>
                    </div>

                    @if($photo->location)
                        <div class="flex items-center justify-between pb-2 border-b border-white/5">
                            <span class="text-white">Location</span>
                            <span class="text-[#cfccc4]">{{ $photo->location }}</span>
                        </div>
                    @endif

                    @if($photo->camera_gear)
                        <div class="flex items-center justify-between pb-2 border-b border-white/5">
                            <span class="text-white">Camera Gear</span>
                            <span class="text-[#cfccc4]">{{ $photo->camera_gear }}</span>
                        </div>
                    @endif

                    @if($photo->dimensions)
                        <div class="flex items-center justify-between pb-2 border-b border-white/5">
                            <span class="text-white">Native Resolution</span>
                            <span class="text-[#cfccc4]">{{ $photo->dimensions }} px</span>
                        </div>
                    @endif

                    <div class="flex items-center justify-between pb-2 border-b border-white/5">
                        <span class="text-white">Format</span>
                        <span class="text-[#cfccc4]">{{ ucfirst($photo->aspect_ratio) }} Frame</span>
                    </div>

                    <div class="flex items-center justify-between pb-2 border-b border-white/5">
                        <span class="text-white">Archived Date</span>
                        <span class="text-[#cfccc4]">{{ $photo->formatted_date }}</span>
                    </div>
                </div>

                <!-- CTA Action -->
                <div class="pt-4 space-y-3">
                    <a href="{{ route('booking.create') }}"
                       class="block text-center w-full py-4 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-[0.2em] font-medium hover:bg-[#d8be97] transition-colors shadow-lg">
                        Inquire for Similar Shoot
                    </a>
                    <a href="{{ route('contact') }}"
                       class="block text-center w-full py-3.5 border border-white/20 text-white text-xs uppercase tracking-[0.2em] font-medium hover:bg-white/5 transition-colors">
                        Ask About Commercial Licensing
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Works From Same Series/Category -->
@if($relatedPhotos->isNotEmpty())
    <section class="py-16 bg-[#0a0b0d] border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="flex items-center justify-between mb-8 pb-4 border-b border-white/10">
                <h3 class="font-serif-luxury text-2xl text-white">Related Works</h3>
                <a href="{{ route('portfolio.index', ['category' => $photo->category->slug ?? '']) }}"
                   class="text-xs uppercase tracking-widest text-[#c5a880] hover:underline">
                    View Category Archive &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @foreach($relatedPhotos as $rel)
                    <a href="{{ route('portfolio.show', $rel->slug) }}" class="group block bg-[#141519] overflow-hidden">
                        <div class="overflow-hidden">
                            <img src="{{ $rel->url }}"
                                 alt="{{ $rel->title }}"
                                 class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105"
                                 loading="lazy">
                        </div>
                        <div class="p-4">
                            <div class="text-[9px] uppercase tracking-widest text-[#c5a880]">{{ $rel->category->name ?? 'Work' }}</div>
                            <h4 class="font-serif-luxury text-lg text-white group-hover:text-[#c5a880] transition-colors mt-1">{{ $rel->title }}</h4>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif

@endsection
