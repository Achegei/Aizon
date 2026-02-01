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

    $allowedRoles = explode(',', $roles);

    // 🔥 FIX: compare enum value
    if (!in_array($user->role->value, $allowedRoles)) {
        abort(403, 'Unauthorized');
    }

    return $next($request);
}

}
