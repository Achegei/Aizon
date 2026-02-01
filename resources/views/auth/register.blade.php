@extends('layouts.auth')

@section('content')
<div class="auth-left">
    <div class="mb-6 text-center">
        <a href="{{ route('home') }}" class="text-3xl font-bold text-indigo-600">Aizon</a>
    </div>

    <h2 class="text-2xl font-bold mb-6 text-center">Create Account</h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Full Name -->
        <div>
            <label for="name" class="block font-semibold mb-1">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required autofocus>
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block font-semibold mb-1">Password</label>
            <input id="password" type="password" name="password"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block font-semibold mb-1">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <!-- Role -->
        <div>
            <label for="role" class="block font-semibold mb-1">Role</label>
            <select name="role" required>
                <option value="">Select Role</option>
                <option value="creator">CREATOR</option>
                <option value="employer">EMPLOYER</option>
                <option value="buyer">BUYER</option>
            </select>

            @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition-colors">
                Register
            </button>
        </div>
    </form>

    <p class="text-center mt-4 text-sm text-gray-600">
        Already have an account? 
        <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Login</a>
    </p>
</div>
@endsection
