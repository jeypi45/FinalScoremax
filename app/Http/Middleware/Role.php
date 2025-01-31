<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            // Redirect unauthenticated users to login
            return redirect()->route('login');
        }

        if (Auth::user()->usertype !== $role) {
            // Prevent looping by sending to a specific error page or dashboard
            return redirect(Auth::user()->usertype === 'admin' ? '/admin/dashboard' : '/dashboard')->with('error', 'Unauthorized access!');
        }

        return $next($request);
    }
}
