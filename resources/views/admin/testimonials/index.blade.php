@extends('layouts.admin')

@section('title', 'Manage Testimonials')
@section('header_title', 'Client Testimonials & Reviews')

@section('content')

<div class="flex items-center justify-between mb-8">
    <p class="text-xs text-[#807e78]">
        Manage feedback from fashion clients, creative directors, and private portrait sessions.
    </p>

    <a href="{{ route('admin.testimonials.create') }}"
       class="px-6 py-2.5 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-wider font-medium hover:bg-[#d8be97] transition-colors shadow-md">
        + Add Testimonial
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($testimonials as $t)
        <div class="bg-[#141519] border border-white/5 p-6 rounded flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <div class="flex text-[#c5a880] space-x-0.5">
                        @for($i = 0; $i < $t->rating; $i++)
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        @endfor
                    </div>
                    <span class="text-[9px] uppercase tracking-wider text-[#807e78]">{{ $t->project_type ?? 'Session' }}</span>
                </div>

                <p class="text-xs text-[#cfccc4] font-light italic leading-relaxed">
                    "{{ $t->review_text }}"
                </p>

                <div class="mt-4 pt-3 border-t border-white/5">
                    <div class="font-serif-luxury text-base text-white">{{ $t->client_name }}</div>
                    <div class="text-[10px] text-[#807e78]">{{ $t->client_role }} · {{ $t->client_company }}</div>
                </div>
            </div>

            <div class="pt-4 mt-4 border-t border-white/5 flex items-center justify-between text-xs">
                <a href="{{ route('admin.testimonials.edit', $t->id) }}" class="text-[#c5a880] hover:underline uppercase text-[11px] tracking-wider">
                    Edit
                </a>
                <form action="{{ route('admin.testimonials.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Remove this testimonial?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-rose-400 hover:text-rose-300 uppercase text-[11px] tracking-wider">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-full py-12 text-center text-[#807e78] bg-[#141519] border border-white/5 p-8">
            No testimonials recorded yet.
        </div>
    @endforelse
</div>

@endsection
