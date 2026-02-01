<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            // Not logged in, redirect to login
            return redirect()->route('login');
        }

        // Only allow admin roles: super_admin, admin, staff
        if (!$user->isAdmin()) {
            // Logged in but not admin-level — show 403
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
