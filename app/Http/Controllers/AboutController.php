<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\SiteSetting;

class AboutController extends Controller
{
    public function index()
    {
        $portraitPhoto = Photo::where('slug', 'aura-in-white')->first()
            ?? Photo::where('is_published', true)->first();

        $detailPhoto = Photo::where('slug', 'the-art-of-detail')->first()
            ?? Photo::where('aspect_ratio', 'landscape')->first();

        $architecturalPhoto = Photo::where('slug', 'brutalist-serenity')->first()
            ?? Photo::where('is_published', true)->skip(1)->first();

        $philosophy = SiteSetting::get('philosophy');
        $bio = SiteSetting::get('brand_bio');

        return view('pages.about', compact('portraitPhoto', 'detailPhoto', 'architecturalPhoto', 'philosophy', 'bio'));
    }
}
