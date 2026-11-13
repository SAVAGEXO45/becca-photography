@extends('layouts.admin')

@section('title', 'Manage Services & Pricing')
@section('header_title', 'Photography Services & Packages')

@section('content')

<div class="flex items-center justify-between mb-8">
    <p class="text-xs text-[#807e78]">
        Configure packages, pricing, deliverables, and session parameters.
    </p>

    <a href="{{ route('admin.services.create') }}"
       class="px-6 py-2.5 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-wider font-medium hover:bg-[#d8be97] transition-colors shadow-md">
        + Create Service Package
    </a>
</div>

<div class="bg-[#141519] border border-white/5 rounded overflow-hidden">
    <table class="w-full text-left text-xs">
        <thead>
            <tr class="bg-[#0f1013] text-[#807e78] uppercase tracking-wider border-b border-white/10">
                <th class="py-3.5 px-6">Service Package</th>
                <th class="py-3.5 px-6">Starting Price</th>
                <th class="py-3.5 px-6">Duration</th>
                <th class="py-3.5 px-6">Turnaround</th>
                <th class="py-3.5 px-6">Bookings</th>
                <th class="py-3.5 px-6">Status</th>
                <th class="py-3.5 px-6 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5 text-[#cfccc4]">
            @forelse($services as $svc)
                <tr class="hover:bg-white/[0.02] transition-colors">
                    <td class="py-4 px-6 font-medium text-white">
                        <div class="text-sm">{{ $svc->name }}</div>
                        @if($svc->tagline)
                            <div class="text-[11px] text-[#c5a880]">{{ $svc->tagline }}</div>
                        @endif
                    </td>
                    <td class="py-4 px-6 font-serif-luxury text-base text-white">
                        {{ $svc->formatted_price }}
                    </td>
                    <td class="py-4 px-6 text-[#807e78]">
                        {{ $svc->duration ?? '2 Hours' }}
                    </td>
                    <td class="py-4 px-6 text-[#807e78]">
                        {{ $svc->turnaround_time ?? '3-5 Days' }}
                    </td>
                    <td class="py-4 px-6 font-mono text-[#c5a880]">
                        {{ $svc->bookings_count }}
                    </td>
                    <td class="py-4 px-6">
                        @if($svc->is_active)
                            <span class="text-emerald-400 uppercase text-[10px] tracking-wider">Active</span>
                        @else
                            <span class="text-stone-500 uppercase text-[10px] tracking-wider">Inactive</span>
                        @endif
                        @if($svc->is_popular)
                            <span class="ml-1 px-1.5 py-0.5 text-[9px] bg-[#c5a880]/20 text-[#c5a880] rounded">Popular</span>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-right">
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('admin.services.edit', $svc->id) }}"
                               class="text-[#c5a880] hover:underline uppercase text-[11px] tracking-wider">
                                Edit
                            </a>
                            <form action="{{ route('admin.services.destroy', $svc->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete package {{ $svc->name }}?')">
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
                    <td colspan="7" class="py-8 text-center text-[#807e78]">No photography services defined yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
