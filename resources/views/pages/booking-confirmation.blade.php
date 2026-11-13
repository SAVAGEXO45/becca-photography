@extends('layouts.app')

@section('title', 'Booking Reserved: ' . $booking->booking_reference . ' | BECCA PHOTOGRAPHY')

@section('content')

<section class="py-20 lg:py-28 bg-[#0a0b0d]">
    <div class="max-w-3xl mx-auto px-6">
        <!-- Receipt Card Container -->
        <div class="bg-[#141519] border border-[#c5a880]/30 p-8 sm:p-12 shadow-2xl relative">
            <!-- Top Confirmation Badge -->
            <div class="text-center space-y-4 pb-8 border-b border-white/10">
                <div class="w-16 h-16 mx-auto rounded-full bg-[#c5a880]/10 border border-[#c5a880]/30 flex items-center justify-center text-[#c5a880]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <div class="text-xs uppercase tracking-[0.3em] text-[#c5a880]">Session Reserved</div>
                <h1 class="font-serif-luxury text-3xl sm:text-4xl text-white font-light">
                    Booking Request Received
                </h1>
                <p class="text-sm text-[#9e9b93] font-light max-w-md mx-auto">
                    Thank you, <strong class="text-white font-medium">{{ $booking->client_name }}</strong>. Your session request has been entered into our studio system.
                </p>

                <!-- Unique Booking Reference -->
                <div class="pt-4">
                    <span class="text-[10px] uppercase tracking-widest text-[#807e78] block">Your Unique Booking Reference</span>
                    <div class="inline-block px-6 py-2.5 bg-[#0f1013] border border-[#c5a880]/40 font-mono text-xl sm:text-2xl text-[#c5a880] tracking-widest mt-2 select-all font-semibold">
                        {{ $booking->booking_reference }}
                    </div>
                </div>
            </div>

            <!-- Booking Breakdown -->
            <div class="py-8 space-y-4 border-b border-white/10 text-xs">
                <div class="flex items-center justify-between">
                    <span class="text-[#807e78] uppercase tracking-wider">Current Status</span>
                    <span class="px-3 py-1 rounded text-[11px] uppercase tracking-wider font-semibold {{ $booking->status_badge }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-[#807e78] uppercase tracking-wider">Service Selected</span>
                    <span class="text-white font-medium">{{ $booking->service_name }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-[#807e78] uppercase tracking-wider">Preferred Date</span>
                    <span class="text-white font-medium">{{ $booking->preferred_date->format('F d, Y') }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-[#807e78] uppercase tracking-wider">Time Slot</span>
                    <span class="text-white font-medium">{{ $booking->preferred_time }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-[#807e78] uppercase tracking-wider">Location</span>
                    <span class="text-white font-medium">{{ $booking->photoshoot_location }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-[#807e78] uppercase tracking-wider">Client Email</span>
                    <span class="text-white font-medium">{{ $booking->client_email }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-[#807e78] uppercase tracking-wider">Phone / WhatsApp</span>
                    <span class="text-white font-medium">{{ $booking->client_phone }}</span>
                </div>

                @if($booking->additional_requirements)
                    <div class="pt-3 border-t border-white/5">
                        <span class="text-[#807e78] uppercase tracking-wider block mb-1">Additional Requirements:</span>
                        <p class="text-white/80 italic font-light">{{ $booking->additional_requirements }}</p>
                    </div>
                @endif
            </div>

            <!-- Next Steps -->
            <div class="pt-8 space-y-6 text-center">
                <p class="text-xs text-[#9e9b93] font-light leading-relaxed max-w-lg mx-auto">
                    We will review availability and confirm your booking reservation via email and phone. You can track this booking status at any time using your reference code.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center space-y-3 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('booking.track', ['reference' => $booking->booking_reference]) }}"
                       class="px-8 py-3 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-wider font-medium hover:bg-[#d8be97] transition-colors">
                        Track Booking Status
                    </a>
                    <a href="{{ route('home') }}"
                       class="px-8 py-3 border border-white/20 text-white text-xs uppercase tracking-wider font-medium hover:bg-white/5 transition-colors">
                        Return to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
