<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $featuredPhotos = Photo::where('is_published', true)->take(4)->get();

        return view('pages.services', compact('services', 'featuredPhotos'));
    }

    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $otherServices = Service::where('id', '!=', $service->id)->where('is_active', true)->take(3)->get();

        return view('pages.service-show', compact('service', 'otherServices'));
    }
}
