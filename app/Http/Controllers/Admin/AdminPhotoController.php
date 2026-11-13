<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminPhotoController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->query('category_id');
        $query = Photo::with('category');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $photos = $query->orderBy('display_order')->orderByDesc('id')->paginate(12)->withQueryString();
        $categories = Category::orderBy('order')->get();

        return view('admin.photos.index', compact('photos', 'categories', 'categoryId'));
    }

    public function create()
    {
        $categories = Category::orderBy('order')->get();
        return view('admin.photos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2000',
            'client_name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'camera_gear' => 'nullable|string|max:255',
            'shoot_date' => 'nullable|date',
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:15360',
            'is_featured' => 'nullable|boolean',
            'is_hero' => 'nullable|boolean',
            'display_order' => 'nullable|integer',
        ]);

        $file = $request->file('photo');
        $extension = $file->getClientOriginalExtension();
        $filename = 'photo-' . Str::slug($validated['title']) . '-' . time() . '.' . $extension;

        // Save to public storage
        $destinationPath = storage_path('app/public/photos');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }
        $file->move($destinationPath, $filename);

        // Also copy to public/storage/photos for direct static asset serving
        $pubPath = public_path('storage/photos');
        if (!File::exists($pubPath)) {
            File::makeDirectory($pubPath, 0755, true);
        }
        File::copy($destinationPath . '/' . $filename, $pubPath . '/' . $filename);

        // Calculate aspect ratio and dimensions
        $imageSize = @getimagesize($destinationPath . '/' . $filename);
        $dimensions = null;
        $aspectRatio = 'portrait';
        if ($imageSize) {
            $width = $imageSize[0];
            $height = $imageSize[1];
            $dimensions = "{$width} x {$height}";
            if ($width > $height * 1.15) {
                $aspectRatio = 'landscape';
            } elseif ($height > $width * 1.15) {
                $aspectRatio = 'portrait';
            } else {
                $aspectRatio = 'square';
            }
        }

        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $counter = 1;
        while (Photo::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        // If marked as hero, un-hero other photos
        if ($request->boolean('is_hero')) {
            Photo::where('is_hero', true)->update(['is_hero' => false]);
        }

        Photo::create([
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'slug' => $slug,
            'subtitle' => $validated['subtitle'] ?? null,
            'description' => $validated['description'] ?? null,
            'image_path' => $filename,
            'aspect_ratio' => $aspectRatio,
            'dimensions' => $dimensions,
            'client_name' => $validated['client_name'] ?? null,
            'location' => $validated['location'] ?? null,
            'camera_gear' => $validated['camera_gear'] ?? null,
            'shoot_date' => $validated['shoot_date'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'is_hero' => $request->boolean('is_hero'),
            'display_order' => $validated['display_order'] ?? (Photo::max('display_order') + 1),
            'is_published' => true,
        ]);

        return redirect()->route('admin.photos.index')->with('success', 'Photograph uploaded and published successfully.');
    }

    public function edit(Photo $photo)
    {
        $categories = Category::orderBy('order')->get();
        return view('admin.photos.edit', compact('photo', 'categories'));
    }

    public function update(Request $request, Photo $photo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2000',
            'client_name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'camera_gear' => 'nullable|string|max:255',
            'shoot_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15360',
            'is_featured' => 'nullable|boolean',
            'is_hero' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'display_order' => 'nullable|integer',
        ]);

        $updates = [
            'title' => $validated['title'],
            'category_id' => $validated['category_id'],
            'subtitle' => $validated['subtitle'] ?? null,
            'description' => $validated['description'] ?? null,
            'client_name' => $validated['client_name'] ?? null,
            'location' => $validated['location'] ?? null,
            'camera_gear' => $validated['camera_gear'] ?? null,
            'shoot_date' => $validated['shoot_date'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'is_hero' => $request->boolean('is_hero'),
            'is_published' => $request->boolean('is_published', true),
            'display_order' => $validated['display_order'] ?? $photo->display_order,
        ];

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = 'photo-' . Str::slug($validated['title']) . '-' . time() . '.' . $extension;

            $dest = storage_path('app/public/photos');
            $file->move($dest, $filename);

            $pubPath = public_path('storage/photos');
            File::copy($dest . '/' . $filename, $pubPath . '/' . $filename);

            $imageSize = @getimagesize($dest . '/' . $filename);
            if ($imageSize) {
                $width = $imageSize[0];
                $height = $imageSize[1];
                $updates['dimensions'] = "{$width} x {$height}";
                $updates['aspect_ratio'] = ($width > $height * 1.15) ? 'landscape' : (($height > $width * 1.15) ? 'portrait' : 'square');
            }

            $updates['image_path'] = $filename;
        }

        if ($request->boolean('is_hero')) {
            Photo::where('id', '!=', $photo->id)->where('is_hero', true)->update(['is_hero' => false]);
        }

        $photo->update($updates);

        return redirect()->route('admin.photos.index')->with('success', 'Photograph details updated successfully.');
    }

    public function destroy(Photo $photo)
    {
        $title = $photo->title;
        $photo->delete();

        return redirect()->route('admin.photos.index')->with('success', "Photograph '{$title}' removed from portfolio.");
    }
}
