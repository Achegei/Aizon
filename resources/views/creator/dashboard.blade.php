@extends('layouts.dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-4">Creator Dashboard</h1>
<p>Welcome back, {{ auth()->user()->name }}! Here’s your activity overview.</p>

<!-- Creator Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
    <div class="bg-white p-4 shadow rounded-lg">
        <h2 class="font-semibold text-lg">Tools Listed</h2>
        <p class="text-gray-500 mt-2">Total AI tools listed: 24</p>
    </div>
    <div class="bg-white p-4 shadow rounded-lg">
        <h2 class="font-semibold text-lg">Courses Created</h2>
        <p class="text-gray-500 mt-2">Total courses created: 10</p>
    </div>
    <div class="bg-white p-4 shadow rounded-lg">
        <h2 class="font-semibold text-lg">Earnings</h2>
        <p class="text-gray-500 mt-2">Total earnings: $1,250</p>
    </div>
</div>

<!-- Quick Links -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <a href="{{ route('creator.tools.index') }}" class="block bg-purple-600 text-white p-4 rounded-lg text-center hover:bg-purple-700 transition">
        Manage Tools
    </a>
    <a href="{{ route('creator.courses.index') }}" class="block bg-green-600 text-white p-4 rounded-lg text-center hover:bg-green-700 transition">
        Manage Courses
    </a>
    <a href="{{ route('creator.earnings.index') }}" class="block bg-blue-600 text-white p-4 rounded-lg text-center hover:bg-blue-700 transition">
        View Earnings
    </a>
</div>
@endsection
