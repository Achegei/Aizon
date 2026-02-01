<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

class CreatorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // ✅ correct enum comparison
        if ($user->role !== UserRole::CREATOR) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
