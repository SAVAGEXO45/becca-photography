<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $selectedServiceId = $request->query('service');
        $selectedService = $selectedServiceId ? Service::find($selectedServiceId) : null;

        return view('pages.book', compact('services', 'selectedService'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:50',
            'preferred_date' => 'required|date|after_or_equal:today',
            'preferred_time' => 'required|string|max:50',
            'photoshoot_location' => 'required|string|max:255',
            'additional_requirements' => 'nullable|string|max:2000',
        ]);

        $service = Service::findOrFail($validated['service_id']);

        $reference = Booking::generateReference();

        $booking = Booking::create([
            'booking_reference' => $reference,
            'service_id' => $service->id,
            'service_name' => $service->name,
            'client_name' => $validated['client_name'],
            'client_email' => $validated['client_email'],
            'client_phone' => $validated['client_phone'],
            'preferred_date' => $validated['preferred_date'],
            'preferred_time' => $validated['preferred_time'],
            'photoshoot_location' => $validated['photoshoot_location'],
            'additional_requirements' => $validated['additional_requirements'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.confirmation', ['reference' => $reference])
            ->with('success', 'Your booking request has been submitted successfully.');
    }

    public function confirmation(string $reference)
    {
        $booking = Booking::with('service')->where('booking_reference', $reference)->firstOrFail();

        return view('pages.booking-confirmation', compact('booking'));
    }

    public function track(Request $request)
    {
        $reference = $request->query('reference');
        $booking = null;
        $error = null;

        if ($reference) {
            $booking = Booking::with('service')->where('booking_reference', trim($reference))->first();
            if (!$booking) {
                $error = 'No booking found with reference "' . htmlspecialchars($reference) . '". Please verify your reference code.';
            }
        }

        return view('pages.booking-track', compact('booking', 'reference', 'error'));
    }
}
