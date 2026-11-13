@extends('layouts.admin')

@section('title', 'Create Service Package')
@section('header_title', 'Create Photography Package')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.services.index') }}" class="text-xs uppercase tracking-wider text-[#807e78] hover:text-white transition-colors">
        &larr; Back to Services
    </a>
</div>

<div class="max-w-3xl bg-[#141519] border border-white/5 p-8 rounded shadow-2xl">
    <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Package Name *</label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="e.g. Fashion Lookbooks"
                       required
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>

            <div>
                <label for="tagline" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Short Subtitle / Tagline</label>
                <input type="text"
                       id="tagline"
                       name="tagline"
                       value="{{ old('tagline') }}"
                       placeholder="e.g. Editorial campaigns & collections"
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>
        </div>

        <div>
            <label for="description" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Detailed Description *</label>
            <textarea id="description"
                      name="description"
                      rows="4"
                      required
                      placeholder="Describe what makes this session special, target audience, and mood..."
                      class="w-full bg-[#0f1013] border border-white/10 p-4 text-sm text-white focus:outline-none focus:border-[#c5a880]">{{ old('description') }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="starting_price" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Starting Price (₦) *</label>
                <input type="number"
                       id="starting_price"
                       name="starting_price"
                       value="{{ old('starting_price', 150000) }}"
                       step="1000"
                       required
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>

            <div>
                <label for="price_label" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Price Label</label>
                <input type="text"
                       id="price_label"
                       name="price_label"
                       value="{{ old('price_label', 'Starting at') }}"
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div>
                <label for="duration" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Duration</label>
                <input type="text"
                       id="duration"
                       name="duration"
                       value="{{ old('duration', '2 Hours') }}"
                       placeholder="e.g. 2 Hours"
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>

            <div>
                <label for="deliverables" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Deliverables</label>
                <input type="text"
                       id="deliverables"
                       name="deliverables"
                       value="{{ old('deliverables', '20 Master Retouches') }}"
                       placeholder="e.g. 20 Master Retouches"
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>

            <div>
                <label for="turnaround_time" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Turnaround Time</label>
                <input type="text"
                       id="turnaround_time"
                       name="turnaround_time"
                       value="{{ old('turnaround_time', '3 to 5 Days') }}"
                       placeholder="e.g. 3 to 5 Days"
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>
        </div>

        <div>
            <label for="features_text" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">
                Included Features (One feature per line)
            </label>
            <textarea id="features_text"
                      name="features_text"
                      rows="4"
                      placeholder="Studio or curated outdoor location&#10;Up to 3 wardrobe changes&#10;Private proofing contact sheet&#10;High-end skin retouching"
                      class="w-full bg-[#0f1013] border border-white/10 p-4 text-sm text-white focus:outline-none focus:border-[#c5a880]">{{ old('features_text') }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-4 border-t border-white/10">
            <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox"
                       name="is_popular"
                       value="1"
                       {{ old('is_popular') ? 'checked' : '' }}
                       class="text-[#c5a880] focus:ring-0 bg-[#0f1013] border-white/20">
                <span class="text-xs uppercase tracking-wider text-white">Highlight as Popular</span>
            </label>

            <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox"
                       name="is_active"
                       value="1"
                       {{ old('is_active', 1) ? 'checked' : '' }}
                       class="text-[#c5a880] focus:ring-0 bg-[#0f1013] border-white/20">
                <span class="text-xs uppercase tracking-wider text-white">Active for Booking</span>
            </label>

            <div>
                <label for="order" class="block text-[10px] uppercase tracking-wider text-[#807e78] mb-1">Display Order</label>
                <input type="number"
                       id="order"
                       name="order"
                       value="{{ old('order', 1) }}"
                       class="w-24 bg-[#0f1013] border border-white/10 px-3 py-1.5 text-xs text-white">
            </div>
        </div>

        <div class="pt-6 border-t border-white/10 flex items-center justify-between">
            <a href="{{ route('admin.services.index') }}" class="text-xs uppercase tracking-wider text-[#807e78] hover:text-white">Cancel</a>
            <button type="submit"
                    class="px-8 py-3.5 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-[0.2em] font-medium hover:bg-[#d8be97] transition-colors shadow-lg">
                Create Package
            </button>
        </div>
    </form>
</div>

@endsection
