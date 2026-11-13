@extends('layouts.admin')

@section('title', 'Booking #' . $booking->booking_reference)
@section('header_title', 'Booking Details: ' . $booking->booking_reference)

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.bookings.index') }}" class="text-xs uppercase tracking-wider text-[#807e78] hover:text-white transition-colors">
        &larr; Back to All Bookings
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    <!-- Main Booking Summary Card -->
    <div class="lg:col-span-8 bg-[#141519] border border-white/5 p-8 rounded space-y-8">
        <div class="flex items-start justify-between pb-6 border-b border-white/10">
            <div>
                <span class="text-[10px] uppercase tracking-widest text-[#807e78]">Booking Reference</span>
                <div class="font-mono text-2xl text-[#c5a880] font-semibold mt-1">
                    {{ $booking->booking_reference }}
                </div>
                <div class="text-xs text-[#807e78] mt-1">
                    Created on {{ $booking->created_at->format('M d, Y · h:i A') }}
                </div>
            </div>

            <span class="px-3 py-1.5 rounded text-xs uppercase tracking-wider font-semibold {{ $booking->status_badge }}">
                {{ ucfirst($booking->status) }}
            </span>
        </div>

        <!-- Service & Schedule Breakdown -->
        <div class="space-y-4">
            <h3 class="text-xs font-semibold uppercase tracking-wider text-white">Photoshoot Specifications</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div class="p-4 bg-[#0f1013] border border-white/5 rounded">
                    <span class="text-[#807e78] uppercase text-[10px] block">Service Package</span>
                    <span class="text-white font-medium text-sm mt-1 block">{{ $booking->service_name }}</span>
                    @if($booking->service)
                        <span class="text-[#c5a880] text-[11px]">{{ $booking->service->formatted_price }}</span>
                    @endif
                </div>

                <div class="p-4 bg-[#0f1013] border border-white/5 rounded">
                    <span class="text-[#807e78] uppercase text-[10px] block">Scheduled Date & Time</span>
                    <span class="text-white font-medium text-sm mt-1 block">{{ $booking->preferred_date->format('l, F d, Y') }}</span>
                    <span class="text-[#a09e99] text-[11px]">{{ $booking->preferred_time }}</span>
                </div>
            </div>

            <div class="p-4 bg-[#0f1013] border border-white/5 rounded text-xs space-y-1">
                <span class="text-[#807e78] uppercase text-[10px] block">Photoshoot Location</span>
                <span class="text-white font-medium">{{ $booking->photoshoot_location }}</span>
            </div>

            @if($booking->additional_requirements)
                <div class="p-4 bg-[#0f1013] border border-white/5 rounded text-xs space-y-1">
                    <span class="text-[#807e78] uppercase text-[10px] block">Client Creative Brief / Notes</span>
                    <p class="text-[#cfccc4] font-light leading-relaxed whitespace-pre-line">{{ $booking->additional_requirements }}</p>
                </div>
            @endif
        </div>

        <!-- Client Profile -->
        <div class="space-y-4 pt-4 border-t border-white/10">
            <h3 class="text-xs font-semibold uppercase tracking-wider text-white">Client Contact Information</h3>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div class="p-4 bg-[#0f1013] border border-white/5 rounded">
                    <span class="text-[#807e78] uppercase text-[10px] block">Full Name</span>
                    <span class="text-white font-medium mt-1 block">{{ $booking->client_name }}</span>
                </div>

                <div class="p-4 bg-[#0f1013] border border-white/5 rounded">
                    <span class="text-[#807e78] uppercase text-[10px] block">Email</span>
                    <a href="mailto:{{ $booking->client_email }}" class="text-[#c5a880] hover:underline mt-1 block font-medium">
                        {{ $booking->client_email }}
                    </a>
                </div>

                <div class="p-4 bg-[#0f1013] border border-white/5 rounded">
                    <span class="text-[#807e78] uppercase text-[10px] block">Telephone</span>
                    <a href="tel:{{ $booking->client_phone }}" class="text-white hover:underline mt-1 block font-medium">
                        {{ $booking->client_phone }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Status Controls & Internal Notes -->
    <div class="lg:col-span-4 bg-[#141519] border border-white/5 p-8 rounded space-y-6">
        <h3 class="text-xs font-semibold uppercase tracking-wider text-white">Update Booking Status</h3>

        <form action="{{ route('admin.bookings.status', $booking->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label for="status" class="block text-xs uppercase tracking-wider text-[#807e78] mb-2">Change Status</label>
                <select id="status"
                        name="status"
                        class="w-full bg-[#0f1013] border border-white/10 p-3 text-xs text-white focus:outline-none focus:border-[#c5a880]">
                    <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending Approval</option>
                    <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed Reservation</option>
                    <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed Shoot</option>
                    <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div>
                <label for="admin_notes" class="block text-xs uppercase tracking-wider text-[#807e78] mb-2">Studio Internal Notes</label>
                <textarea id="admin_notes"
                          name="admin_notes"
                          rows="4"
                          placeholder="e.g. Confirmed with client by phone. Studio Bay 2 assigned..."
                          class="w-full bg-[#0f1013] border border-white/10 p-3 text-xs text-white focus:outline-none focus:border-[#c5a880]">{{ old('admin_notes', $booking->admin_notes) }}</textarea>
                <p class="text-[10px] text-[#807e78] mt-1">These notes appear on the client tracker and your internal archive.</p>
            </div>

            <button type="submit"
                    class="w-full py-3 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-wider font-medium hover:bg-[#d8be97] transition-colors">
                Save Status & Notes
            </button>
        </form>

        <div class="pt-4 border-t border-white/10 space-y-3">
            <a href="mailto:{{ $booking->client_email }}?subject=BECCA%20PHOTOGRAPHY%20Booking%20Confirmation%20%23{{ $booking->booking_reference }}"
               class="block text-center w-full py-2.5 bg-white/10 hover:bg-white/20 text-white text-xs uppercase tracking-wider transition-colors">
                Email Client Directly
            </a>

            <form action="{{ route('admin.bookings.destroy', $booking->id) }}"
                  method="POST"
                  onsubmit="return confirm('Permanently remove this booking record?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full py-2.5 text-rose-400 hover:text-rose-300 text-xs uppercase tracking-wider transition-colors">
                    Delete Booking Record
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
