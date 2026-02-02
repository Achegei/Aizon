@extends('layouts.auth')

@section('title', 'Account Pending Approval')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="max-w-md w-full bg-white rounded-xl shadow-md p-8 text-center">

        <div class="flex justify-center mb-6">
            <div class="h-16 w-16 flex items-center justify-center rounded-full bg-yellow-100 text-yellow-600 text-3xl">
                ⏳
            </div>
        </div>

        <h1 class="text-2xl font-bold text-gray-800 mb-3">
            Account Pending Approval
        </h1>

        <p class="text-gray-600 mb-5">
            Hi <span class="font-semibold">{{ auth()->user()->name }}</span>,  
            your account was created successfully but is waiting for admin approval.
        </p>

        <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-md p-4 text-sm mb-6">
            Once approved, you’ll gain full access to your dashboard and features.
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                type="submit"
                class="w-full px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-900 transition">
                Logout
            </button>
        </form>

        <p class="mt-4 text-sm text-gray-500">
            Need help?
            <a href="mailto:support@yourdomain.com" class="underline hover:text-gray-700">
                Contact support
            </a>
        </p>
    </div>
</div>
@endsection
