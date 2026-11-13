@extends('layouts.app')

@section('title', 'Contact Studio & Direct Inquiries | BECCA PHOTOGRAPHY')
@section('meta_description', 'Connect directly with BECCA PHOTOGRAPHY. Email SAVAGEXO@GMAIL.COM, phone +234 812 345 6789, or visit our studio in Victoria Island, Lagos.')

@section('content')

<!-- Header Banner -->
<section class="pt-20 pb-16 bg-[#0a0b0d] border-b border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 text-center space-y-4">
        <div class="inline-flex items-center space-x-3 text-xs tracking-[0.3em] uppercase text-[#c5a880]">
            <span class="w-8 h-[1px] bg-[#c5a880]"></span>
            <span>Get In Touch</span>
            <span class="w-8 h-[1px] bg-[#c5a880]"></span>
        </div>

        <h1 class="font-serif-luxury text-4xl sm:text-5xl lg:text-6xl text-white font-light">
            Contact the Atelier
        </h1>

        <p class="text-base text-[#9e9b93] font-light max-w-xl mx-auto leading-relaxed">
            We welcome inquiries for fashion campaigns, editorial commissions, fine art portraiture, and worldwide travel assignments.
        </p>
    </div>
</section>

<!-- Main Contact Form & Details Section -->
<section class="py-20 bg-[#0f1013]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            <!-- Left Contact Information & Studio Details -->
            <div class="lg:col-span-5 space-y-8 bg-[#141519] border border-white/5 p-8 lg:p-10">
                <div class="space-y-2">
                    <span class="text-xs uppercase tracking-[0.25em] text-[#c5a880]">Direct Communications</span>
                    <h2 class="font-serif-luxury text-2xl sm:text-3xl text-white font-light">
                        Studio Coordinates
                    </h2>
                </div>

                <div class="space-y-6 text-sm">
                    <!-- Email -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 rounded bg-[#0f1013] border border-white/10 flex items-center justify-center text-[#c5a880] shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase tracking-widest text-[#807e78] block">Primary Email</span>
                            <a href="mailto:{{ $contactEmail }}" class="text-white hover:text-[#c5a880] transition-colors font-medium">
                                {{ $contactEmail }}
                            </a>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 rounded bg-[#0f1013] border border-white/10 flex items-center justify-center text-[#c5a880] shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase tracking-widest text-[#807e78] block">Telephone / WhatsApp</span>
                            <span class="text-white font-medium">{{ $contactPhone }}</span>
                        </div>
                    </div>

                    <!-- Studio Address -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 rounded bg-[#0f1013] border border-white/10 flex items-center justify-center text-[#c5a880] shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase tracking-widest text-[#807e78] block">Studio Address</span>
                            <span class="text-[#cfccc4] font-light">{{ $studioAddress }}</span>
                        </div>
                    </div>

                    <!-- Hours -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 rounded bg-[#0f1013] border border-white/10 flex items-center justify-center text-[#c5a880] shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase tracking-widest text-[#807e78] block">Studio Hours</span>
                            <span class="text-[#cfccc4] font-light">{{ $openingHours }}</span>
                        </div>
                    </div>
                </div>

                <!-- Social Media Channels -->
                <div class="pt-6 border-t border-white/10 space-y-3">
                    <span class="text-[10px] uppercase tracking-widest text-[#807e78] block">Online Portfolio & Social</span>
                    <div class="flex items-center space-x-4 text-xs uppercase tracking-wider text-[#cfccc4]">
                        <span class="text-[#c5a880]">{{ $instagram }}</span>
                        <span class="text-white/20">·</span>
                        <span class="text-[#c5a880]">{{ $twitter }}</span>
                    </div>
                </div>
            </div>

            <!-- Right Message Contact Form (Saves in Database) -->
            <div class="lg:col-span-7 bg-[#141519] border border-white/10 p-8 lg:p-12 shadow-2xl">
                <div class="mb-8 space-y-2">
                    <span class="text-xs uppercase tracking-[0.25em] text-[#c5a880]">Send a Message</span>
                    <h2 class="font-serif-luxury text-2xl sm:text-3xl text-white font-light">
                        Studio Inquiry Form
                    </h2>
                    <p class="text-xs text-[#9e9b93] font-light">
                        Fill in your project details below and we will get back to you promptly.
                    </p>
                </div>

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Your Name *</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="e.g. Tola Adeleke"
                                   required
                                   class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white placeholder-stone-600 focus:outline-none focus:border-[#c5a880]">
                        </div>

                        <div>
                            <label for="email" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Your Email *</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="e.g. client@savagexo.com"
                                   required
                                   class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white placeholder-stone-600 focus:outline-none focus:border-[#c5a880]">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="phone" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Phone Number</label>
                            <input type="text"
                                   id="phone"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="e.g. +234 812 345 6789"
                                   class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white placeholder-stone-600 focus:outline-none focus:border-[#c5a880]">
                        </div>

                        <div>
                            <label for="service_interest" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Service of Interest</label>
                            <select id="service_interest"
                                    name="service_interest"
                                    class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
                                <option value="Fashion & Editorial Lookbooks">Fashion & Editorial Lookbooks</option>
                                <option value="Portrait Sessions">Portrait Sessions</option>
                                <option value="Studio Sessions">Studio Sessions</option>
                                <option value="Outdoor & Urban Photoshoots">Outdoor & Urban Photoshoots</option>
                                <option value="Wedding Coverage">Wedding Coverage</option>
                                <option value="Birthday & Celebration Sessions">Birthday & Celebration Sessions</option>
                                <option value="Event Coverage">Event Coverage</option>
                                <option value="Commercial Licensing">Commercial Licensing</option>
                                <option value="General Inquiry">General Studio Inquiry</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="subject" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Subject</label>
                        <input type="text"
                               id="subject"
                               name="subject"
                               value="{{ old('subject') }}"
                               placeholder="e.g. Lookbook campaign consultation"
                               class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white placeholder-stone-600 focus:outline-none focus:border-[#c5a880]">
                    </div>

                    <div>
                        <label for="message" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Message / Project Brief *</label>
                        <textarea id="message"
                                  name="message"
                                  rows="5"
                                  placeholder="Describe your visual concept, desired dates, or questions..."
                                  required
                                  class="w-full bg-[#0f1013] border border-white/10 p-4 text-sm text-white placeholder-stone-600 focus:outline-none focus:border-[#c5a880]">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit"
                            class="w-full py-4 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-[0.25em] font-medium hover:bg-[#d8be97] transition-all duration-300 shadow-xl">
                        Send Studio Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
