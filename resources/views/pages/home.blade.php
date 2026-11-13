@extends('layouts.app')

@section('title', 'BECCA PHOTOGRAPHY | Every Moment Deserves to Be Remembered')

@section('content')

<!-- =========================================================================
     1. HERO SECTION
========================================================================= -->
<section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden bg-[#0a0b0d]">
    <!-- Ambient Background Depth -->
    <div class="absolute inset-0 bg-radial from-[#1e1c18]/30 via-[#0a0b0d] to-[#0a0b0d] opacity-70"></div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-12 py-16 lg:py-24 grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
        <!-- Hero Text & Headline -->
        <div class="lg:col-span-6 space-y-8 z-10">
            <div class="inline-flex items-center space-x-3 text-xs tracking-[0.3em] uppercase text-[#c5a880]">
                <span class="w-8 h-[1px] bg-[#c5a880]"></span>
                <span>Editorial & Fine Art Atelier</span>
            </div>

            <h1 class="font-serif-luxury text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-light text-white leading-[1.08] tracking-tight">
                Every Moment <br>
                <span class="italic font-normal text-[#cfccc4]">Deserves to Be</span> <br>
                <span class="text-[#c5a880]">Remembered.</span>
            </h1>

            <p class="text-base sm:text-lg text-[#9e9b93] font-light leading-relaxed max-w-xl">
                Contemporary portraiture, luxury streetwear lookbooks, and authentic visual narratives documented with cinematic elegance and deep human resonance.
            </p>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center space-y-4 sm:space-y-0 sm:space-x-5 pt-4">
                <a href="{{ route('portfolio.index') }}"
                   class="inline-flex justify-center items-center px-8 py-4 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-[0.22em] font-medium hover:bg-[#d8be97] transition-all duration-300 shadow-lg shadow-[#c5a880]/10">
                    Explore Portfolio
                </a>
                <a href="{{ route('booking.create') }}"
                   class="inline-flex justify-center items-center px-8 py-4 border border-white/20 text-white text-xs uppercase tracking-[0.22em] font-medium hover:bg-white/5 hover:border-white/40 transition-all duration-300">
                    Book a Session
                </a>
            </div>

            <!-- Subtle Shoot Metadata Accent -->
            <div class="pt-8 border-t border-white/10 grid grid-cols-3 gap-6 text-left">
                <div>
                    <div class="font-serif-luxury text-2xl text-white">08+</div>
                    <div class="text-[10px] tracking-[0.2em] uppercase text-[#807e78] mt-1">Disciplines</div>
                </div>
                <div>
                    <div class="font-serif-luxury text-2xl text-white">100%</div>
                    <div class="text-[10px] tracking-[0.2em] uppercase text-[#807e78] mt-1">Authentic Works</div>
                </div>
                <div>
                    <div class="font-serif-luxury text-2xl text-white">Lagos</div>
                    <div class="text-[10px] tracking-[0.2em] uppercase text-[#807e78] mt-1">& Worldwide</div>
                </div>
            </div>
        </div>

        <!-- Hero Large Photography Display (User's Actual Photograph) -->
        <div class="lg:col-span-6 relative">
            <div class="relative mx-auto max-w-md lg:max-w-none">
                <!-- Understated Framed Backing -->
                <div class="absolute -inset-3 border border-[#c5a880]/20 translate-x-3 translate-y-3 pointer-events-none hidden sm:block"></div>

                <!-- Main Hero Image Container -->
                <div class="relative group overflow-hidden bg-[#16171b] shadow-2xl">
                    @php
                        $heroImgUrl = $heroPhoto ? $heroPhoto->url : asset('storage/photos/photo-01-aura-in-white.jpg');
                        $heroTitle = $heroPhoto ? $heroPhoto->title : 'Aura in White';
                        $heroCat = $heroPhoto && $heroPhoto->category ? $heroPhoto->category->name : 'Studio Photography';
                    @endphp
                    <img src="{{ $heroImgUrl }}"
                         alt="{{ $heroTitle }}"
                         class="w-full h-auto object-cover transition-transform duration-1000 ease-out group-hover:scale-[1.03]">

                    <!-- Image Overlay Information -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-90 flex flex-col justify-end p-6 lg:p-8">
                        <div class="text-xs uppercase tracking-[0.25em] text-[#c5a880] mb-1">
                            {{ $heroCat }}
                        </div>
                        <h2 class="font-serif-luxury text-2xl lg:text-3xl text-white tracking-wide">
                            {{ $heroTitle }}
                        </h2>
                        <div class="flex items-center justify-between mt-3 pt-3 border-t border-white/20 text-xs text-[#a09e99]">
                            <span>Client: SAVAGE XO Campaign</span>
                            <button @click="$dispatch('open-lightbox', {
                                url: '{{ $heroImgUrl }}',
                                title: '{{ $heroTitle }}',
                                category: '{{ $heroCat }}',
                                gear: 'Sony A7 IV · 85mm f/1.4 GM',
                                location: 'Becca Studio, Victoria Island'
                            })" class="text-white hover:text-[#c5a880] uppercase tracking-widest text-[11px] flex items-center space-x-1">
                                <span>Expand View</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     2. FEATURED WORK (EDITORIAL GALLERY)
========================================================================= -->
<section class="py-24 bg-[#0f1013] border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 pb-6 border-b border-white/10">
            <div>
                <div class="text-xs uppercase tracking-[0.3em] text-[#c5a880] mb-3">Selected Editorial Archive</div>
                <h2 class="font-serif-luxury text-3xl sm:text-4xl lg:text-5xl text-white font-light">
                    Featured Photography
                </h2>
            </div>
            <a href="{{ route('portfolio.index') }}"
               class="mt-4 md:mt-0 text-xs uppercase tracking-[0.25em] text-[#c5a880] hover:text-white transition-colors inline-flex items-center space-x-2">
                <span>View Full Archive</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>

        <!-- Editorial Gallery Grid (Using User's Actual Photos) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 items-start">
            @foreach($featuredPhotos as $index => $photo)
                <div class="group relative bg-[#141519] overflow-hidden transition-all duration-500 hover:-translate-y-1">
                    <div class="overflow-hidden">
                        <img src="{{ $photo->url }}"
                             alt="{{ $photo->title }}"
                             class="w-full h-auto object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                             loading="lazy">
                    </div>

                    <!-- Overlay on Hover -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                        <span class="text-[10px] tracking-[0.25em] uppercase text-[#c5a880] mb-1">
                            {{ $photo->category->name ?? 'Editorial' }}
                        </span>
                        <h3 class="font-serif-luxury text-xl text-white tracking-wide">
                            {{ $photo->title }}
                        </h3>
                        @if($photo->subtitle)
                            <p class="text-xs text-[#a09e99] mt-1">{{ $photo->subtitle }}</p>
                        @endif

                        <div class="pt-4 mt-3 border-t border-white/20 flex items-center justify-between text-xs">
                            <span class="text-[#807e78]">{{ $photo->client_name ?? 'SAVAGE XO' }}</span>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('portfolio.show', $photo->slug) }}"
                                   class="text-xs uppercase tracking-wider text-white hover:text-[#c5a880]">
                                    Details
                                </a>
                                <button @click="$dispatch('open-lightbox', {
                                    url: '{{ $photo->url }}',
                                    title: '{{ $photo->title }}',
                                    category: '{{ $photo->category->name ?? '' }}',
                                    gear: '{{ $photo->camera_gear ?? '' }}',
                                    location: '{{ $photo->location ?? '' }}'
                                })" class="text-xs uppercase tracking-wider text-[#c5a880] hover:text-white">
                                    Enlarge
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- =========================================================================
     3. ABOUT BECCA SECTION
========================================================================= -->
<section class="py-24 bg-[#0a0b0d] border-t border-white/5 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            <!-- Left Editorial Photo Diptych -->
            <div class="lg:col-span-5 grid grid-cols-2 gap-4">
                <div class="space-y-4">
                    <img src="{{ asset('storage/photos/photo-05-brutalist-serenity.jpg') }}"
                         alt="Architectural Portrait by Becca"
                         class="w-full h-auto object-cover shadow-xl"
                         loading="lazy">
                    <div class="p-4 bg-[#141519] border border-white/5">
                        <div class="text-[10px] tracking-[0.25em] uppercase text-[#c5a880]">Location</div>
                        <div class="text-xs text-white mt-1">Civic Arts Centre</div>
                    </div>
                </div>
                <div class="space-y-4 pt-8">
                    <div class="p-4 bg-[#141519] border border-white/5">
                        <div class="text-[10px] tracking-[0.25em] uppercase text-[#c5a880]">Camera System</div>
                        <div class="text-xs text-white mt-1">Sony Alpha Master</div>
                    </div>
                    <img src="{{ asset('storage/photos/photo-03-fabric-and-form.jpg') }}"
                         alt="Macro Detail by Becca"
                         class="w-full h-auto object-cover shadow-xl"
                         loading="lazy">
                </div>
            </div>

            <!-- Right Text Narrative -->
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center space-x-3 text-xs tracking-[0.3em] uppercase text-[#c5a880]">
                    <span class="w-8 h-[1px] bg-[#c5a880]"></span>
                    <span>The Philosophy</span>
                </div>

                <h2 class="font-serif-luxury text-3xl sm:text-4xl lg:text-5xl text-white font-light leading-tight">
                    "Photography is the preservation of human essence, subtle nuance, and timeless character."
                </h2>

                <p class="text-base text-[#9e9b93] font-light leading-relaxed">
                    At BECCA PHOTOGRAPHY, every session is approached as an artistic dialogue. Whether documenting high-concept streetwear campaigns for labels like SAVAGE XO, crafting intimate personal portraits, or celebrating milestones, our mission is to capture images that feel alive, enduring, and magazine-worthy.
                </p>

                <p class="text-base text-[#9e9b93] font-light leading-relaxed">
                    We deliberately reject sterile poses and generic filters. We work with genuine daylight, sculpted studio strobes, and organic human movement to create imagery that speaks for generations.
                </p>

                <div class="pt-4 flex items-center space-x-6">
                    <a href="{{ route('about') }}"
                       class="inline-flex items-center text-xs uppercase tracking-[0.2em] font-medium text-white hover:text-[#c5a880] transition-colors border-b border-[#c5a880] pb-1">
                        <span>Read Our Full Story</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                    <span class="text-white/20">|</span>
                    <span class="text-xs text-[#807e78] uppercase tracking-wider">Becca · Founder & Artist</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     4. PHOTOGRAPHY SERVICES SECTION
========================================================================= -->
<section class="py-24 bg-[#0f1013] border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
            <div class="text-xs uppercase tracking-[0.3em] text-[#c5a880]">Curated Offerings</div>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl lg:text-5xl text-white font-light">
                Photography Services
            </h2>
            <p class="text-sm text-[#9e9b93] font-light">
                Bespoke photography packages designed for creatives, brands, couples, and individuals who demand editorial excellence.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
                <div class="bg-[#141519] border border-white/5 p-8 flex flex-col justify-between hover:border-[#c5a880]/30 transition-all duration-300 group">
                    <div>
                        <!-- Header & Pricing -->
                        <div class="flex items-start justify-between pb-6 border-b border-white/10">
                            <div>
                                <span class="text-[10px] tracking-[0.25em] uppercase text-[#807e78]">Package</span>
                                <h3 class="font-serif-luxury text-2xl text-white mt-1 group-hover:text-[#c5a880] transition-colors">
                                    {{ $service->name }}
                                </h3>
                            </div>
                            <div class="text-right">
                                <span class="text-[10px] uppercase tracking-wider text-[#807e78]">{{ $service->price_label }}</span>
                                <div class="font-serif-luxury text-xl text-[#c5a880]">
                                    {{ $service->formatted_price }}
                                </div>
                            </div>
                        </div>

                        <!-- Tagline & Description -->
                        <p class="text-xs text-[#a09e99] mt-6 leading-relaxed">
                            {{ $service->description }}
                        </p>

                        <!-- Key Deliverables -->
                        <div class="mt-6 pt-6 border-t border-white/5 space-y-2 text-xs text-[#cfccc4]">
                            @if($service->duration)
                                <div class="flex items-center space-x-2">
                                    <span class="text-[#c5a880]">Duration:</span>
                                    <span>{{ $service->duration }}</span>
                                </div>
                            @endif
                            @if($service->deliverables)
                                <div class="flex items-center space-x-2">
                                    <span class="text-[#c5a880]">Deliverables:</span>
                                    <span>{{ $service->deliverables }}</span>
                                </div>
                            @endif
                            @if($service->turnaround_time)
                                <div class="flex items-center space-x-2">
                                    <span class="text-[#c5a880]">Turnaround:</span>
                                    <span>{{ $service->turnaround_time }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- CTA Actions -->
                    <div class="mt-8 pt-6 border-t border-white/10 flex items-center justify-between">
                        <a href="{{ route('services.show', $service->slug) }}"
                           class="text-xs uppercase tracking-wider text-[#9e9b93] hover:text-white transition-colors">
                            Package Details
                        </a>
                        <a href="{{ route('booking.create', ['service' => $service->id]) }}"
                           class="px-4 py-2 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-wider font-medium hover:bg-[#d8be97] transition-colors">
                            Book Session
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('services.index') }}"
               class="inline-flex items-center px-8 py-3.5 border border-white/20 text-white text-xs uppercase tracking-[0.2em] font-medium hover:border-[#c5a880] hover:text-[#c5a880] transition-colors">
                View All Photography Packages & FAQ
            </a>
        </div>
    </div>
</section>

<!-- =========================================================================
     5. FEATURED PORTFOLIO (ASYMMETRICAL EDITORIAL LAYOUT)
========================================================================= -->
<section class="py-24 bg-[#0a0b0d] border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="mb-16">
            <div class="text-xs uppercase tracking-[0.3em] text-[#c5a880] mb-2">Visual Composition</div>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl lg:text-5xl text-white font-light">
                Editorial Asymmetry
            </h2>
            <p class="text-sm text-[#807e78] mt-2 max-w-lg">
                Balancing vertical portraits, architectural backdrops, and macro brand textures.
            </p>
        </div>

        <!-- Asymmetrical Collage Grid -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
            <!-- Large Left Portrait -->
            <div class="md:col-span-5 relative group overflow-hidden bg-[#16171b]">
                <img src="{{ asset('storage/photos/photo-02-monochrome-contours.jpg') }}"
                     alt="Monochrome Contours by Becca"
                     class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105"
                     loading="lazy">
                <div class="absolute bottom-0 inset-x-0 p-6 bg-gradient-to-t from-black/90 to-transparent">
                    <span class="text-[10px] tracking-[0.25em] uppercase text-[#c5a880]">Studio Series</span>
                    <h4 class="font-serif-luxury text-xl text-white">Monochrome Contours</h4>
                </div>
            </div>

            <!-- Right Column Staggered Pair -->
            <div class="md:col-span-7 space-y-6">
                <!-- Top Wide Landscape Architectural Frame -->
                <div class="relative group overflow-hidden bg-[#16171b]">
                    <img src="{{ asset('storage/photos/photo-09-horizon-of-form.jpg') }}"
                         alt="Horizon of Form Architectural Editorial"
                         class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105"
                         loading="lazy">
                    <div class="absolute bottom-0 inset-x-0 p-6 bg-gradient-to-t from-black/90 to-transparent">
                        <span class="text-[10px] tracking-[0.25em] uppercase text-[#c5a880]">Architectural Outdoor</span>
                        <h4 class="font-serif-luxury text-xl text-white">Horizon of Form</h4>
                    </div>
                </div>

                <!-- Bottom Two Column Side by Side -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="relative group overflow-hidden bg-[#16171b]">
                        <img src="{{ asset('storage/photos/photo-04-emerald-geometry.jpg') }}"
                             alt="Emerald Geometry by Becca"
                             class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105"
                             loading="lazy">
                        <div class="absolute bottom-0 inset-x-0 p-4 bg-gradient-to-t from-black/90 to-transparent">
                            <span class="text-[9px] tracking-[0.2em] uppercase text-[#c5a880]">Lookbook</span>
                            <h4 class="font-serif-luxury text-base text-white">Emerald Geometry</h4>
                        </div>
                    </div>
                    <div class="relative group overflow-hidden bg-[#16171b]">
                        <img src="{{ asset('storage/photos/photo-10-the-focused-gaze.jpg') }}"
                             alt="The Focused Gaze by Becca"
                             class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105"
                             loading="lazy">
                        <div class="absolute bottom-0 inset-x-0 p-4 bg-gradient-to-t from-black/90 to-transparent">
                            <span class="text-[9px] tracking-[0.2em] uppercase text-[#c5a880]">Portraiture</span>
                            <h4 class="font-serif-luxury text-base text-white">The Focused Gaze</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     6. TESTIMONIALS SECTION
========================================================================= -->
<section class="py-24 bg-[#0f1013] border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="text-center max-w-xl mx-auto mb-16 space-y-3">
            <div class="text-xs uppercase tracking-[0.3em] text-[#c5a880]">Client Testimonials</div>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl text-white font-light">
                Words from Collaborators
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $t)
                <div class="p-8 bg-[#141519] border border-white/5 flex flex-col justify-between">
                    <div>
                        <div class="flex text-[#c5a880] space-x-1 mb-6">
                            @for($i = 0; $i < $t->rating; $i++)
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-sm font-light text-[#cfccc4] leading-relaxed italic">
                            "{{ $t->review_text }}"
                        </p>
                    </div>

                    <div class="pt-6 mt-6 border-t border-white/10">
                        <div class="font-serif-luxury text-lg text-white font-medium">{{ $t->client_name }}</div>
                        <div class="text-xs text-[#807e78]">{{ $t->client_role }} · {{ $t->client_company }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- =========================================================================
     7. CONTACT & BOOKING CTA SECTION
========================================================================= -->
<section class="py-24 bg-[#0a0b0d] border-t border-white/10 text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-6 lg:px-12 relative z-10 space-y-8">
        <div class="inline-flex items-center space-x-3 text-xs tracking-[0.3em] uppercase text-[#c5a880]">
            <span class="w-8 h-[1px] bg-[#c5a880]"></span>
            <span>Begin Your Story</span>
            <span class="w-8 h-[1px] bg-[#c5a880]"></span>
        </div>

        <h2 class="font-serif-luxury text-4xl sm:text-5xl lg:text-6xl text-white font-light">
            Ready to Create Something Timeless?
        </h2>

        <p class="text-base text-[#9e9b93] font-light max-w-xl mx-auto leading-relaxed">
            Whether preparing for a brand campaign, booking personal portraiture, or commemorating an unforgettable milestone, we invite you to consult with our studio.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6 pt-4">
            <a href="{{ route('booking.create') }}"
               class="px-10 py-4 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-[0.25em] font-medium hover:bg-[#d8be97] transition-all duration-300 shadow-xl">
                Book a Session Now
            </a>
            <a href="{{ route('contact') }}"
               class="px-10 py-4 border border-white/20 text-white text-xs uppercase tracking-[0.25em] font-medium hover:border-white/40 hover:bg-white/5 transition-all duration-300">
                Contact Studio
            </a>
        </div>

        <div class="pt-8 text-xs text-[#807e78]">
            Direct studio inquiries: <a href="mailto:SAVAGEXO@GMAIL.COM" class="text-[#c5a880] hover:underline font-mono">SAVAGEXO@GMAIL.COM</a>
        </div>
    </div>
</section>

@endsection
