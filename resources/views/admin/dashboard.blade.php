@extends('layouts.admin')

@section('title', 'Dashboard Overview')
@section('header_title', 'Studio Atelier Dashboard')

@section('content')

<!-- Stat Metrics Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <div class="bg-[#141519] border border-white/5 p-6 rounded relative overflow-hidden">
        <span class="text-[10px] uppercase tracking-widest text-[#807e78]">Total Photographs</span>
        <div class="font-serif-luxury text-3xl sm:text-4xl text-white mt-1">{{ $stats['total_photos'] }}</div>
        <div class="text-[11px] text-[#c5a880] mt-2">Active in public portfolio</div>
    </div>

    <div class="bg-[#141519] border border-white/5 p-6 rounded relative overflow-hidden">
        <span class="text-[10px] uppercase tracking-widest text-[#807e78]">Total Bookings</span>
        <div class="font-serif-luxury text-3xl sm:text-4xl text-white mt-1">{{ $stats['total_bookings'] }}</div>
        <div class="text-[11px] text-emerald-400 mt-2">{{ $stats['confirmed_bookings'] }} Confirmed · {{ $stats['completed_bookings'] }} Completed</div>
    </div>

    <div class="bg-[#141519] border border-amber-500/20 p-6 rounded relative overflow-hidden bg-amber-500/[0.02]">
        <span class="text-[10px] uppercase tracking-widest text-amber-400">Pending Requests</span>
        <div class="font-serif-luxury text-3xl sm:text-4xl text-amber-300 mt-1">{{ $stats['pending_bookings'] }}</div>
        <div class="text-[11px] text-amber-400/80 mt-2">Awaiting schedule confirmation</div>
    </div>

    <div class="bg-[#141519] border border-white/5 p-6 rounded relative overflow-hidden">
        <span class="text-[10px] uppercase tracking-widest text-[#807e78]">Customer Inquiries</span>
        <div class="font-serif-luxury text-3xl sm:text-4xl text-white mt-1">{{ $stats['unread_messages'] }} Unread</div>
        <div class="text-[11px] text-[#807e78] mt-2">Via contact forms & email</div>
    </div>
</div>

<!-- Quick Action Strip -->
<div class="bg-[#141519] border border-white/5 p-6 rounded mb-10 flex flex-wrap items-center justify-between gap-4">
    <div class="flex items-center space-x-3">
        <div class="w-8 h-8 rounded bg-[#c5a880]/10 flex items-center justify-center text-[#c5a880]">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
        </div>
        <div>
            <div class="text-xs uppercase tracking-wider text-white font-medium">Quick Creative Actions</div>
            <div class="text-[11px] text-[#807e78]">Instantly add works or modify pricing</div>
        </div>
    </div>

    <div class="flex flex-wrap items-center gap-3">
        <a href="{{ route('admin.photos.create') }}"
           class="px-4 py-2 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-wider font-medium hover:bg-[#d8be97] transition-colors">
            + Upload Photograph
        </a>
        <a href="{{ route('admin.services.create') }}"
           class="px-4 py-2 bg-white/10 text-white text-xs uppercase tracking-wider font-medium hover:bg-white/20 transition-colors">
            + Add Service Package
        </a>
        <a href="{{ route('admin.categories.create') }}"
           class="px-4 py-2 bg-white/10 text-white text-xs uppercase tracking-wider font-medium hover:bg-white/20 transition-colors">
            + Add Category
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    <!-- Recent Bookings Table -->
    <div class="lg:col-span-8 bg-[#141519] border border-white/5 p-6 rounded">
        <div class="flex items-center justify-between pb-4 border-b border-white/10 mb-6">
            <div>
                <h3 class="text-sm uppercase tracking-wider text-white font-medium">Recent Booking Requests</h3>
                <p class="text-[11px] text-[#807e78]">Latest incoming client schedules</p>
            </div>
            <a href="{{ route('admin.bookings.index') }}" class="text-xs uppercase tracking-wider text-[#c5a880] hover:underline">
                View All Bookings &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="text-[#807e78] uppercase tracking-wider border-b border-white/10 pb-2">
                        <th class="py-3 px-2">Reference</th>
                        <th class="py-3 px-2">Client</th>
                        <th class="py-3 px-2">Service</th>
                        <th class="py-3 px-2">Date</th>
                        <th class="py-3 px-2">Status</th>
                        <th class="py-3 px-2 text-right">Quick Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 text-[#cfccc4]">
                    @forelse($recentBookings as $bk)
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="py-3 px-2 font-mono text-[#c5a880]">
                                <a href="{{ route('admin.bookings.show', $bk->id) }}" class="hover:underline">
                                    {{ $bk->booking_reference }}
                                </a>
                            </td>
                            <td class="py-3 px-2">
                                <div class="font-medium text-white">{{ $bk->client_name }}</div>
                                <div class="text-[10px] text-[#807e78]">{{ $bk->client_phone }}</div>
                            </td>
                            <td class="py-3 px-2 text-[11px]">{{ $bk->service_name }}</td>
                            <td class="py-3 px-2 text-[11px]">{{ $bk->preferred_date->format('M d, Y') }}</td>
                            <td class="py-3 px-2">
                                <span class="px-2 py-0.5 rounded text-[10px] uppercase tracking-wider font-semibold {{ $bk->status_badge }}">
                                    {{ ucfirst($bk->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-2 text-right">
                                <form action="{{ route('admin.bookings.status', $bk->id) }}" method="POST" class="inline-flex items-center space-x-1">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="bg-[#0f1013] border border-white/10 text-[10px] py-1 px-1.5 rounded text-white focus:outline-none focus:border-[#c5a880]">
                                        <option value="pending" {{ $bk->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $bk->status === 'confirmed' ? 'selected' : '' }}>Confirm</option>
                                        <option value="completed" {{ $bk->status === 'completed' ? 'selected' : '' }}>Complete</option>
                                        <option value="cancelled" {{ $bk->status === 'cancelled' ? 'selected' : '' }}>Cancel</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-[#807e78]">No bookings recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Customer Inquiries / Messages -->
    <div class="lg:col-span-4 bg-[#141519] border border-white/5 p-6 rounded space-y-6">
        <div class="flex items-center justify-between pb-4 border-b border-white/10">
            <div>
                <h3 class="text-sm uppercase tracking-wider text-white font-medium">Recent Inquiries</h3>
                <p class="text-[11px] text-[#807e78]">Messages from contact page</p>
            </div>
            <a href="{{ route('admin.messages.index') }}" class="text-xs uppercase tracking-wider text-[#c5a880] hover:underline">
                All &rarr;
            </a>
        </div>

        <div class="space-y-4">
            @forelse($recentMessages as $msg)
                <a href="{{ route('admin.messages.show', $msg->id) }}" class="block p-3.5 bg-[#0f1013] border border-white/5 hover:border-[#c5a880]/30 transition-all rounded">
                    <div class="flex items-start justify-between">
                        <div class="font-medium text-xs text-white">{{ $msg->name }}</div>
                        @if(!$msg->is_read)
                            <span class="w-2 h-2 rounded-full bg-[#c5a880]"></span>
                        @endif
                    </div>
                    <div class="text-[11px] text-[#807e78] mt-0.5">{{ $msg->subject ?? 'Inquiry' }}</div>
                    <p class="text-xs text-[#cfccc4] font-light mt-2 line-clamp-2">{{ $msg->message }}</p>
                </a>
            @empty
                <div class="py-6 text-center text-xs text-[#807e78]">No recent messages.</div>
            @endforelse
        </div>
    </div>
</div>

@endsection
