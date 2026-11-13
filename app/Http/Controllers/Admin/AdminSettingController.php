<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $fields = [
            'brand_name',
            'brand_tagline',
            'brand_bio',
            'contact_email',
            'contact_phone',
            'studio_address',
            'opening_hours',
            'instagram',
            'twitter',
            'pinterest',
            'photographer_name',
            'photographer_title',
            'philosophy',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                SiteSetting::set($field, $request->input($field));
            }
        }

        return back()->with('success', 'Studio configuration and brand settings updated.');
    }
}
