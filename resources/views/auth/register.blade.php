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
        <div class="bg-purple-50 border border-purple-300 rounded-lg p-4">
            <label for="role" class="block font-semibold mb-2 text-purple-800">
                Choose Your Role
            </label>

            <select
                name="role"
                required
                class="w-full rounded-md border-2 border-purple-400 bg-white px-4 py-3 
                    text-gray-800 font-semibold
                    focus:border-purple-600 focus:ring-2 focus:ring-purple-300
                    transition duration-200"
            >
                <option value="" class="text-gray-400">— Select Role —</option>
                <option value="creator">Creator (Sell tools & courses)</option>
                <option value="employer">Employer (Post jobs & hire)</option>
                <option value="member">Member (Buy tools, courses & Apply for Jobs)</option>
            </select>

            @error('role')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
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
