@extends('layouts.auth')

@section('title', 'Verify Email')

@section('content')
<div class="max-w-md mx-auto mt-16 p-6 bg-white shadow-md rounded-md">
    <h2 class="text-2xl font-semibold mb-4">Verify Your Email</h2>

    @if(session('status'))
        <div class="mb-4 p-3 text-green-800 bg-green-100 rounded">
            {{ session('status') }}
        </div>
    @endif

    <p class="mb-4 text-gray-700">Please verify your email to continue.</p>

    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
            Resend Verification Email
        </button>
    </form>
</div>
@endsection
