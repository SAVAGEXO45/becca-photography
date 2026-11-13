<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('warning', 'Please sign in to access the BECCA PHOTOGRAPHY administrative console.');
        }

        if (!Auth::user()->is_admin) {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Unauthorized access. Administrator privileges required.');
        }

        return $next($request);
    }
}
