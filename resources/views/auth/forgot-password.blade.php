@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
<div class="max-w-md mx-auto mt-16 p-6 bg-white shadow-md rounded-md">
    <h2 class="text-2xl font-semibold mb-4">Reset Password</h2>

    @if(session('status'))
        <div class="mb-4 p-3 text-green-800 bg-green-100 rounded">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-700">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300">
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
            Send Reset Link
        </button>
    </form>

    <p class="mt-4 text-sm text-gray-500">
        Remembered your password? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
    </p>
</div>
@endsection
