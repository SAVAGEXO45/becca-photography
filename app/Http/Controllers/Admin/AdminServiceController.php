<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminServiceController extends Controller
{
    public function index()
    {
        $services = Service::withCount('bookings')->orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $photos = Photo::where('is_published', true)->get();
        return view('admin.services.create', compact('photos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'description' => 'required|string|max:3000',
            'starting_price' => 'required|numeric|min:0',
            'price_label' => 'nullable|string|max:100',
            'duration' => 'nullable|string|max:100',
            'deliverables' => 'nullable|string|max:255',
            'turnaround_time' => 'nullable|string|max:100',
            'features_text' => 'nullable|string',
            'cover_image' => 'nullable|string',
            'is_popular' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $features = [];
        if (!empty($validated['features_text'])) {
            $features = array_values(array_filter(array_map('trim', explode("\n", $validated['features_text']))));
        }

        $slug = Str::slug($validated['name']);
        $originalSlug = $slug;
        $counter = 1;
        while (Service::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        Service::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'tagline' => $validated['tagline'] ?? null,
            'description' => $validated['description'],
            'starting_price' => $validated['starting_price'],
            'price_label' => $validated['price_label'] ?? 'Starting at',
            'duration' => $validated['duration'] ?? null,
            'deliverables' => $validated['deliverables'] ?? null,
            'turnaround_time' => $validated['turnaround_time'] ?? null,
            'features' => $features,
            'cover_image' => $validated['cover_image'] ?? null,
            'is_popular' => $request->boolean('is_popular'),
            'is_active' => $request->boolean('is_active', true),
            'order' => $validated['order'] ?? (Service::max('order') + 1),
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Photography service package created successfully.');
    }

    public function edit(Service $service)
    {
        $photos = Photo::where('is_published', true)->get();
        return view('admin.services.edit', compact('service', 'photos'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'description' => 'required|string|max:3000',
            'starting_price' => 'required|numeric|min:0',
            'price_label' => 'nullable|string|max:100',
            'duration' => 'nullable|string|max:100',
            'deliverables' => 'nullable|string|max:255',
            'turnaround_time' => 'nullable|string|max:100',
            'features_text' => 'nullable|string',
            'cover_image' => 'nullable|string',
            'is_popular' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $features = [];
        if (!empty($validated['features_text'])) {
            $features = array_values(array_filter(array_map('trim', explode("\n", $validated['features_text']))));
        }

        $service->update([
            'name' => $validated['name'],
            'tagline' => $validated['tagline'] ?? null,
            'description' => $validated['description'],
            'starting_price' => $validated['starting_price'],
            'price_label' => $validated['price_label'] ?? 'Starting at',
            'duration' => $validated['duration'] ?? null,
            'deliverables' => $validated['deliverables'] ?? null,
            'turnaround_time' => $validated['turnaround_time'] ?? null,
            'features' => $features,
            'cover_image' => $validated['cover_image'] ?? $service->cover_image,
            'is_popular' => $request->boolean('is_popular'),
            'is_active' => $request->boolean('is_active', true),
            'order' => $validated['order'] ?? $service->order,
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service details and pricing updated successfully.');
    }

    public function destroy(Service $service)
    {
        $name = $service->name;
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', "Service '{$name}' removed.");
    }
}
