<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AdminTestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('order')->orderByDesc('id')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_role' => 'nullable|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'review_text' => 'required|string|max:2000',
            'rating' => 'required|integer|min:1|max:5',
            'project_type' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        Testimonial::create([
            'client_name' => $validated['client_name'],
            'client_role' => $validated['client_role'] ?? null,
            'client_company' => $validated['client_company'] ?? null,
            'review_text' => $validated['review_text'],
            'rating' => $validated['rating'],
            'project_type' => $validated['project_type'] ?? null,
            'is_featured' => $request->boolean('is_featured', true),
            'is_published' => $request->boolean('is_published', true),
            'order' => $validated['order'] ?? (Testimonial::max('order') + 1),
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_role' => 'nullable|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'review_text' => 'required|string|max:2000',
            'rating' => 'required|integer|min:1|max:5',
            'project_type' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $testimonial->update([
            'client_name' => $validated['client_name'],
            'client_role' => $validated['client_role'] ?? null,
            'client_company' => $validated['client_company'] ?? null,
            'review_text' => $validated['review_text'],
            'rating' => $validated['rating'],
            'project_type' => $validated['project_type'] ?? null,
            'is_featured' => $request->boolean('is_featured', true),
            'is_published' => $request->boolean('is_published', true),
            'order' => $validated['order'] ?? $testimonial->order,
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial removed.');
    }
}
