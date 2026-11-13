@extends('layouts.app')

@section('title', 'About the Artist & Atelier | BECCA PHOTOGRAPHY')
@section('meta_description', 'Discover the story, creative philosophy, and visual mastery behind BECCA PHOTOGRAPHY — founded by lead visual artist Becca in Lagos.')

@section('content')

<!-- Header Banner -->
<section class="pt-20 pb-16 bg-[#0a0b0d] border-b border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 text-center space-y-4">
        <div class="inline-flex items-center space-x-3 text-xs tracking-[0.3em] uppercase text-[#c5a880]">
            <span class="w-8 h-[1px] bg-[#c5a880]"></span>
            <span>The Story & The Artist</span>
            <span class="w-8 h-[1px] bg-[#c5a880]"></span>
        </div>

        <h1 class="font-serif-luxury text-4xl sm:text-5xl lg:text-6xl text-white font-light">
            About BECCA PHOTOGRAPHY
        </h1>

        <p class="text-base text-[#9e9b93] font-light max-w-2xl mx-auto leading-relaxed">
            Where editorial precision converges with raw human character, textural craftsmanship, and enduring emotion.
        </p>
    </div>
</section>

<!-- Brand Story & Main Narrative Section -->
<section class="py-20 bg-[#0f1013]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            <!-- Left Portrait of the Craft -->
            <div class="lg:col-span-5 relative">
                <div class="bg-[#141519] p-3 shadow-2xl relative">
                    <img src="{{ asset('storage/photos/photo-01-aura-in-white.jpg') }}"
                         alt="Studio Portraiture by Becca"
                         class="w-full h-auto object-cover">
                    <div class="p-4 bg-[#0e0f12] border-t border-white/10 mt-3 text-xs flex justify-between items-center text-[#807e78]">
                        <span>Studio Session · Lagos</span>
                        <span class="text-[#c5a880]">Lead Editorial Series</span>
                    </div>
                </div>
            </div>

            <!-- Right Narrative -->
            <div class="lg:col-span-7 space-y-6">
                <div class="text-xs uppercase tracking-[0.25em] text-[#c5a880]">The Genesis</div>
                <h2 class="font-serif-luxury text-3xl sm:text-4xl text-white font-light leading-snug">
                    Crafting Imagery That Refuses to Be Forgotten.
                </h2>

                <p class="text-base text-[#9e9b93] font-light leading-relaxed">
                    Founded in Lagos, BECCA PHOTOGRAPHY was born from a desire to strip away superficial trends and return to what makes portraiture truly immortal: honest presence, mastery of ambient and studio light, and deep collaboration between artist and subject.
                </p>

                <p class="text-base text-[#9e9b93] font-light leading-relaxed">
                    Over years of shooting editorial campaigns, streetwear lookbooks for pioneer labels such as SAVAGE XO, and private portrait series, our studio has defined a visual signature characterized by rich natural tones, architectural framing, and genuine confidence.
                </p>

                <p class="text-base text-[#9e9b93] font-light leading-relaxed">
                    Whether we are working inside our dedicated natural light and strobe studio in Victoria Island or on-location across brutalist urban architecture, every photograph is composed with editorial intentionality.
                </p>

                <div class="pt-4 grid grid-cols-2 sm:grid-cols-3 gap-6 border-t border-white/10">
                    <div>
                        <div class="font-serif-luxury text-3xl text-white">08+</div>
                        <div class="text-[10px] tracking-widest uppercase text-[#807e78] mt-1">Disciplines Offered</div>
                    </div>
                    <div>
                        <div class="font-serif-luxury text-3xl text-white">100%</div>
                        <div class="text-[10px] tracking-widest uppercase text-[#807e78] mt-1">Authentic Retouching</div>
                    </div>
                    <div>
                        <div class="font-serif-luxury text-3xl text-white">Sony Alpha</div>
                        <div class="text-[10px] tracking-widest uppercase text-[#807e78] mt-1">G-Master Precision</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Photography Philosophy Section -->
