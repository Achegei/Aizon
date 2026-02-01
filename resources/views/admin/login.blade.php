@extends('layouts.auth')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white shadow rounded">
    <h1 class="text-2xl font-bold mb-4">Admin Login</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <div class="mb-4">
            <label class="block font-medium">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label class="block font-medium">Password:</label>
            <input type="password" name="password" required
                class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="remember" class="mr-2">
                Remember Me
            </label>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Login
        </button>
    </form>
</div>
@endsection
