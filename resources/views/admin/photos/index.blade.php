@extends('layouts.admin')

@section('title', 'Manage Photographs')
@section('header_title', 'Portfolio Photo Atelier')

@section('content')

<!-- Header & Controls -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.photos.index') }}"
           class="px-4 py-2 text-xs uppercase tracking-wider rounded transition-colors {{ !$categoryId ? 'bg-[#c5a880] text-[#0f1013] font-medium' : 'bg-[#141519] text-[#807e78] hover:text-white border border-white/5' }}">
            All Works
        </a>

        <!-- Category Dropdown Filter -->
        <form action="{{ route('admin.photos.index') }}" method="GET" class="inline-block">
            <select name="category_id" onchange="this.form.submit()" class="bg-[#141519] border border-white/10 text-xs py-2 px-3 text-[#cfccc4] focus:outline-none focus:border-[#c5a880]">
                <option value="">Filter by Category...</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <a href="{{ route('admin.photos.create') }}"
       class="px-6 py-2.5 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-wider font-medium hover:bg-[#d8be97] transition-colors shadow-md text-center">
        + Upload New Photograph
    </a>
</div>

<!-- Photos Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse($photos as $photo)
        <div class="bg-[#141519] border border-white/5 rounded overflow-hidden flex flex-col justify-between group">
            <div>
                <!-- Image Container with Aspect Ratio Display -->
                <div class="relative bg-[#0f1013] overflow-hidden aspect-[3/4]">
                    <img src="{{ $photo->url }}"
                         alt="{{ $photo->title }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                         loading="lazy">

                    <!-- Badges -->
                    <div class="absolute top-2 left-2 flex flex-col gap-1">
                        @if($photo->is_hero)
                            <span class="px-2 py-0.5 text-[9px] uppercase tracking-wider bg-[#c5a880] text-[#0f1013] font-bold shadow">
                                Hero Shot
                            </span>
                        @endif
                        @if($photo->is_featured)
                            <span class="px-2 py-0.5 text-[9px] uppercase tracking-wider bg-black/80 text-[#c5a880] border border-[#c5a880]/30 font-semibold">
                                Featured
                            </span>
                        @endif
                    </div>

                    <span class="absolute bottom-2 right-2 px-2 py-0.5 text-[9px] uppercase bg-black/70 text-white/80 font-mono">
                        {{ $photo->aspect_ratio }}
                    </span>
                </div>

                <!-- Info Block -->
                <div class="p-4 space-y-1">
                    <span class="text-[9px] uppercase tracking-widest text-[#c5a880] block">
                        {{ $photo->category->name ?? 'Uncategorized' }}
                    </span>
                    <h3 class="font-serif-luxury text-lg text-white font-medium truncate" title="{{ $photo->title }}">
                        {{ $photo->title }}
                    </h3>
                    <div class="text-[11px] text-[#807e78] flex items-center justify-between">
                        <span>{{ $photo->client_name ?? 'Editorial' }}</span>
                        <span>{{ $photo->dimensions ?? '' }}</span>
                    </div>
                </div>
            </div>

            <!-- Card Actions -->
            <div class="p-4 pt-0 border-t border-white/5 flex items-center justify-between text-xs">
                <a href="{{ route('admin.photos.edit', $photo->id) }}"
                   class="text-[#c5a880] hover:underline uppercase text-[11px] tracking-wider">
                    Edit Details
                </a>
                <form action="{{ route('admin.photos.destroy', $photo->id) }}"
                      method="POST"
                      onsubmit="return confirm('Permanently remove this photograph from the portfolio?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-rose-400 hover:text-rose-300 uppercase text-[11px] tracking-wider">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-full py-16 text-center text-[#807e78] bg-[#141519] border border-white/5 p-8">
            <p>No photographs found matching this category filter.</p>
            <div class="mt-4">
                <a href="{{ route('admin.photos.create') }}" class="text-xs uppercase tracking-wider text-[#c5a880] hover:underline">
                    Upload your first photograph now &rarr;
                </a>
            </div>
        </div>
    @endforelse
</div>

<!-- Pagination -->
@if($photos->hasPages())
    <div class="mt-8 p-4 bg-[#141519] border border-white/5 rounded">
        {{ $photos->links() }}
    </div>
@endif

@endsection
