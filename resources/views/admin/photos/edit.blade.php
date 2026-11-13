@extends('layouts.admin')

@section('title', 'Edit Photograph: ' . $photo->title)
@section('header_title', 'Edit Photograph Metadata')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.photos.index') }}" class="text-xs uppercase tracking-wider text-[#807e78] hover:text-white transition-colors">
        &larr; Back to Photo Archive
    </a>
</div>

<div class="max-w-4xl bg-[#141519] border border-white/5 p-8 rounded shadow-2xl">
    <form action="{{ route('admin.photos.update', $photo->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- Current Image Preview -->
        <div class="flex items-start space-x-6 pb-6 border-b border-white/10">
            <div class="w-32 bg-black border border-white/10 rounded overflow-hidden shrink-0">
                <img src="{{ $photo->url }}" alt="{{ $photo->title }}" class="w-full h-auto object-cover">
            </div>
            <div class="space-y-2">
                <h3 class="font-serif-luxury text-xl text-white">{{ $photo->title }}</h3>
                <div class="text-xs text-[#807e78]">
                    <span>Resolution: {{ $photo->dimensions ?? 'Original' }}</span> ·
                    <span>Format: {{ ucfirst($photo->aspect_ratio) }}</span>
                </div>
                <div>
                    <label for="photo" class="text-xs text-[#c5a880] uppercase tracking-wider block mt-2">Replace Image File (Optional):</label>
                    <input type="file" id="photo" name="photo" accept="image/*" class="text-xs text-[#807e78] mt-1 file:py-1 file:px-3 file:bg-white/10 file:text-white file:border-0 file:rounded file:text-xs">
                </div>
            </div>
        </div>

        <!-- Title & Category -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="title" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Photograph Title *</label>
                <input type="text"
                       id="title"
                       name="title"
                       value="{{ old('title', $photo->title) }}"
                       required
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>

            <div>
                <label for="category_id" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Portfolio Category *</label>
                <select id="category_id"
                        name="category_id"
                        required
                        class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $photo->category_id) == $cat->id ? 'selected' : '' }}>
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
                       value="{{ old('subtitle', $photo->subtitle) }}"
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>

            <div>
                <label for="client_name" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Client / Brand Name</label>
                <input type="text"
                       id="client_name"
                       name="client_name"
                       value="{{ old('client_name', $photo->client_name) }}"
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
                       value="{{ old('location', $photo->location) }}"
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>

            <div>
                <label for="camera_gear" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Camera Gear / Lens Info</label>
                <input type="text"
                       id="camera_gear"
                       name="camera_gear"
                       value="{{ old('camera_gear', $photo->camera_gear) }}"
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Artistic Statement / Description</label>
            <textarea id="description"
                      name="description"
                      rows="3"
                      class="w-full bg-[#0f1013] border border-white/10 p-4 text-sm text-white focus:outline-none focus:border-[#c5a880]">{{ old('description', $photo->description) }}</textarea>
        </div>

        <!-- Featured & Hero Switches -->
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 pt-4 border-t border-white/10">
            <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox"
                       name="is_featured"
                       value="1"
                       {{ old('is_featured', $photo->is_featured) ? 'checked' : '' }}
                       class="text-[#c5a880] focus:ring-0 bg-[#0f1013] border-white/20">
                <span class="text-xs uppercase tracking-wider text-white">Homepage Feature</span>
            </label>

            <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox"
                       name="is_hero"
                       value="1"
                       {{ old('is_hero', $photo->is_hero) ? 'checked' : '' }}
                       class="text-[#c5a880] focus:ring-0 bg-[#0f1013] border-white/20">
                <span class="text-xs uppercase tracking-wider text-white">Primary Hero</span>
            </label>

            <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox"
                       name="is_published"
                       value="1"
                       {{ old('is_published', $photo->is_published) ? 'checked' : '' }}
                       class="text-[#c5a880] focus:ring-0 bg-[#0f1013] border-white/20">
                <span class="text-xs uppercase tracking-wider text-white">Published</span>
            </label>

            <div>
                <label for="display_order" class="block text-[10px] uppercase tracking-wider text-[#807e78] mb-1">Display Order</label>
                <input type="number"
                       id="display_order"
                       name="display_order"
                       value="{{ old('display_order', $photo->display_order) }}"
                       class="w-24 bg-[#0f1013] border border-white/10 px-3 py-1.5 text-xs text-white">
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-6 border-t border-white/10 flex items-center justify-between">
            <a href="{{ route('admin.photos.index') }}" class="text-xs uppercase tracking-wider text-[#807e78] hover:text-white">Cancel</a>
            <button type="submit"
                    class="px-8 py-3.5 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-[0.2em] font-medium hover:bg-[#d8be97] transition-colors shadow-lg">
                Update Photograph Details
            </button>
        </div>
    </form>
</div>

@endsection
