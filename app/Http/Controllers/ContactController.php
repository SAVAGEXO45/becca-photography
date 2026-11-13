<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contactEmail = SiteSetting::get('contact_email', 'SAVAGEXO@GMAIL.COM');
        $contactPhone = SiteSetting::get('contact_phone', '+234 812 345 6789');
        $studioAddress = SiteSetting::get('studio_address', 'The Foundry Studio, 14 Victoria Island Arts District, Lagos');
        $openingHours = SiteSetting::get('opening_hours', 'Tuesday – Sunday: 9:00 AM – 6:30 PM');
        $instagram = SiteSetting::get('instagram', '@beccaphotography');
        $twitter = SiteSetting::get('twitter', '@beccaphotos');

        return view('pages.contact', compact(
            'contactEmail',
            'contactPhone',
            'studioAddress',
            'openingHours',
            'instagram',
            'twitter'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'service_interest' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:3000',
        ]);

        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'service_interest' => $validated['service_interest'] ?? null,
            'subject' => $validated['subject'] ?? 'General Photography Inquiry',
            'message' => $validated['message'],
            'is_read' => false,
        ]);

        return redirect()->route('contact')
            ->with('success', 'Thank you for contacting BECCA PHOTOGRAPHY. Your message has been received, and we will get back to you within 24 hours.');
    }
}
