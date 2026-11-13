@extends('layouts.admin')

@section('title', 'Studio Settings')
@section('header_title', 'Studio & Brand Settings')

@section('content')

<div class="max-w-4xl bg-[#141519] border border-white/5 p-8 rounded shadow-2xl">
    <div class="mb-8 pb-6 border-b border-white/10">
        <h2 class="font-serif-luxury text-2xl text-white font-light">
            Brand Identity & Coordinates
        </h2>
        <p class="text-xs text-[#807e78] mt-1">
            Configure studio contact channels, editorial masthead details, and philosophy text.
        </p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
        @csrf

        <!-- Section 1: Brand Identity -->
        <div class="space-y-4">
            <h3 class="text-xs font-semibold uppercase tracking-wider text-[#c5a880]">Brand Identity</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="brand_name" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Brand Name *</label>
                    <input type="text"
                           id="brand_name"
                           name="brand_name"
                           value="{{ old('brand_name', $settings['brand_name'] ?? 'BECCA PHOTOGRAPHY') }}"
                           required
                           class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
                </div>

                <div>
                    <label for="brand_tagline" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Brand Tagline *</label>
                    <input type="text"
                           id="brand_tagline"
                           name="brand_tagline"
                           value="{{ old('brand_tagline', $settings['brand_tagline'] ?? 'Every Moment Deserves to Be Remembered.') }}"
                           required
                           class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
                </div>
            </div>

            <div>
                <label for="brand_bio" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Brand Introduction Bio</label>
                <textarea id="brand_bio"
                          name="brand_bio"
                          rows="3"
                          class="w-full bg-[#0f1013] border border-white/10 p-4 text-sm text-white focus:outline-none focus:border-[#c5a880]">{{ old('brand_bio', $settings['brand_bio'] ?? '') }}</textarea>
            </div>
        </div>

        <!-- Section 2: Contact Channels -->
        <div class="space-y-4 pt-6 border-t border-white/10">
            <h3 class="text-xs font-semibold uppercase tracking-wider text-[#c5a880]">Contact Coordinates</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="contact_email" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Studio Primary Email *</label>
                    <input type="email"
                           id="contact_email"
                           name="contact_email"
                           value="{{ old('contact_email', $settings['contact_email'] ?? 'SAVAGEXO@GMAIL.COM') }}"
                           required
                           class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
                </div>

                <div>
                    <label for="contact_phone" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Studio Phone / WhatsApp *</label>
                    <input type="text"
                           id="contact_phone"
                           name="contact_phone"
                           value="{{ old('contact_phone', $settings['contact_phone'] ?? '+234 812 345 6789') }}"
                           required
                           class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="studio_address" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Physical Studio Address</label>
                    <input type="text"
                           id="studio_address"
                           name="studio_address"
                           value="{{ old('studio_address', $settings['studio_address'] ?? 'The Foundry Studio, 14 Victoria Island Arts District, Lagos') }}"
                           class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
                </div>

                <div>
                    <label for="opening_hours" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Studio Hours</label>
                    <input type="text"
                           id="opening_hours"
                           name="opening_hours"
                           value="{{ old('opening_hours', $settings['opening_hours'] ?? 'Tuesday – Sunday: 9:00 AM – 6:30 PM') }}"
                           class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
                </div>
            </div>
        </div>

        <!-- Section 3: Social & Photographer Info -->
        <div class="space-y-4 pt-6 border-t border-white/10">
            <h3 class="text-xs font-semibold uppercase tracking-wider text-[#c5a880]">Social Channels & Artist Info</h3>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label for="instagram" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Instagram Handle</label>
                    <input type="text"
                           id="instagram"
                           name="instagram"
                           value="{{ old('instagram', $settings['instagram'] ?? '@beccaphotography') }}"
                           class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
                </div>

                <div>
                    <label for="twitter" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Twitter / X Handle</label>
                    <input type="text"
                           id="twitter"
                           name="twitter"
                           value="{{ old('twitter', $settings['twitter'] ?? '@beccaphotos') }}"
                           class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
                </div>

                <div>
                    <label for="pinterest" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Pinterest Handle</label>
                    <input type="text"
                           id="pinterest"
                           name="pinterest"
                           value="{{ old('pinterest', $settings['pinterest'] ?? '@beccaphotography') }}"
                           class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="photographer_name" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Lead Photographer Name</label>
                    <input type="text"
                           id="photographer_name"
                           name="photographer_name"
                           value="{{ old('photographer_name', $settings['photographer_name'] ?? 'Becca') }}"
                           class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
                </div>

                <div>
                    <label for="photographer_title" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Artist Title</label>
                    <input type="text"
                           id="photographer_title"
                           name="photographer_title"
                           value="{{ old('photographer_title', $settings['photographer_title'] ?? 'Founder & Lead Visual Artist') }}"
                           class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:border-[#c5a880]">
                </div>
            </div>

            <div>
                <label for="philosophy" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Artistic Philosophy Statement</label>
                <textarea id="philosophy"
                          name="philosophy"
                          rows="3"
                          class="w-full bg-[#0f1013] border border-white/10 p-4 text-sm text-white focus:outline-none focus:border-[#c5a880]">{{ old('philosophy', $settings['philosophy'] ?? '') }}</textarea>
            </div>
        </div>

        <div class="pt-6 border-t border-white/10 flex justify-end">
            <button type="submit"
                    class="px-8 py-3.5 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-[0.2em] font-medium hover:bg-[#d8be97] transition-colors shadow-lg">
                Save All Settings
            </button>
        </div>
    </form>
</div>

@endsection
