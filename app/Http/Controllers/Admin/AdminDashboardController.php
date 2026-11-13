<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Photo;
use App\Models\Service;
use App\Models\Testimonial;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_photos' => Photo::count(),
            'total_categories' => Category::count(),
            'total_services' => Service::count(),
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
            'completed_bookings' => Booking::where('status', 'completed')->count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
            'total_testimonials' => Testimonial::count(),
        ];

        $recentBookings = Booking::with('service')
            ->orderByDesc('created_at')
            ->take(6)
            ->get();

        $recentMessages = ContactMessage::orderByDesc('created_at')
            ->take(5)
            ->get();

        $featuredPhotos = Photo::where('is_featured', true)
            ->orderBy('display_order')
            ->take(4)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'recentMessages', 'featuredPhotos'));
    }
}