<section class="py-20 bg-[#0a0b0d] border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
            <div class="text-xs uppercase tracking-[0.3em] text-[#c5a880]">Core Pillars</div>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl text-white font-light">
                Our Artistic Philosophy
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-8 bg-[#141519] border border-white/5 space-y-4">
                <span class="font-serif-luxury text-3xl text-[#c5a880]">01</span>
                <h3 class="font-serif-luxury text-2xl text-white">Authentic Human Presence</h3>
                <p class="text-sm text-[#9e9b93] font-light leading-relaxed">
                    We never force rigid, lifeless poses. We converse, guide, and allow real personality, warmth, and quiet strength to emerge organically in front of the lens.
                </p>
            </div>

            <div class="p-8 bg-[#141519] border border-white/5 space-y-4">
                <span class="font-serif-luxury text-3xl text-[#c5a880]">02</span>
                <h3 class="font-serif-luxury text-2xl text-white">Mastery of Tone & Texture</h3>
                <p class="text-sm text-[#9e9b93] font-light leading-relaxed">
                    From the tactile knit of a streetwear hoodie to the subtle gradation of natural skin tones, we celebrate real texture rather than plastic, artificial smoothing.
                </p>
            </div>

            <div class="p-8 bg-[#141519] border border-white/5 space-y-4">
                <span class="font-serif-luxury text-3xl text-[#c5a880]">03</span>
                <h3 class="font-serif-luxury text-2xl text-white">Enduring Editorial Pacing</h3>
                <p class="text-sm text-[#9e9b93] font-light leading-relaxed">
                    A great photograph does not date itself in five years. We craft compositions that feel as fresh and compelling in three decades as they do today.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Photographer & Studio Pairing Section -->
<section class="py-20 bg-[#0f1013] border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            <!-- Narrative -->
            <div class="lg:col-span-6 space-y-6 order-2 lg:order-1">
                <div class="text-xs uppercase tracking-[0.25em] text-[#c5a880]">Behind the Camera</div>
                <h2 class="font-serif-luxury text-3xl sm:text-4xl text-white font-light">
                    Meet Becca
                </h2>
                <div class="text-sm text-[#c5a880] tracking-wider uppercase font-medium -mt-2">
                    Lead Visual Director & Founder
                </div>

                <p class="text-base text-[#9e9b93] font-light leading-relaxed">
                    "I see photography as an act of attentive listening. Before I press the shutter, I observe how light falls across someone's shoulders, how their laughter shifts their posture, or how a garment moves in the open breeze."
                </p>

                <p class="text-base text-[#9e9b93] font-light leading-relaxed">
                    "When clients step into our studio or meet us on location, my first priority is to create an environment where they feel completely comfortable and celebrated. That psychological ease is where real artistic magic begins."
                </p>

                <div class="pt-4 flex items-center space-x-6">
                    <a href="{{ route('booking.create') }}"
                       class="px-8 py-3.5 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-[0.2em] font-medium hover:bg-[#d8be97] transition-colors">
                        Book a Consultation
                    </a>
                    <a href="mailto:SAVAGEXO@GMAIL.COM"
                       class="text-xs uppercase tracking-wider text-[#9e9b93] hover:text-white transition-colors">
                        SAVAGEXO@GMAIL.COM
                    </a>
                </div>
            </div>

            <!-- Visual Gallery Diptych -->
            <div class="lg:col-span-6 grid grid-cols-2 gap-4 order-1 lg:order-2">
                <img src="{{ asset('storage/photos/photo-07-avenue-portrait.jpg') }}"
                     alt="Streetlight Natural Daylight Portrait by Becca"
                     class="w-full h-auto object-cover shadow-xl"
                     loading="lazy">
                <img src="{{ asset('storage/photos/photo-08-framed-perspective.jpg') }}"
                     alt="Artistic Framing by Becca"
                     class="w-full h-auto object-cover shadow-xl"
                     loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- Studio Specialties Grid -->
<section class="py-20 bg-[#0a0b0d] border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="text-center max-w-xl mx-auto mb-16 space-y-3">
            <div class="text-xs uppercase tracking-[0.3em] text-[#c5a880]">Our Disciplines</div>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl text-white font-light">
                What We Specialize In
            </h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="p-6 bg-[#141519] border border-white/5 space-y-2">
                <h4 class="font-serif-luxury text-xl text-white">Fashion Lookbooks</h4>
                <p class="text-xs text-[#807e78]">Campaigns, streetwear, seasonal collections</p>
            </div>
            <div class="p-6 bg-[#141519] border border-white/5 space-y-2">
                <h4 class="font-serif-luxury text-xl text-white">Editorial Portraits</h4>
                <p class="text-xs text-[#807e78]">Creatives, executives, personal brand</p>
            </div>
            <div class="p-6 bg-[#141519] border border-white/5 space-y-2">
                <h4 class="font-serif-luxury text-xl text-white">Studio Sessions</h4>
                <p class="text-xs text-[#807e78]">Controlled lighting, colored sweeps, minimalist</p>
            </div>
            <div class="p-6 bg-[#141519] border border-white/5 space-y-2">
                <h4 class="font-serif-luxury text-xl text-white">Architectural Urban</h4>
                <p class="text-xs text-[#807e78]">Cityscapes, brutalist structures, natural light</p>
            </div>
            <div class="p-6 bg-[#141519] border border-white/5 space-y-2">
                <h4 class="font-serif-luxury text-xl text-white">Wedding Stories</h4>
                <p class="text-xs text-[#807e78]">Intimate elopements and grand celebrations</p>
            </div>
            <div class="p-6 bg-[#141519] border border-white/5 space-y-2">
                <h4 class="font-serif-luxury text-xl text-white">Birthday Milestones</h4>
                <p class="text-xs text-[#807e78]">Bespoke high-fashion birthday sessions</p>
            </div>
            <div class="p-6 bg-[#141519] border border-white/5 space-y-2">
                <h4 class="font-serif-luxury text-xl text-white">Event Coverage</h4>
                <p class="text-xs text-[#807e78]">Galas, openings, brand launches</p>
            </div>
            <div class="p-6 bg-[#141519] border border-white/5 space-y-2">
                <h4 class="font-serif-luxury text-xl text-white">Commercial Licensing</h4>
                <p class="text-xs text-[#807e78]">Advertising, print, and digital publication</p>
            </div>
        </div>
    </div>
</section>

@endsection
