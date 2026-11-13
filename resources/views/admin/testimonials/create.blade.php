@extends('layouts.admin')

@section('title', 'Add Testimonial')
@section('header_title', 'Add Client Review')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.testimonials.index') }}" class="text-xs uppercase tracking-wider text-[#807e78] hover:text-white transition-colors">
        &larr; Back to Testimonials
    </a>
</div>

<div class="max-w-xl bg-[#141519] border border-white/5 p-8 rounded shadow-2xl">
    <form action="{{ route('admin.testimonials.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="client_name" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Client / Collaborator Name *</label>
            <input type="text"
                   id="client_name"
                   name="client_name"
                   value="{{ old('client_name') }}"
                   placeholder="e.g. Tola Adeleke"
                   required
                   class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="client_role" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Role / Title</label>
                <input type="text"
                       id="client_role"
                       name="client_role"
                       value="{{ old('client_role') }}"
                       placeholder="e.g. Creative Director"
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>

            <div>
                <label for="client_company" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Brand / Company</label>
                <input type="text"
                       id="client_company"
                       name="client_company"
                       value="{{ old('client_company', 'SAVAGE XO') }}"
                       placeholder="e.g. SAVAGE XO"
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
            </div>
        </div>

        <div>
            <label for="project_type" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Project / Shoot Type</label>
            <input type="text"
                   id="project_type"
                   name="project_type"
                   value="{{ old('project_type', 'Lookbook Editorial Campaign') }}"
                   placeholder="e.g. Lookbook Campaign"
                   class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
        </div>

        <div>
            <label for="review_text" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Review / Testimonial Statement *</label>
            <textarea id="review_text"
                      name="review_text"
                      rows="4"
                      required
                      placeholder="Share the feedback regarding lighting, pacing, mood, and final delivery..."
                      class="w-full bg-[#0f1013] border border-white/10 p-4 text-sm text-white focus:outline-none focus:border-[#c5a880]">{{ old('review_text') }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="rating" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Star Rating (1 - 5) *</label>
                <select id="rating" name="rating" class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
                    <option value="5">5 Stars - Exceptional</option>
                    <option value="4">4 Stars - Very Good</option>
                    <option value="3">3 Stars</option>
                </select>
            </div>

            <div class="flex items-center pt-6">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" checked class="text-[#c5a880] focus:ring-0 bg-[#0f1013] border-white/20">
                    <span class="text-xs uppercase tracking-wider text-white">Feature on Homepage</span>
                </label>
            </div>
        </div>

        <div class="pt-6 border-t border-white/10 flex items-center justify-between">
            <a href="{{ route('admin.testimonials.index') }}" class="text-xs uppercase tracking-wider text-[#807e78] hover:text-white">Cancel</a>
            <button type="submit"
                    class="px-6 py-3 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-wider font-medium hover:bg-[#d8be97] transition-colors">
                Publish Review
            </button>
        </div>
    </form>
</div>

@endsection
