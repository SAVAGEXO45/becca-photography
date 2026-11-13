@extends('layouts.admin')

@section('title', 'Manage Categories')
@section('header_title', 'Portfolio Categories')

@section('content')

<div class="flex items-center justify-between mb-8">
    <p class="text-xs text-[#807e78]">
        Organize portfolio archives into curated themes and genres.
    </p>

    <a href="{{ route('admin.categories.create') }}"
       class="px-6 py-2.5 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-wider font-medium hover:bg-[#d8be97] transition-colors shadow-md">
        + Create Category
    </a>
</div>

<div class="bg-[#141519] border border-white/5 rounded overflow-hidden">
    <table class="w-full text-left text-xs">
        <thead>
            <tr class="bg-[#0f1013] text-[#807e78] uppercase tracking-wider border-b border-white/10">
                <th class="py-3.5 px-6">Category Name</th>
                <th class="py-3.5 px-6">Slug</th>
                <th class="py-3.5 px-6">Photographs Count</th>
                <th class="py-3.5 px-6">Display Order</th>
                <th class="py-3.5 px-6">Status</th>
                <th class="py-3.5 px-6 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5 text-[#cfccc4]">
            @forelse($categories as $category)
                <tr class="hover:bg-white/[0.02] transition-colors">
                    <td class="py-4 px-6 font-medium text-white text-sm">
                        {{ $category->name }}
                        @if($category->description)
                            <div class="text-[11px] text-[#807e78] font-normal truncate max-w-sm mt-0.5">{{ $category->description }}</div>
                        @endif
                    </td>
                    <td class="py-4 px-6 font-mono text-[11px] text-[#807e78]">
                        {{ $category->slug }}
                    </td>
                    <td class="py-4 px-6">
                        <span class="px-2.5 py-1 bg-white/5 border border-white/10 rounded font-mono text-[#c5a880]">
                            {{ $category->photos_count }} works
                        </span>
                    </td>
                    <td class="py-4 px-6 text-[#807e78] font-mono">
                        {{ $category->order }}
                    </td>
                    <td class="py-4 px-6">
                        @if($category->is_active)
                            <span class="text-emerald-400 uppercase text-[10px] tracking-wider">Active</span>
                        @else
                            <span class="text-stone-500 uppercase text-[10px] tracking-wider">Inactive</span>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-right">
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                               class="text-[#c5a880] hover:underline uppercase text-[11px] tracking-wider">
                                Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete category {{ $category->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-400 hover:text-rose-300 uppercase text-[11px] tracking-wider">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-8 text-center text-[#807e78]">No categories defined yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
