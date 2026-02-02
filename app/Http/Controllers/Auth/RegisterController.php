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
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request.
     */
    public function register(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'role'     => 'required|in:creator,employer,buyer', // must match enum values
        ]);

        // Convert role string to enum
        $roleEnum = UserRole::from($validated['role']);

        // Determine if user should be auto-approved
        // Only buyers are auto-approved, creators/employers need admin approval
        $isApproved = $roleEnum === UserRole::BUYER ? true : false;

        // Create user
        $user = User::create([
            'name'        => $validated['name'],
            'email'       => $validated['email'],
            'password'    => Hash::make($validated['password']),
            'role'        => $roleEnum,    // enum cast will store the string value
            'is_active'   => true,         // allow login
            'is_approved' => $isApproved,  // admin approval logic
        ]);

        // Log in the user
        Auth::login($user);

        // Redirect based on role
        return match($user->role) {
            UserRole::CREATOR => redirect()->route('creator.dashboard'),
            UserRole::EMPLOYER => redirect()->route('employer.dashboard'),
            UserRole::BUYER => redirect()->route('buyer.dashboard'),
            UserRole::ADMIN, UserRole::SUPER_ADMIN, UserRole::STAFF => redirect()->route('admin.dashboard'),
            default => abort(403, 'Unauthorized'),
        };
    }
}
