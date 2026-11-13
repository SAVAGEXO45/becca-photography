<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $search = $request->query('search');

        $query = Booking::with('service');

        if ($status && in_array($status, ['pending', 'confirmed', 'completed', 'cancelled'])) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('booking_reference', 'like', "%{$search}%")
                    ->orWhere('client_name', 'like', "%{$search}%")
                    ->orWhere('client_email', 'like', "%{$search}%")
                    ->orWhere('client_phone', 'like', "%{$search}%");
            });
        }

        $bookings = $query->orderByDesc('created_at')->paginate(15)->withQueryString();

        $statusCounts = [
            'all' => Booking::count(),
            'pending' => Booking::where('status', 'pending')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
            'completed' => Booking::where('status', 'completed')->count(),
            'cancelled' => Booking::where('status', 'cancelled')->count(),
        ];

        return view('admin.bookings.index', compact('bookings', 'statusCounts', 'status', 'search'));
    }

    public function show(Booking $booking)
    {
        $booking->load('service');
        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $updates = [
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? $booking->admin_notes,
        ];

        if ($validated['status'] === 'confirmed' && !$booking->confirmed_at) {
            $updates['confirmed_at'] = now();
        } elseif ($validated['status'] === 'completed' && !$booking->completed_at) {
            $updates['completed_at'] = now();
        } elseif ($validated['status'] === 'cancelled' && !$booking->cancelled_at) {
            $updates['cancelled_at'] = now();
        }

        $booking->update($updates);

        return back()->with('success', "Booking #{$booking->booking_reference} status updated to {$validated['status']}.");
    }

    public function destroy(Booking $booking)
    {
        $ref = $booking->booking_reference;
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', "Booking #{$ref} deleted.");
    }
}
