<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|in:creator,employer,buyer', // lowercase
        ]);

        $roleEnum = UserRole::from($validated['role']); // ensures consistent enum usage

        $user = User::create([
            'name' => $validated['name'],
            'email'=> $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $roleEnum->value,
            'is_active' => true,
        ]);

        Auth::login($user);

        // Role-based redirect
        if ($user->role === 'creator') {
            return redirect()->route('creator.dashboard');
        } elseif ($user->role === 'employer') {
            return redirect()->route('employer.dashboard');
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // fallback
        abort(403, 'Unauthorized');
    }
}
