<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategorySlug = $request->query('category');

        $categories = Category::withCount('publishedPhotos')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $query = Photo::with('category')->where('is_published', true);

        if ($selectedCategorySlug && $selectedCategorySlug !== 'all') {
            $query->whereHas('category', function ($q) use ($selectedCategorySlug) {
                $q->where('slug', $selectedCategorySlug);
            });
        }

        $photos = $query->orderBy('display_order')->orderByDesc('id')->get();

        $photosJson = $photos->map(fn($p) => [
            'url' => $p->url,
            'title' => $p->title,
            'category' => $p->category->name ?? 'Editorial',
            'gear' => $p->camera_gear ?? 'Sony Alpha GM',
            'location' => $p->location ?? 'Lagos Studio',
        ])->values();

        return view('pages.portfolio', compact('photos', 'categories', 'selectedCategorySlug', 'photosJson'));
    }

    public function show(string $slug)
    {
        $photo = Photo::with('category')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Get adjacent photos for navigation
        $previousPhoto = Photo::where('is_published', true)
            ->where('id', '<', $photo->id)
            ->orderByDesc('id')
            ->first() ?? Photo::where('is_published', true)->orderByDesc('id')->first();

        $nextPhoto = Photo::where('is_published', true)
            ->where('id', '>', $photo->id)
            ->orderBy('id')
            ->first() ?? Photo::where('is_published', true)->orderBy('id')->first();

        // Related photos from same category
        $relatedPhotos = Photo::where('is_published', true)
            ->where('id', '!=', $photo->id)
            ->where('category_id', $photo->category_id)
            ->take(3)
            ->get();

        return view('pages.portfolio-show', compact('photo', 'previousPhoto', 'nextPhoto', 'relatedPhotos'));
    }
}
