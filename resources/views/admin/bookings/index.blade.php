@extends('layouts.admin')

@section('title', 'Manage Bookings')
@section('header_title', 'Client Bookings Management')

@section('content')

<!-- Header & Filter Tabs -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <!-- Status Filter Buttons -->
    <div class="flex flex-wrap items-center gap-2">
        <a href="{{ route('admin.bookings.index') }}"
           class="px-4 py-2 text-xs uppercase tracking-wider rounded transition-colors {{ !$status ? 'bg-[#c5a880] text-[#0f1013] font-medium' : 'bg-[#141519] text-[#807e78] hover:text-white border border-white/5' }}">
            All ({{ $statusCounts['all'] }})
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}"
           class="px-4 py-2 text-xs uppercase tracking-wider rounded transition-colors {{ $status === 'pending' ? 'bg-amber-500 text-black font-medium' : 'bg-[#141519] text-amber-400 hover:text-white border border-amber-500/20' }}">
            Pending ({{ $statusCounts['pending'] }})
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'confirmed']) }}"
           class="px-4 py-2 text-xs uppercase tracking-wider rounded transition-colors {{ $status === 'confirmed' ? 'bg-emerald-600 text-white font-medium' : 'bg-[#141519] text-emerald-400 hover:text-white border border-emerald-500/20' }}">
            Confirmed ({{ $statusCounts['confirmed'] }})
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'completed']) }}"
           class="px-4 py-2 text-xs uppercase tracking-wider rounded transition-colors {{ $status === 'completed' ? 'bg-blue-600 text-white font-medium' : 'bg-[#141519] text-blue-400 hover:text-white border border-blue-500/20' }}">
            Completed ({{ $statusCounts['completed'] }})
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'cancelled']) }}"
           class="px-4 py-2 text-xs uppercase tracking-wider rounded transition-colors {{ $status === 'cancelled' ? 'bg-rose-600 text-white font-medium' : 'bg-[#141519] text-rose-400 hover:text-white border border-rose-500/20' }}">
            Cancelled ({{ $statusCounts['cancelled'] }})
        </a>
    </div>

    <!-- Search Form -->
    <form action="{{ route('admin.bookings.index') }}" method="GET" class="flex items-center gap-2">
        @if($status)
            <input type="hidden" name="status" value="{{ $status }}">
        @endif
        <input type="text"
               name="search"
               value="{{ $search }}"
               placeholder="Search reference, client name, email..."
               class="bg-[#141519] border border-white/10 px-4 py-2 text-xs text-white placeholder-stone-600 focus:outline-none focus:border-[#c5a880] w-64">
        <button type="submit" class="px-3 py-2 bg-white/10 text-white text-xs hover:bg-white/20 transition-colors">
            Search
        </button>
        @if($search)
            <a href="{{ route('admin.bookings.index', ['status' => $status]) }}" class="text-xs text-rose-400 hover:underline">Clear</a>
        @endif
    </form>
</div>

<!-- Bookings Table -->
<div class="bg-[#141519] border border-white/5 rounded overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead>
                <tr class="bg-[#0f1013] text-[#807e78] uppercase tracking-wider border-b border-white/10">
                    <th class="py-3.5 px-4">Ref Code</th>
                    <th class="py-3.5 px-4">Client Information</th>
                    <th class="py-3.5 px-4">Service Package</th>
                    <th class="py-3.5 px-4">Date & Time</th>
                    <th class="py-3.5 px-4">Location</th>
                    <th class="py-3.5 px-4">Status</th>
                    <th class="py-3.5 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5 text-[#cfccc4]">
                @forelse($bookings as $booking)
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="py-3.5 px-4 font-mono font-medium text-[#c5a880]">
                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="hover:underline">
                                {{ $booking->booking_reference }}
                            </a>
                        </td>
                        <td class="py-3.5 px-4">
                            <div class="font-medium text-white">{{ $booking->client_name }}</div>
                            <div class="text-[11px] text-[#807e78]">{{ $booking->client_email }}</div>
                            <div class="text-[11px] text-[#807e78]">{{ $booking->client_phone }}</div>
                        </td>
                        <td class="py-3.5 px-4 font-medium text-white">
                            {{ $booking->service_name }}
                        </td>
                        <td class="py-3.5 px-4">
                            <div>{{ $booking->preferred_date->format('M d, Y') }}</div>
                            <div class="text-[10px] text-[#807e78]">{{ $booking->preferred_time }}</div>
                        </td>
                        <td class="py-3.5 px-4 text-[11px] max-w-xs truncate">
                            {{ $booking->photoshoot_location }}
                        </td>
                        <td class="py-3.5 px-4">
                            <form action="{{ route('admin.bookings.status', $booking->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="bg-[#0f1013] border border-white/10 text-[11px] py-1 px-2 rounded font-medium focus:outline-none focus:border-[#c5a880] {{ $booking->status_badge }}">
                                    <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td class="py-3.5 px-4 text-right">
                            <div class="flex items-center justify-end space-x-3">
                                <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                   class="text-[#c5a880] hover:underline uppercase text-[11px] tracking-wider">
                                    Details
                                </a>
                                <form action="{{ route('admin.bookings.destroy', $booking->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete booking #{{ $booking->booking_reference }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-400 hover:text-rose-300 text-[11px] uppercase tracking-wider">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-10 text-center text-[#807e78]">
                            No bookings match your current filter.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($bookings->hasPages())
        <div class="p-4 border-t border-white/10 bg-[#0f1013]">
            {{ $bookings->links() }}
        </div>
    @endif
</div>

@endsection
