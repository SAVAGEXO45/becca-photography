<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'BECCA PHOTOGRAPHY | Editorial & Fine Art Photography')</title>
    <meta name="description" content="@yield('meta_description', 'BECCA PHOTOGRAPHY — Editorial fashion, iconic portraiture, and timeless visual storytelling crafted with authentic human emotion and artistic precision.')">

    <!-- Fonts: Cormorant Garamond & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-serif-luxury {
            font-family: 'Cormorant Garamond', Georgia, serif;
        }
        .font-sans-clean {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }
    </style>
</head>
<body class="bg-[#0f1013] text-[#e8e6e1] font-sans-clean antialiased selection:bg-[#c5a880] selection:text-[#0f1013] min-h-screen flex flex-col justify-between"
      x-data="lightboxManager()"
      @keydown.escape.window="closeLightbox()"
      @keydown.arrow-left.window="prevPhoto()"
      @keydown.arrow-right.window="nextPhoto()"
      @open-lightbox.window="openLightbox($event.detail)">

    <!-- Top Announcement / Brand Strip -->
    <div class="border-b border-white/5 bg-[#0b0c0e] py-2 px-6 text-xs text-[#a09e99] tracking-widest uppercase flex justify-between items-center hidden sm:flex">
        <span>Studio & Location Sessions · Lagos & Worldwide</span>
        <div class="flex items-center space-x-6">
            <span>Inquiries: <a href="mailto:SAVAGEXO@GMAIL.COM" class="text-[#c5a880] hover:underline">SAVAGEXO@GMAIL.COM</a></span>
            <span class="text-white/20">|</span>
            <a href="{{ route('booking.track') }}" class="text-[#a09e99] hover:text-white transition-colors">Track Booking</a>
        </div>
    </div>

    <!-- Header Navigation -->
    <header class="sticky top-0 z-40 backdrop-blur-md bg-[#0f1013]/90 border-b border-white/10 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 h-20 flex items-center justify-between">
            <!-- Brand Text Logo -->
            <a href="{{ route('home') }}" class="group flex flex-col">
                <span class="font-serif-luxury text-2xl lg:text-3xl tracking-[0.22em] uppercase font-light text-white group-hover:text-[#c5a880] transition-colors">
                    BECCA PHOTOGRAPHY
                </span>
                <span class="text-[9px] tracking-[0.38em] text-[#8e8c85] uppercase -mt-1 font-sans-clean">
                    Visual Atelier & Editorial
                </span>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden md:flex items-center space-x-8 text-xs tracking-[0.18em] uppercase text-[#cfccc4]">
                <a href="{{ route('home') }}" class="hover:text-[#c5a880] transition-colors {{ request()->routeIs('home') ? 'text-[#c5a880]' : '' }}">
                    Home
                </a>
                <a href="{{ route('about') }}" class="hover:text-[#c5a880] transition-colors {{ request()->routeIs('about') ? 'text-[#c5a880]' : '' }}">
                    About
                </a>
                <a href="{{ route('portfolio.index') }}" class="hover:text-[#c5a880] transition-colors {{ request()->routeIs('portfolio.*') ? 'text-[#c5a880]' : '' }}">
                    Portfolio
                </a>
                <a href="{{ route('services.index') }}" class="hover:text-[#c5a880] transition-colors {{ request()->routeIs('services.*') ? 'text-[#c5a880]' : '' }}">
                    Services
                </a>
                <a href="{{ route('contact') }}" class="hover:text-[#c5a880] transition-colors {{ request()->routeIs('contact') ? 'text-[#c5a880]' : '' }}">
                    Contact
                </a>
            </nav>

            <!-- CTA Action -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('booking.create') }}"
                   class="inline-flex items-center px-6 py-2.5 text-xs uppercase tracking-[0.2em] font-medium text-[#0f1013] bg-[#c5a880] hover:bg-[#d8be97] transition-all duration-300 shadow-sm hover:shadow-[#c5a880]/20">
                    Book a Session
                </a>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <div class="flex items-center space-x-4 md:hidden" x-data="{ mobileOpen: false }">
                <a href="{{ route('booking.create') }}" class="text-xs uppercase tracking-widest text-[#c5a880] px-3 py-1.5 border border-[#c5a880]/30">
                    Book
                </a>
                <button @click="mobileOpen = !mobileOpen" class="text-white p-2 focus:outline-none" aria-label="Toggle Navigation">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Mobile Menu Dropdown -->
                <div x-show="mobileOpen"
                     x-cloak
                     @click.away="mobileOpen = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="absolute top-20 left-0 w-full bg-[#121316] border-b border-white/10 p-6 shadow-2xl flex flex-col space-y-4">
                    <a href="{{ route('home') }}" class="text-sm tracking-widest uppercase hover:text-[#c5a880]">Home</a>
                    <a href="{{ route('about') }}" class="text-sm tracking-widest uppercase hover:text-[#c5a880]">About</a>
                    <a href="{{ route('portfolio.index') }}" class="text-sm tracking-widest uppercase hover:text-[#c5a880]">Portfolio</a>
                    <a href="{{ route('services.index') }}" class="text-sm tracking-widest uppercase hover:text-[#c5a880]">Services</a>
                    <a href="{{ route('contact') }}" class="text-sm tracking-widest uppercase hover:text-[#c5a880]">Contact</a>
                    <a href="{{ route('booking.track') }}" class="text-sm tracking-widest uppercase text-[#8e8c85] hover:text-[#c5a880]">Track Booking</a>
                    <div class="pt-2">
                        <a href="{{ route('booking.create') }}" class="block text-center py-3 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-widest font-medium">
                            Book a Session
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Flash Notifications -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-6 lg:px-12 mt-6">
            <div class="bg-[#18261e] border border-emerald-500/30 text-emerald-200 px-6 py-4 flex items-center justify-between text-sm">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white">&times;</button>
            </div>
        </div>
    @endif

    @if(session('error') || $errors->any())
        <div class="max-w-7xl mx-auto px-6 lg:px-12 mt-6">
            <div class="bg-[#2a171a] border border-rose-500/30 text-rose-200 px-6 py-4 flex items-start justify-between text-sm">
                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 text-rose-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <div>
                        @if(session('error'))
                            <p>{{ session('error') }}</p>
                        @endif
                        @if($errors->any())
                            <ul class="list-disc list-inside mt-1 space-y-1 text-xs">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-400 hover:text-white">&times;</button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Editorial Lightbox Modal (Alpine.js) -->
    <div x-show="isOpen"
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/95 backdrop-blur-md p-4 sm:p-8"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">

        <!-- Close Button -->
        <button @click="closeLightbox()"
                class="absolute top-6 right-6 text-white/70 hover:text-white p-3 z-50 text-2xl transition-colors focus:outline-none"
                aria-label="Close Lightbox">
            &times;
        </button>

        <!-- Navigation: Prev -->
        <button @click="prevPhoto()"
                class="absolute left-4 sm:left-8 top-1/2 -translate-y-1/2 text-white/50 hover:text-white p-3 z-50 transition-colors focus:outline-none bg-black/40 hover:bg-black/80 rounded-full"
                aria-label="Previous Image">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <!-- Navigation: Next -->
        <button @click="nextPhoto()"
                class="absolute right-4 sm:right-8 top-1/2 -translate-y-1/2 text-white/50 hover:text-white p-3 z-50 transition-colors focus:outline-none bg-black/40 hover:bg-black/80 rounded-full"
                aria-label="Next Image">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Lightbox Body -->
        <div class="relative max-w-6xl max-h-[90vh] flex flex-col items-center justify-center" @click.away="closeLightbox()">
            <img :src="currentPhoto.url"
                 :alt="currentPhoto.title"
                 class="max-h-[75vh] max-w-[90vw] object-contain shadow-2xl transition-all duration-300">

            <!-- Caption / Metadata -->
            <div class="mt-4 text-center text-sm text-[#e8e6e1] space-y-1">
                <h3 class="font-serif-luxury text-xl lg:text-2xl tracking-wide text-white" x-text="currentPhoto.title"></h3>
                <div class="flex items-center justify-center space-x-3 text-xs text-[#a09e99] tracking-wider uppercase">
                    <span x-text="currentPhoto.category"></span>
                    <span class="text-white/20">·</span>
                    <span x-text="currentPhoto.gear"></span>
                    <template x-if="currentPhoto.location">
                        <span class="flex items-center space-x-2">
                            <span class="text-white/20">·</span>
                            <span x-text="currentPhoto.location"></span>
                        </span>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <!-- Editorial Footer -->
    <footer class="bg-[#0b0c0e] border-t border-white/10 text-[#a09e99] pt-16 pb-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 pb-16 border-b border-white/10">
                <!-- Col 1: Brand Masthead -->
                <div class="md:col-span-5 space-y-4">
                    <a href="{{ route('home') }}" class="inline-block">
                        <span class="font-serif-luxury text-2xl lg:text-3xl tracking-[0.22em] uppercase font-light text-white">
                            BECCA PHOTOGRAPHY
                        </span>
                    </a>
                    <p class="text-sm font-light text-[#8e8c85] leading-relaxed max-w-md">
                        "Every Moment Deserves to Be Remembered." An editorial and fine art visual atelier based in Lagos, documenting human truth, luxury streetwear, and timeless personal presence.
                    </p>
                    <div class="pt-2 text-xs text-[#c5a880] tracking-widest uppercase">
                        Available for select assignments worldwide
                    </div>
                </div>

                <!-- Col 2: Navigation Links -->
                <div class="md:col-span-3 space-y-3">
                    <h4 class="text-xs font-semibold uppercase tracking-[0.25em] text-white">Explore</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('portfolio.index') }}" class="hover:text-white transition-colors">Portfolio Archive</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-white transition-colors">Services & Packages</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">About the Artist</a></li>
                        <li><a href="{{ route('booking.create') }}" class="hover:text-white transition-colors">Book a Session</a></li>
                        <li><a href="{{ route('booking.track') }}" class="hover:text-white transition-colors">Track Your Booking</a></li>
                    </ul>
                </div>

                <!-- Col 3: Direct Studio Contact -->
                <div class="md:col-span-4 space-y-3">
                    <h4 class="text-xs font-semibold uppercase tracking-[0.25em] text-white">Studio Inquiries</h4>
                    <ul class="space-y-2 text-sm text-[#8e8c85]">
                        <li>
                            <span class="text-white block text-xs uppercase tracking-wider">Email</span>
                            <a href="mailto:SAVAGEXO@GMAIL.COM" class="text-[#c5a880] hover:underline">SAVAGEXO@GMAIL.COM</a>
                        </li>
                        <li>
                            <span class="text-white block text-xs uppercase tracking-wider">Studio Phone</span>
                            <span>+234 812 345 6789</span>
                        </li>
                        <li>
                            <span class="text-white block text-xs uppercase tracking-wider">Studio Location</span>
                            <span>The Foundry Studio, 14 Victoria Island Arts District, Lagos</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Subfooter -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-[#6e6c66] space-y-4 sm:space-y-0">
                <div>
                    &copy; {{ date('Y') }} BECCA PHOTOGRAPHY. All rights reserved. Photographs and artistic works protected.
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contact</a>
                    <span>·</span>
                    <a href="{{ route('admin.login') }}" class="hover:text-[#c5a880] transition-colors">Admin Console</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Lightbox Script -->
    <script>
        function lightboxManager() {
            return {
                isOpen: false,
                currentIndex: 0,
                galleryPhotos: [],
                currentPhoto: { url: '', title: '', category: '', gear: '', location: '' },

                openLightbox(data) {
                    if (data.photos && data.photos.length) {
                        this.galleryPhotos = data.photos;
                        this.currentIndex = data.index || 0;
                        this.currentPhoto = this.galleryPhotos[this.currentIndex];
                    } else {
                        this.currentPhoto = {
                            url: data.url || data.src,
                            title: data.title || '',
                            category: data.category || '',
                            gear: data.gear || '',
                            location: data.location || ''
                        };
                    }
                    this.isOpen = true;
                    document.body.classList.add('overflow-hidden');
                },

                closeLightbox() {
                    this.isOpen = false;
                    document.body.classList.remove('overflow-hidden');
                },

                nextPhoto() {
                    if (this.galleryPhotos.length > 1) {
                        this.currentIndex = (this.currentIndex + 1) % this.galleryPhotos.length;
                        this.currentPhoto = this.galleryPhotos[this.currentIndex];
                    }
                },

                prevPhoto() {
                    if (this.galleryPhotos.length > 1) {
                        this.currentIndex = (this.currentIndex - 1 + this.galleryPhotos.length) % this.galleryPhotos.length;
                        this.currentPhoto = this.galleryPhotos[this.currentIndex];
                    }
                }
            };
        }
    </script>
</body>
</html>
