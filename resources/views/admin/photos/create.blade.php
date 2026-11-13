@extends('layouts.admin')

@section('title', 'Upload Photograph')
@section('header_title', 'Upload New Portfolio Work')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.photos.index') }}" class="text-xs uppercase tracking-wider text-[#807e78] hover:text-white transition-colors">
        &larr; Back to Photo Archive
    </a>
</div>

<div class="max-w-4xl bg-[#141519] border border-white/5 p-8 rounded shadow-2xl">
    <form action="{{ route('admin.photos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Photo File Upload Field -->
        <div class="space-y-2">
            <label for="photo" class="block text-xs uppercase tracking-wider text-white font-medium">Photograph File *</label>
            <div class="border-2 border-dashed border-white/20 p-8 text-center bg-[#0f1013] hover:border-[#c5a880] transition-colors rounded">
                <input type="file"
                       id="photo"
                       name="photo"
                       accept="image/jpeg,image/png,image/jpg,image/webp"
                       required
                       class="w-full text-xs text-[#cfccc4] file:mr-4 file:py-2.5 file:px-4 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-[#c5a880] file:text-[#0f1013] hover:file:bg-[#d8be97] cursor-pointer">
                <p class="text-[11px] text-[#807e78] mt-2">
                    Supports high-resolution JPEG, PNG, JPG, or WebP. Aspect ratio and resolution will be automatically detected.
                </p>
            </div>
        </div>

        <!-- Title & Category -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="title" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Photograph Title *</label>
                <input type="text"
                       id="title"
                       name="title"
                       value="{{ old('title') }}"
                       placeholder="e.g. Cobalt Horizon"
                       required
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>

            <div>
                <label for="category_id" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Portfolio Category *</label>
                <select id="category_id"
                        name="category_id"
                        required
                        class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
                    <option value="">Select Category...</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Subtitle & Client -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="subtitle" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Subtitle / Series Tagline</label>
                <input type="text"
                       id="subtitle"
                       name="subtitle"
                       value="{{ old('subtitle') }}"
                       placeholder="e.g. Streetwear Lookbook Vol. 2"
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>

            <div>
                <label for="client_name" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Client / Brand Name</label>
                <input type="text"
                       id="client_name"
                       name="client_name"
                       value="{{ old('client_name', 'SAVAGE XO') }}"
                       placeholder="e.g. SAVAGE XO or Personal Commission"
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>
        </div>

        <!-- Location & Camera Gear -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="location" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Shoot Location</label>
                <input type="text"
                       id="location"
                       name="location"
                       value="{{ old('location', 'The Foundry Studio, Victoria Island') }}"
                       placeholder="e.g. The Foundry Studio / Victoria Island"
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>

            <div>
                <label for="camera_gear" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Camera Gear / Lens Info</label>
                <input type="text"
                       id="camera_gear"
                       name="camera_gear"
                       value="{{ old('camera_gear', 'Sony A7 IV · 85mm f/1.4 GM') }}"
                       placeholder="e.g. Sony A7 IV · 85mm f/1.4 GM"
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Artistic Statement / Description</label>
            <textarea id="description"
                      name="description"
                      rows="3"
                      placeholder="Share details about the lighting, color composition, mood, or context..."
                      class="w-full bg-[#0f1013] border border-white/10 p-4 text-sm text-white focus:outline-none focus:border-[#c5a880]">{{ old('description') }}</textarea>
        </div>

        <!-- Featured & Hero Switches -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-4 border-t border-white/10">
            <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox"
                       name="is_featured"
                       value="1"
                       {{ old('is_featured', 1) ? 'checked' : '' }}
                       class="text-[#c5a880] focus:ring-0 bg-[#0f1013] border-white/20">
                <span class="text-xs uppercase tracking-wider text-white">Feature on Homepage</span>
            </label>

            <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox"
                       name="is_hero"
                       value="1"
                       {{ old('is_hero') ? 'checked' : '' }}
                       class="text-[#c5a880] focus:ring-0 bg-[#0f1013] border-white/20">
                <span class="text-xs uppercase tracking-wider text-white">Set as Primary Hero</span>
            </label>

            <div>
                <label for="display_order" class="block text-[10px] uppercase tracking-wider text-[#807e78] mb-1">Display Order</label>
                <input type="number"
                       id="display_order"
                       name="display_order"
                       value="{{ old('display_order', 1) }}"
                       class="w-24 bg-[#0f1013] border border-white/10 px-3 py-1.5 text-xs text-white">
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-6 border-t border-white/10 flex items-center justify-between">
            <a href="{{ route('admin.photos.index') }}" class="text-xs uppercase tracking-wider text-[#807e78] hover:text-white">Cancel</a>
            <button type="submit"
                    class="px-8 py-3.5 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-[0.2em] font-medium hover:bg-[#d8be97] transition-colors shadow-lg">
                Publish to Portfolio
            </button>
        </div>
    </form>
</div>

@endsection
