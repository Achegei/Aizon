<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Usage in routes: ->middleware('role:admin,creator')
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Super admin bypass (settings is already an array)
        if (!empty($user->settings['is_super_admin']) && $user->settings['is_super_admin'] === true) {
            return $next($request);
        }

        $allowedRoles = explode(',', $roles);

        if (!in_array($user->role, $allowedRoles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
