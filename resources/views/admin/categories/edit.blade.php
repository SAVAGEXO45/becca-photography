@extends('layouts.admin')

@section('title', 'Edit Category: ' . $category->name)
@section('header_title', 'Edit Category: ' . $category->name)

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.categories.index') }}" class="text-xs uppercase tracking-wider text-[#807e78] hover:text-white transition-colors">
        &larr; Back to Categories
    </a>
</div>

<div class="max-w-xl bg-[#141519] border border-white/5 p-8 rounded shadow-2xl">
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Category Name *</label>
            <input type="text"
                   id="name"
                   name="name"
                   value="{{ old('name', $category->name) }}"
                   required
                   class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
        </div>

        <div>
            <label for="description" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Description / Theme Statement</label>
            <textarea id="description"
                      name="description"
                      rows="3"
                      class="w-full bg-[#0f1013] border border-white/10 p-4 text-sm text-white focus:outline-none focus:border-[#c5a880]">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="order" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Sort Order</label>
                <input type="number"
                       id="order"
                       name="order"
                       value="{{ old('order', $category->order) }}"
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>

            <div class="flex items-center pt-6">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                           class="text-[#c5a880] focus:ring-0 bg-[#0f1013] border-white/20">
                    <span class="text-xs uppercase tracking-wider text-white">Active in Gallery</span>
                </label>
            </div>
        </div>

        <div class="pt-6 border-t border-white/10 flex items-center justify-between">
            <a href="{{ route('admin.categories.index') }}" class="text-xs uppercase tracking-wider text-[#807e78] hover:text-white">Cancel</a>
            <button type="submit"
                    class="px-6 py-3 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-wider font-medium hover:bg-[#d8be97] transition-colors">
                Update Category
            </button>
        </div>
    </form>
</div>

@endsection
