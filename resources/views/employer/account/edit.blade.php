@extends('employer.layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-2xl shadow-md">
    <h1 class="text-2xl font-bold mb-6">Account Settings</h1>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('employer.account.update') }}" class="space-y-6">
        @csrf

        <div>
            <label class="block font-semibold mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                class="w-full border border-zinc-200 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
        </div>

        <div>
            <label class="block font-semibold mb-1">New Password</label>
            <input type="password" name="password"
                class="w-full border border-zinc-200 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
        </div>

        <div>
            <label class="block font-semibold mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation"
                class="w-full border border-zinc-200 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
        </div>

        <button type="submit"
            class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold py-3 rounded-xl shadow-lg hover:opacity-90 transition">
            Update Profile
        </button>
    </form>
</div>
@endsection
