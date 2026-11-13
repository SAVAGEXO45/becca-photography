@extends('layouts.admin')

@section('title', 'Inquiry from ' . $message->name)
@section('header_title', 'Inquiry Details: ' . $message->name)

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.messages.index') }}" class="text-xs uppercase tracking-wider text-[#807e78] hover:text-white transition-colors">
        &larr; Back to Inquiries
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    <!-- Message Content Box -->
    <div class="lg:col-span-8 bg-[#141519] border border-white/5 p-8 rounded space-y-6">
        <div class="flex items-start justify-between pb-6 border-b border-white/10">
            <div>
                <span class="text-[10px] uppercase tracking-widest text-[#c5a880] block">Inquiry Subject</span>
                <h2 class="font-serif-luxury text-2xl text-white font-medium mt-1">
                    {{ $message->subject ?? 'Photography Session Inquiry' }}
                </h2>
                <div class="text-xs text-[#807e78] mt-1">
                    Received {{ $message->created_at->format('F d, Y · h:i A') }}
                </div>
            </div>

            <span class="px-3 py-1 rounded text-[10px] uppercase tracking-wider font-semibold {{ $message->is_read ? 'bg-white/5 text-[#807e78]' : 'bg-[#c5a880]/20 text-[#c5a880]' }}">
                {{ $message->is_read ? 'Read' : 'New' }}
            </span>
        </div>

        <!-- Sender Details -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 bg-[#0f1013] border border-white/5 rounded text-xs">
            <div>
                <span class="text-[#807e78] block text-[10px] uppercase">From</span>
                <span class="text-white font-medium mt-0.5 block">{{ $message->name }}</span>
            </div>
            <div>
                <span class="text-[#807e78] block text-[10px] uppercase">Email</span>
                <a href="mailto:{{ $message->email }}" class="text-[#c5a880] hover:underline font-medium mt-0.5 block">
                    {{ $message->email }}
                </a>
            </div>
            <div>
                <span class="text-[#807e78] block text-[10px] uppercase">Phone</span>
                <span class="text-white font-medium mt-0.5 block">{{ $message->phone ?? 'Not provided' }}</span>
            </div>
        </div>

        @if($message->service_interest)
            <div class="text-xs">
                <span class="text-[#807e78] uppercase text-[10px]">Service of Interest:</span>
                <span class="text-[#c5a880] font-medium ml-2">{{ $message->service_interest }}</span>
            </div>
        @endif

        <!-- Message Body -->
        <div class="pt-4 border-t border-white/10">
            <span class="text-[10px] uppercase tracking-wider text-[#807e78] block mb-2">Message:</span>
            <div class="p-6 bg-[#0f1013] border border-white/5 rounded text-sm text-[#cfccc4] font-light leading-relaxed whitespace-pre-line">
                {{ $message->message }}
            </div>
        </div>

        <!-- Action Bar -->
        <div class="pt-4 flex items-center space-x-4">
            <a href="mailto:{{ $message->email }}?subject=Re:%20{{ urlencode($message->subject ?? 'Photography Inquiry') }}"
               class="px-6 py-2.5 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-wider font-medium hover:bg-[#d8be97] transition-colors">
                Reply via Email
            </a>
            <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Delete this inquiry?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2.5 text-rose-400 hover:text-rose-300 text-xs uppercase tracking-wider">
                    Delete Inquiry
                </button>
            </form>
        </div>
    </div>

    <!-- Admin Notes Sidebar -->
    <div class="lg:col-span-4 bg-[#141519] border border-white/5 p-8 rounded space-y-4">
        <h3 class="text-xs font-semibold uppercase tracking-wider text-white">Internal Studio Follow-up</h3>

        <form action="{{ route('admin.messages.update', $message->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label for="admin_notes" class="block text-xs uppercase tracking-wider text-[#807e78] mb-2">Admin Notes</label>
                <textarea id="admin_notes"
                          name="admin_notes"
                          rows="5"
                          placeholder="Log call notes, rate card sent, or next follow-up dates..."
                          class="w-full bg-[#0f1013] border border-white/10 p-3 text-xs text-white focus:outline-none focus:border-[#c5a880]">{{ old('admin_notes', $message->admin_notes) }}</textarea>
            </div>

            <div class="flex items-center space-x-2">
                <input type="checkbox" name="is_read" value="1" {{ $message->is_read ? 'checked' : '' }} class="bg-[#0f1013] border-white/20 text-[#c5a880] focus:ring-0">
                <label class="text-xs text-[#cfccc4]">Mark as Read</label>
            </div>

            <button type="submit" class="w-full py-2.5 bg-white/10 text-white text-xs uppercase tracking-wider hover:bg-white/20 transition-colors">
                Update Note
            </button>
        </form>
    </div>
</div>

@endsection
