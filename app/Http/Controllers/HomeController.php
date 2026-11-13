<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photo;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get hero photo or featured photo
        $heroPhoto = Photo::where('is_hero', true)->where('is_published', true)->first()
            ?? Photo::where('is_published', true)->orderBy('display_order')->first();

        // Featured work (editorial selection using user's actual photos)
        $featuredPhotos = Photo::with('category')
            ->where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('display_order')
            ->take(8)
            ->get();

        // All active categories
        $categories = Category::withCount('publishedPhotos')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        // Featured services
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->take(6)
            ->get();

        // Testimonials
        $testimonials = Testimonial::where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('order')
            ->get();

        // Site settings
        $brandName = SiteSetting::get('brand_name', 'BECCA PHOTOGRAPHY');
        $tagline = SiteSetting::get('brand_tagline', 'Every Moment Deserves to Be Remembered.');
        $bio = SiteSetting::get('brand_bio');
        $contactEmail = SiteSetting::get('contact_email', 'SAVAGEXO@GMAIL.COM');
        $contactPhone = SiteSetting::get('contact_phone', '+234 812 345 6789');

        return view('pages.home', compact(
            'heroPhoto',
            'featuredPhotos',
            'categories',
            'services',
            'testimonials',
            'brandName',
            'tagline',
            'bio',
            'contactEmail',
            'contactPhone'
        ));
    }
}
