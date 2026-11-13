@extends('layouts.app')

@section('title', 'Book a Photography Session | BECCA PHOTOGRAPHY')
@section('meta_description', 'Schedule your photography session with BECCA PHOTOGRAPHY. Select your service, date, time, and custom photoshoot requirements.')

@section('content')

<!-- Header Banner -->
<section class="pt-20 pb-16 bg-[#0a0b0d] border-b border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 text-center space-y-4">
        <div class="inline-flex items-center space-x-3 text-xs tracking-[0.3em] uppercase text-[#c5a880]">
            <span class="w-8 h-[1px] bg-[#c5a880]"></span>
            <span>Reserve Your Date</span>
            <span class="w-8 h-[1px] bg-[#c5a880]"></span>
        </div>

        <h1 class="font-serif-luxury text-4xl sm:text-5xl lg:text-6xl text-white font-light">
            Book a Session
        </h1>

        <p class="text-base text-[#9e9b93] font-light max-w-xl mx-auto leading-relaxed">
            Please provide your session preferences below. We will review your date and confirm your booking reservation promptly.
        </p>
    </div>
</section>

<!-- Booking Form Section -->
<section class="py-20 bg-[#0f1013]" x-data="{
    selectedService: '{{ $selectedService ? $selectedService->id : ($services->first()->id ?? '') }}'
}">
    <div class="max-w-4xl mx-auto px-6 lg:px-12">
        <form action="{{ route('booking.store') }}" method="POST" class="bg-[#141519] border border-white/10 p-8 sm:p-12 space-y-10 shadow-2xl">
            @csrf

            <!-- Section 1: Choose Service Package -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3 border-b border-white/10 pb-3">
                    <span class="font-serif-luxury text-xl text-[#c5a880]">01</span>
                    <h3 class="text-xs font-semibold uppercase tracking-[0.25em] text-white">Select Photography Service</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    @foreach($services as $svc)
                        <label class="cursor-pointer block border p-4 transition-all"
                               :class="selectedService == '{{ $svc->id }}' ? 'border-[#c5a880] bg-[#c5a880]/10' : 'border-white/10 bg-[#0f1013] hover:border-white/30'">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center space-x-3">
                                    <input type="radio"
                                           name="service_id"
                                           value="{{ $svc->id }}"
                                           x-model="selectedService"
                                           class="text-[#c5a880] focus:ring-[#c5a880] bg-[#141519] border-white/20">
                                    <div>
                                        <div class="text-sm font-medium text-white">{{ $svc->name }}</div>
                                        <div class="text-[11px] text-[#807e78]">{{ $svc->duration ?? 'Standard Session' }}</div>
                                    </div>
                                </div>
                                <div class="text-xs font-serif-luxury text-[#c5a880]">
                                    {{ $svc->formatted_price }}
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Section 2: Date & Time Schedule -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3 border-b border-white/10 pb-3">
                    <span class="font-serif-luxury text-xl text-[#c5a880]">02</span>
                    <h3 class="text-xs font-semibold uppercase tracking-[0.25em] text-white">Preferred Date & Time</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2">
                    <div>
                        <label for="preferred_date" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Preferred Date *</label>
                        <input type="date"
                               id="preferred_date"
                               name="preferred_date"
                               min="{{ date('Y-m-d') }}"
                               value="{{ old('preferred_date', date('Y-m-d', strtotime('+3 days'))) }}"
                               required
                               class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
                    </div>

                    <div>
                        <label for="preferred_time" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Preferred Time Slot *</label>
                        <select id="preferred_time"
                                name="preferred_time"
                                required
                                class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
                            <option value="09:00 AM - Morning Light">09:00 AM – Morning Ambient Light</option>
                            <option value="11:30 AM - Midday Studio">11:30 AM – Studio Session Slot</option>
                            <option value="02:30 PM - Afternoon Slot">02:30 PM – Afternoon Session</option>
                            <option value="04:30 PM - Golden Hour">04:30 PM – Golden Hour (Outdoor Ideal)</option>
                            <option value="Flexible / Custom Time">Flexible / Discuss with Artist</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Section 3: Contact & Location Information -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3 border-b border-white/10 pb-3">
                    <span class="font-serif-luxury text-xl text-[#c5a880]">03</span>
                    <h3 class="text-xs font-semibold uppercase tracking-[0.25em] text-white">Client Details & Shoot Location</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2">
                    <div>
                        <label for="client_name" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Full Name *</label>
                        <input type="text"
                               id="client_name"
                               name="client_name"
                               placeholder="e.g. Adeola Adeleke"
                               value="{{ old('client_name') }}"
                               required
                               class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white placeholder-[#555] focus:outline-none focus:border-[#c5a880]">
                    </div>

                    <div>
                        <label for="client_email" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Email Address *</label>
                        <input type="email"
                               id="client_email"
                               name="client_email"
                               placeholder="e.g. client@example.com"
                               value="{{ old('client_email') }}"
                               required
                               class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white placeholder-[#555] focus:outline-none focus:border-[#c5a880]">
                    </div>

                    <div>
                        <label for="client_phone" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Phone / WhatsApp Number *</label>
                        <input type="text"
                               id="client_phone"
                               name="client_phone"
                               placeholder="e.g. +234 812 345 6789"
                               value="{{ old('client_phone') }}"
                               required
                               class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white placeholder-[#555] focus:outline-none focus:border-[#c5a880]">
                    </div>

                    <div>
                        <label for="photoshoot_location" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Photoshoot Location *</label>
                        <input type="text"
                               id="photoshoot_location"
                               name="photoshoot_location"
                               placeholder="e.g. Becca Studio (VI), Outdoor Island, or Client Venue"
                               value="{{ old('photoshoot_location', 'Becca Photography Studio, Victoria Island') }}"
                               required
                               class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white placeholder-[#555] focus:outline-none focus:border-[#c5a880]">
                    </div>
                </div>
            </div>

            <!-- Section 4: Creative Brief & Additional Notes -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3 border-b border-white/10 pb-3">
                    <span class="font-serif-luxury text-xl text-[#c5a880]">04</span>
                    <h3 class="text-xs font-semibold uppercase tracking-[0.25em] text-white">Creative Concept & Special Requirements</h3>
                </div>

                <div>
                    <label for="additional_requirements" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Additional Notes / Moodboard Links / Specific Requests</label>
                    <textarea id="additional_requirements"
                              name="additional_requirements"
                              rows="4"
                              placeholder="Tell us about your brand vision, outfit count, desired backdrops, references, or specific timing requirements..."
                              class="w-full bg-[#0f1013] border border-white/10 p-4 text-sm text-white placeholder-[#555] focus:outline-none focus:border-[#c5a880]">{{ old('additional_requirements') }}</textarea>
                </div>
            </div>

            <!-- Submit Button & Disclaimer -->
            <div class="pt-6 border-t border-white/10 space-y-4">
                <button type="submit"
                        class="w-full py-4 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-[0.25em] font-medium hover:bg-[#d8be97] transition-all duration-300 shadow-xl">
                    Submit Booking Request
                </button>

                <p class="text-center text-[11px] text-[#807e78]">
                    Submitting this form reserves your inquiry slot. A unique booking reference will be generated, and our studio director will confirm your schedule within 24 hours.
                </p>
            </div>
        </form>
    </div>
</section>

@endsection
