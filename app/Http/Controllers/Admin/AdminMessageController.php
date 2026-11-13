<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminMessageController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $query = ContactMessage::query();

        if ($filter === 'unread') {
            $query->where('is_read', false);
        } elseif ($filter === 'read') {
            $query->where('is_read', true);
        }

        $messages = $query->orderByDesc('created_at')->paginate(15)->withQueryString();

        $unreadCount = ContactMessage::where('is_read', false)->count();
        $totalCount = ContactMessage::count();

        return view('admin.messages.index', compact('messages', 'unreadCount', 'totalCount', 'filter'));
    }

    public function show(ContactMessage $message)
    {
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function update(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'admin_notes' => 'nullable|string|max:2000',
            'is_read' => 'nullable|boolean',
        ]);

        $message->update([
            'admin_notes' => $validated['admin_notes'] ?? $message->admin_notes,
            'is_read' => $request->boolean('is_read', true),
        ]);

        return back()->with('success', 'Message status and internal notes updated.');
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Inquiry message deleted.');
    }
}
