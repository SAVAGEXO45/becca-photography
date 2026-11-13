@extends('layouts.app')

@section('title', $service->name . ' | BECCA PHOTOGRAPHY')
@section('meta_description', $service->description)

@section('content')

<!-- Back Bar -->
<div class="bg-[#0b0c0e] border-b border-white/5 py-4 px-6 lg:px-12">
    <div class="max-w-7xl mx-auto flex items-center justify-between text-xs uppercase tracking-widest text-[#807e78]">
        <a href="{{ route('services.index') }}" class="hover:text-white transition-colors flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span>All Services & Packages</span>
        </a>
        <a href="{{ route('booking.create', ['service' => $service->id]) }}" class="text-[#c5a880] hover:underline">
            Book This Package &rarr;
        </a>
    </div>
</div>

<!-- Service Spotlight Section -->
<section class="py-16 lg:py-24 bg-[#0f1013]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            <div class="lg:col-span-7 space-y-8">
                <div>
                    <div class="text-xs uppercase tracking-[0.3em] text-[#c5a880] mb-2">Package Spotlight</div>
                    <h1 class="font-serif-luxury text-4xl sm:text-5xl text-white font-light">
                        {{ $service->name }}
                    </h1>
                    @if($service->tagline)
                        <p class="text-sm text-[#cfccc4] mt-2 font-light italic">{{ $service->tagline }}</p>
                    @endif
                </div>

                <div class="prose prose-invert max-w-none text-sm text-[#9e9b93] font-light leading-relaxed border-t border-b border-white/10 py-6">
                    <p>{{ $service->description }}</p>
                </div>

                <!-- Features & Inclusions -->
                @if(!empty($service->features))
                    <div class="space-y-4">
                        <h3 class="text-xs font-semibold uppercase tracking-[0.25em] text-white">
                            What Your Session Includes
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($service->features as $feature)
                                <div class="flex items-start text-xs text-[#cfccc4] p-3 bg-[#141519] border border-white/5">
                                    <svg class="w-4 h-4 text-[#c5a880] shrink-0 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>{{ $feature }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Booking Summary Card -->
            <div class="lg:col-span-5 bg-[#141519] border border-white/10 p-8 space-y-6 sticky top-28">
                <div>
                    <span class="text-[10px] uppercase tracking-widest text-[#807e78]">{{ $service->price_label }}</span>
                    <div class="font-serif-luxury text-4xl text-white mt-1">
                        {{ $service->formatted_price }}
                    </div>
                </div>

                <div class="space-y-3 py-6 border-t border-b border-white/10 text-xs">
                    <div class="flex items-center justify-between">
                        <span class="text-[#807e78] uppercase">Session Length</span>
                        <span class="text-white">{{ $service->duration ?? '2 Hours' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-[#807e78] uppercase">Final Deliverables</span>
                        <span class="text-white">{{ $service->deliverables ?? 'High-Resolution Retouched' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-[#807e78] uppercase">Turnaround Time</span>
                        <span class="text-white">{{ $service->turnaround_time ?? '3-5 Business Days' }}</span>
                    </div>
                </div>

                <a href="{{ route('booking.create', ['service' => $service->id]) }}"
                   class="block text-center w-full py-4 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-[0.2em] font-medium hover:bg-[#d8be97] transition-colors shadow-lg">
                    Reserve This Date
                </a>

                <div class="text-[11px] text-[#807e78] text-center">
                    Questions before booking? <a href="{{ route('contact') }}" class="text-[#c5a880] hover:underline">Contact studio direct</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
