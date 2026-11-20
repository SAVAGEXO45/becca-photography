<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Sign In | BECCA PHOTOGRAPHY</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-serif-luxury { font-family: 'Cormorant Garamond', Georgia, serif; }
        .font-sans-clean { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
    </style>
</head>
<body class="bg-[#0b0c0e] text-[#e8e6e1] font-sans-clean min-h-screen flex items-center justify-center p-6 selection:bg-[#c5a880] selection:text-[#0b0c0e]">

    <div class="w-full max-w-md bg-[#141519] border border-white/10 p-8 sm:p-10 shadow-2xl space-y-8 relative">
        <!-- Brand Masthead -->
        <div class="text-center space-y-2">
            <a href="{{ route('home') }}" class="inline-block">
                <span class="font-serif-luxury text-2xl tracking-[0.25em] uppercase text-white font-light">
                    BECCA PHOTOGRAPHY
                </span>
            </a>
            <div class="text-[10px] tracking-[0.3em] uppercase text-[#c5a880]">
                Administrative Console
            </div>
        </div>

        <!-- Flash messages -->
        @if(session('warning'))
            <div class="p-3 bg-amber-500/10 border border-amber-500/30 text-amber-300 text-xs text-center">
                {{ session('warning') }}
            </div>
        @endif

        @if(session('error'))
            <div class="p-3 bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs text-center">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="p-3 bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs">
                @foreach($errors->all() as $err)
                    <p>{{ $err }}</p>
                @endforeach
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-xs uppercase tracking-wider text-[#cfccc4] mb-2">Administrator Email</label>
                <input type="email"
                       id="email"
                       name="email"
                       value="{{ old('email', 'admin@beccaphotography.com') }}"
                       required
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white placeholder-stone-600 focus:outline-none focus:border-[#c5a880]">
            </div>

            <div>
                <div class="flex items-center justify-between mb-2">
                    <label for="password" class="text-xs uppercase tracking-wider text-[#cfccc4]">Password</label>
                </div>
                <input type="password"
                       id="password"
                       name="password"
                       required
                       class="w-full bg-[#0f1013] border border-white/10 px-4 py-3 text-sm text-white placeholder-stone-600 focus:outline-none focus:border-[#c5a880]">
            </div>

            <div class="flex items-center justify-between text-xs text-[#807e78]">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="bg-[#0f1013] border-white/20 text-[#c5a880] focus:ring-0">
                    <span>Keep session active</span>
                </label>
            </div>

            <button type="submit"
                    class="w-full py-3.5 bg-[#c5a880] text-[#0f1013] text-xs uppercase tracking-[0.2em] font-medium hover:bg-[#d8be97] transition-colors shadow-lg">
                Authenticate to Console
            </button>
        </form>

        <div class="pt-4 border-t border-white/5 text-center text-xs text-[#807e78] space-y-1">
            <div class="pt-2">
                <a href="{{ route('home') }}" class="text-[#cfccc4] hover:text-white transition-colors">&larr; Return to Public Website</a>
            </div>
        </div>
    </div>

</body>
</html>
