<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApprovedMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->needsApproval()) {
            return response()
                ->view('auth.pending-approval', [], 403);
        }

        return $next($request);
    }
}
