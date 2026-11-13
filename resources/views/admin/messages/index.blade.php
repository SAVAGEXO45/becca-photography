@extends('layouts.admin')

@section('title', 'Customer Inquiries')
@section('header_title', 'Customer Inquiries & Messages')

@section('content')

<!-- Header & Filter Tabs -->
<div class="flex items-center justify-between gap-4 mb-8">
    <div class="flex items-center space-x-2">
        <a href="{{ route('admin.messages.index') }}"
           class="px-4 py-2 text-xs uppercase tracking-wider rounded transition-colors {{ !$filter ? 'bg-[#c5a880] text-[#0f1013] font-medium' : 'bg-[#141519] text-[#807e78] hover:text-white border border-white/5' }}">
            All ({{ $totalCount }})
        </a>
        <a href="{{ route('admin.messages.index', ['filter' => 'unread']) }}"
           class="px-4 py-2 text-xs uppercase tracking-wider rounded transition-colors {{ $filter === 'unread' ? 'bg-[#c5a880] text-[#0f1013] font-medium' : 'bg-[#141519] text-[#c5a880] hover:text-white border border-[#c5a880]/30' }}">
            Unread ({{ $unreadCount }})
        </a>
        <a href="{{ route('admin.messages.index', ['filter' => 'read']) }}"
           class="px-4 py-2 text-xs uppercase tracking-wider rounded transition-colors {{ $filter === 'read' ? 'bg-white/20 text-white font-medium' : 'bg-[#141519] text-[#807e78] hover:text-white border border-white/5' }}">
            Read
        </a>
    </div>
</div>

<!-- Messages List -->
<div class="bg-[#141519] border border-white/5 rounded overflow-hidden">
    <table class="w-full text-left text-xs">
        <thead>
            <tr class="bg-[#0f1013] text-[#807e78] uppercase tracking-wider border-b border-white/10">
                <th class="py-3.5 px-6">Sender Details</th>
                <th class="py-3.5 px-6">Service Interest / Subject</th>
                <th class="py-3.5 px-6">Message Excerpt</th>
                <th class="py-3.5 px-6">Received</th>
                <th class="py-3.5 px-6 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5 text-[#cfccc4]">
            @forelse($messages as $msg)
                <tr class="hover:bg-white/[0.02] transition-colors {{ !$msg->is_read ? 'bg-[#c5a880]/[0.03]' : '' }}">
                    <td class="py-4 px-6">
                        <div class="flex items-center space-x-2">
                            @if(!$msg->is_read)
                                <span class="w-2 h-2 rounded-full bg-[#c5a880] shrink-0" title="Unread"></span>
                            @endif
                            <div class="font-medium text-white text-sm">{{ $msg->name }}</div>
                        </div>
                        <div class="text-[11px] text-[#807e78] mt-0.5">{{ $msg->email }}</div>
                        @if($msg->phone)
                            <div class="text-[10px] text-[#807e78]">{{ $msg->phone }}</div>
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        <div class="font-medium text-white">{{ $msg->subject ?? 'Inquiry' }}</div>
                        <div class="text-[11px] text-[#c5a880] mt-0.5">{{ $msg->service_interest ?? 'General' }}</div>
                    </td>
                    <td class="py-4 px-6 text-[#9e9b93] max-w-md">
                        <p class="truncate">{{ $msg->message }}</p>
                    </td>
                    <td class="py-4 px-6 text-[#807e78] whitespace-nowrap">
                        {{ $msg->created_at->diffForHumans() }}
                    </td>
                    <td class="py-4 px-6 text-right">
                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('admin.messages.show', $msg->id) }}"
                               class="text-[#c5a880] hover:underline uppercase text-[11px] tracking-wider">
                                View
                            </a>
                            <form action="{{ route('admin.messages.destroy', $msg->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this inquiry message?')">
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
                    <td colspan="5" class="py-10 text-center text-[#807e78]">No inquiries match this filter.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($messages->hasPages())
        <div class="p-4 bg-[#0f1013] border-t border-white/10">
            {{ $messages->links() }}
        </div>
    @endif
</div>

@endsection
