@extends('layouts.app')

@section('title', 'Track Booking Status | BECCA PHOTOGRAPHY')

@section('content')

<section class="py-20 lg:py-28 bg-[#0a0b0d]">
    <div class="max-w-2xl mx-auto px-6">
        <div class="text-center space-y-4 mb-12">
            <div class="inline-flex items-center space-x-3 text-xs tracking-[0.3em] uppercase text-[#c5a880]">
                <span class="w-8 h-[1px] bg-[#c5a880]"></span>
                <span>Client Portal</span>
                <span class="w-8 h-[1px] bg-[#c5a880]"></span>
            </div>

            <h1 class="font-serif-luxury text-3xl sm:text-4xl text-white font-light">
                Track Booking Status
            </h1>

            <p class="text-sm text-[#9e9b93] font-light">
                Enter your unique booking reference (e.g. <span class="font-mono text-[#c5a880]">BP-2026-X892</span>) to view current scheduling and confirmation progress.
            </p>
        </div>

        <!-- Reference Search Box -->
        <form action="{{ route('booking.track') }}" method="GET" class="bg-[#141519] border border-white/10 p-6 flex flex-col sm:flex-row gap-3">
            <input type="text"
                   name="reference"
                   value="{{ $reference }}"
                   placeholder="Enter reference code (e.g. BP-2026-...)"
                   required
                   class="flex-1 bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white uppercase placeholder-stone-600 focus:outline-none focus:border-[#c5a880] font-mono tracking-wider">
            <button type="submit"
                    class="px-8 py-3 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-widest font-medium hover:bg-[#d8be97] transition-colors">
                Lookup
            </button>
        </form>

        <!-- Error Notification -->
        @if($error)
            <div class="mt-8 p-4 bg-rose-950/40 border border-rose-500/30 text-rose-300 text-xs text-center">
                {{ $error }}
            </div>
        @endif

        <!-- Booking Result Card -->
        @if($booking)
            <div class="mt-8 bg-[#141519] border border-[#c5a880]/30 p-8 space-y-6 shadow-2xl">
                <div class="flex items-center justify-between pb-6 border-b border-white/10">
                    <div>
                        <span class="text-[10px] uppercase tracking-widest text-[#807e78]">Booking Reference</span>
                        <div class="font-mono text-xl text-[#c5a880] font-semibold mt-0.5">
                            {{ $booking->booking_reference }}
                        </div>
                    </div>
                    <span class="px-3 py-1 rounded text-xs uppercase tracking-wider font-semibold {{ $booking->status_badge }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>

                <div class="space-y-3 text-xs">
                    <div class="flex justify-between">
                        <span class="text-[#807e78] uppercase">Client Name</span>
                        <span class="text-white font-medium">{{ $booking->client_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#807e78] uppercase">Service</span>
                        <span class="text-white font-medium">{{ $booking->service_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#807e78] uppercase">Scheduled Date</span>
                        <span class="text-white font-medium">{{ $booking->preferred_date->format('F d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#807e78] uppercase">Time Slot</span>
                        <span class="text-white font-medium">{{ $booking->preferred_time }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#807e78] uppercase">Photoshoot Location</span>
                        <span class="text-white font-medium">{{ $booking->photoshoot_location }}</span>
                    </div>
                </div>

                @if($booking->admin_notes)
                    <div class="p-4 bg-[#0f1013] border border-white/5 space-y-1">
                        <span class="text-[10px] uppercase tracking-wider text-[#c5a880] block">Studio Notes to Client</span>
                        <p class="text-xs text-[#cfccc4] font-light">{{ $booking->admin_notes }}</p>
                    </div>
                @endif

                <div class="pt-4 border-t border-white/10 text-center text-xs text-[#807e78]">
                    Need to reschedule or update requirements? <a href="mailto:SAVAGEXO@GMAIL.COM" class="text-[#c5a880] hover:underline">Contact studio direct</a>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection
