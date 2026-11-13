@extends('layouts.app')

@section('title', 'Photography Services & Packages | BECCA PHOTOGRAPHY')
@section('meta_description', 'Discover bespoke photography services by BECCA PHOTOGRAPHY — Portrait sessions, fashion campaigns, studio sessions, outdoor shoots, weddings, and milestone celebrations.')

@section('content')

<!-- Header Banner -->
<section class="pt-20 pb-16 bg-[#0a0b0d] border-b border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 text-center space-y-4">
        <div class="inline-flex items-center space-x-3 text-xs tracking-[0.3em] uppercase text-[#c5a880]">
            <span class="w-8 h-[1px] bg-[#c5a880]"></span>
            <span>Investment & Experience</span>
            <span class="w-8 h-[1px] bg-[#c5a880]"></span>
        </div>

        <h1 class="font-serif-luxury text-4xl sm:text-5xl lg:text-6xl text-white font-light">
            Services & Packages
        </h1>

        <p class="text-base text-[#9e9b93] font-light max-w-2xl mx-auto leading-relaxed">
            Transparent pricing, comprehensive deliverables, and uncompromising editorial excellence for every project.
        </p>
    </div>
</section>

<!-- Services Grid -->
<section class="py-20 bg-[#0f1013]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 space-y-16">
        @foreach($services as $index => $service)
            <div class="bg-[#141519] border border-white/5 p-8 lg:p-12 hover:border-[#c5a880]/30 transition-all duration-300">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                    <!-- Service Title & Core Details -->
                    <div class="lg:col-span-5 space-y-4">
                        <div class="flex items-center space-x-3">
                            <span class="font-serif-luxury text-2xl text-[#c5a880]">0{{ $index + 1 }}</span>
                            <span class="text-[10px] tracking-[0.25em] uppercase text-[#807e78]">Package Overview</span>
                            @if($service->is_popular)
                                <span class="px-2 py-0.5 text-[9px] uppercase tracking-wider bg-[#c5a880]/20 text-[#c5a880] border border-[#c5a880]/40">
                                    Most Requested
                                </span>
                            @endif
                        </div>

                        <h2 class="font-serif-luxury text-3xl sm:text-4xl text-white">
                            {{ $service->name }}
                        </h2>

                        @if($service->tagline)
                            <p class="text-xs text-[#c5a880] uppercase tracking-wider font-medium">
                                {{ $service->tagline }}
                            </p>
                        @endif

                        <p class="text-sm text-[#9e9b93] font-light leading-relaxed pt-2">
                            {{ $service->description }}
                        </p>

                        <!-- Pricing Badge -->
                        <div class="pt-4 border-t border-white/10">
                            <div class="text-[10px] uppercase tracking-widest text-[#807e78]">{{ $service->price_label }}</div>
                            <div class="font-serif-luxury text-3xl text-white mt-1">
                                {{ $service->formatted_price }}
                            </div>
                        </div>

                        <div class="pt-4">
                            <a href="{{ route('booking.create', ['service' => $service->id]) }}"
                               class="inline-block px-8 py-3.5 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-[0.2em] font-medium hover:bg-[#d8be97] transition-colors shadow-md">
                                Book This Package
                            </a>
                        </div>
                    </div>

                    <!-- Deliverables & Features Checklist -->
                    <div class="lg:col-span-7 bg-[#0f1013] border border-white/5 p-6 lg:p-8 space-y-6">
                        <h3 class="text-xs font-semibold uppercase tracking-[0.25em] text-white">
                            Package Specifications & Inclusions
                        </h3>

                        <!-- Specification Metrics -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pb-6 border-b border-white/10 text-xs">
                            @if($service->duration)
                                <div>
                                    <span class="text-[#807e78] block text-[10px] uppercase tracking-wider">Session Length</span>
                                    <span class="text-white font-medium mt-1 block">{{ $service->duration }}</span>
                                </div>
                            @endif
                            @if($service->deliverables)
                                <div>
                                    <span class="text-[#807e78] block text-[10px] uppercase tracking-wider">Deliverables</span>
                                    <span class="text-white font-medium mt-1 block">{{ $service->deliverables }}</span>
                                </div>
                            @endif
                            @if($service->turnaround_time)
                                <div>
                                    <span class="text-[#807e78] block text-[10px] uppercase tracking-wider">Turnaround</span>
                                    <span class="text-white font-medium mt-1 block">{{ $service->turnaround_time }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Included Features List -->
                        @if(!empty($service->features))
                            <div class="space-y-3">
                                <span class="text-[10px] uppercase tracking-wider text-[#807e78]">What Is Included:</span>
                                <ul class="space-y-2.5">
                                    @foreach($service->features as $feat)
                                        <li class="flex items-start text-xs text-[#cfccc4]">
                                            <svg class="w-4 h-4 text-[#c5a880] shrink-0 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>{{ $feat }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="pt-4 border-t border-white/5 text-[11px] text-[#807e78] italic">
                            * Custom requirements or extended location shoot arrangements can be requested during booking.
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- Process / How It Works Timeline -->
<section class="py-20 bg-[#0a0b0d] border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="text-center max-w-xl mx-auto mb-16 space-y-3">
            <div class="text-xs uppercase tracking-[0.3em] text-[#c5a880]">The Workflow</div>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl text-white font-light">
                The Session Journey
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="p-6 bg-[#141519] border border-white/5 space-y-3">
                <span class="font-serif-luxury text-2xl text-[#c5a880]">Phase 01</span>
                <h4 class="text-white font-medium text-sm">Consultation & Moodboard</h4>
                <p class="text-xs text-[#9e9b93] font-light leading-relaxed">
                    We define the creative direction, wardrobe styling, lighting palette, and location details ahead of shoot day.
                </p>
            </div>

            <div class="p-6 bg-[#141519] border border-white/5 space-y-3">
                <span class="font-serif-luxury text-2xl text-[#c5a880]">Phase 02</span>
                <h4 class="text-white font-medium text-sm">The Photoshoot Experience</h4>
                <p class="text-xs text-[#9e9b93] font-light leading-relaxed">
                    A relaxed, guided session with live monitor previews, music, and thoughtful direction to capture authentic presence.
                </p>
            </div>

            <div class="p-6 bg-[#141519] border border-white/5 space-y-3">
                <span class="font-serif-luxury text-2xl text-[#c5a880]">Phase 03</span>
                <h4 class="text-white font-medium text-sm">Proofing & Curation</h4>
                <p class="text-xs text-[#9e9b93] font-light leading-relaxed">
                    Within 48 hours, you receive a private digital contact sheet to select your favorite frames for master finishing.
                </p>
            </div>

            <div class="p-6 bg-[#141519] border border-white/5 space-y-3">
                <span class="font-serif-luxury text-2xl text-[#c5a880]">Phase 04</span>
                <h4 class="text-white font-medium text-sm">Fine Art Delivery</h4>
                <p class="text-xs text-[#9e9b93] font-light leading-relaxed">
                    Meticulously color-graded, high-resolution master TIFF and web-optimized images delivered in a private cloud gallery.
                </p>
            </div>
        </div>
    </div>
</section>

@endsection
