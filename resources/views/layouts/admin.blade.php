<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Console') | BECCA PHOTOGRAPHY</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-serif-luxury { font-family: 'Cormorant Garamond', Georgia, serif; }
        .font-sans-clean { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
    </style>
</head>
<body class="bg-[#0e0f12] text-[#dcd9d2] font-sans-clean antialiased min-h-screen flex" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen"
         x-cloak
         @click="sidebarOpen = false"
         class="fixed inset-0 z-40 bg-black/70 backdrop-blur-sm lg:hidden"></div>

    <!-- Sidebar Navigation -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
           class="fixed lg:static top-0 bottom-0 left-0 z-50 w-64 bg-[#141519] border-r border-white/10 flex flex-col justify-between transition-transform duration-300 ease-in-out shrink-0">
        <div>
            <!-- Admin Header / Brand -->
            <div class="h-20 px-6 flex items-center justify-between border-b border-white/10">
                <a href="{{ route('admin.dashboard') }}" class="flex flex-col">
                    <span class="font-serif-luxury text-xl tracking-[0.2em] uppercase text-white font-light">
                        BECCA
                    </span>
                    <span class="text-[9px] tracking-[0.3em] uppercase text-[#c5a880] -mt-1">
                        Admin Atelier
                    </span>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-white/50 hover:text-white">
                    &times;
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1.5 text-xs tracking-wider uppercase">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center px-4 py-3 rounded text-sm transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#c5a880]/10 text-[#c5a880] font-medium border-l-2 border-[#c5a880]' : 'text-[#9c9991] hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.bookings.index') }}"
                   class="flex items-center justify-between px-4 py-3 rounded text-sm transition-colors {{ request()->routeIs('admin.bookings.*') ? 'bg-[#c5a880]/10 text-[#c5a880] font-medium border-l-2 border-[#c5a880]' : 'text-[#9c9991] hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Bookings</span>
                    </div>
                    @php $pendingCount = \App\Models\Booking::where('status', 'pending')->count(); @endphp
                    @if($pendingCount > 0)
                        <span class="px-2 py-0.5 text-[10px] bg-amber-500/20 text-amber-400 font-semibold rounded-full border border-amber-500/30">
                            {{ $pendingCount }}
                        </span>
                    @endif
                </a>

                <a href="{{ route('admin.photos.index') }}"
                   class="flex items-center px-4 py-3 rounded text-sm transition-colors {{ request()->routeIs('admin.photos.*') ? 'bg-[#c5a880]/10 text-[#c5a880] font-medium border-l-2 border-[#c5a880]' : 'text-[#9c9991] hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Photographs</span>
                </a>

                <a href="{{ route('admin.categories.index') }}"
                   class="flex items-center px-4 py-3 rounded text-sm transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-[#c5a880]/10 text-[#c5a880] font-medium border-l-2 border-[#c5a880]' : 'text-[#9c9991] hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <span>Categories</span>
                </a>

                <a href="{{ route('admin.services.index') }}"
                   class="flex items-center px-4 py-3 rounded text-sm transition-colors {{ request()->routeIs('admin.services.*') ? 'bg-[#c5a880]/10 text-[#c5a880] font-medium border-l-2 border-[#c5a880]' : 'text-[#9c9991] hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Services & Pricing</span>
                </a>

                <a href="{{ route('admin.testimonials.index') }}"
                   class="flex items-center px-4 py-3 rounded text-sm transition-colors {{ request()->routeIs('admin.testimonials.*') ? 'bg-[#c5a880]/10 text-[#c5a880] font-medium border-l-2 border-[#c5a880]' : 'text-[#9c9991] hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                    <span>Testimonials</span>
                </a>

                <a href="{{ route('admin.messages.index') }}"
                   class="flex items-center justify-between px-4 py-3 rounded text-sm transition-colors {{ request()->routeIs('admin.messages.*') ? 'bg-[#c5a880]/10 text-[#c5a880] font-medium border-l-2 border-[#c5a880]' : 'text-[#9c9991] hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>Customer Inquiries</span>
                    </div>
                    @php $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
                    @if($unreadCount > 0)
                        <span class="px-2 py-0.5 text-[10px] bg-[#c5a880]/20 text-[#c5a880] font-semibold rounded-full border border-[#c5a880]/30">
                            {{ $unreadCount }}
                        </span>
                    @endif
                </a>

                <a href="{{ route('admin.settings.index') }}"
                   class="flex items-center px-4 py-3 rounded text-sm transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-[#c5a880]/10 text-[#c5a880] font-medium border-l-2 border-[#c5a880]' : 'text-[#9c9991] hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Studio Settings</span>
                </a>
            </nav>
        </div>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-white/10 space-y-3">
            <a href="{{ route('home') }}" target="_blank"
               class="flex items-center justify-center w-full py-2 px-3 text-xs uppercase tracking-wider text-[#cfccc4] border border-white/10 hover:border-[#c5a880] hover:text-white transition-colors">
                <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                <span>View Live Site</span>
            </a>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="flex items-center justify-center w-full py-2 px-3 text-xs uppercase tracking-wider text-rose-300 hover:bg-rose-500/10 transition-colors">
                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Sign Out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Top App Bar -->
        <header class="h-20 bg-[#121316] border-b border-white/10 px-6 lg:px-10 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center">
                <button @click="sidebarOpen = true" class="lg:hidden text-white mr-4 p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-lg font-medium text-white tracking-wide">
                    @yield('header_title', 'Management Overview')
                </h1>
            </div>

            <!-- User Info -->
            <div class="flex items-center space-x-4">
                <div class="text-right hidden sm:block">
                    <div class="text-xs font-semibold text-white">{{ Auth::user()->name ?? 'Administrator' }}</div>
                    <div class="text-[10px] text-[#c5a880] tracking-wider uppercase">Lead Director</div>
                </div>
                <div class="w-9 h-9 rounded-full bg-[#c5a880]/20 border border-[#c5a880]/40 flex items-center justify-center text-xs font-serif-luxury text-[#c5a880]">
                    BP
                </div>
            </div>
        </header>

        <!-- Flash Notifications in Admin -->
        <div class="px-6 lg:px-10 pt-6">
            @if(session('success'))
                <div class="bg-emerald-950/40 border border-emerald-500/30 text-emerald-200 px-5 py-3 text-sm flex items-center justify-between rounded mb-4">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white">&times;</button>
                </div>
            @endif

            @if(session('error') || $errors->any())
                <div class="bg-rose-950/40 border border-rose-500/30 text-rose-200 px-5 py-3 text-sm flex items-start justify-between rounded mb-4">
                    <div>
                        @if(session('error')) <div>{{ session('error') }}</div> @endif
                        @if($errors->any())
                            <ul class="list-disc list-inside mt-1 space-y-0.5 text-xs">
                                @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
                            </ul>
                        @endif
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-rose-400 hover:text-white">&times;</button>
                </div>
            @endif
        </div>

        <!-- Admin Page Slot -->
        <main class="flex-1 p-6 lg:p-10">
            @yield('content')
        </main>
    </div>

</body>
</html>
