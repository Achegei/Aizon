<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function notice()
    {
        return view('auth.verify-email');
    }

    public function verify(Request $request)
    {
        // Stub: pretend email verified
        return redirect()->route('dashboard')->with('status', 'Email verified!');
    }

    public function resend(Request $request)
    {
        // Stub: flash a message
        return back()->with('status', 'Verification link sent!');
    }
}
