@extends('employer.layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Employer Dashboard</h1>
<p>Welcome back, {{ auth()->user()->name }}! Here’s your job posting overview.</p>

<!-- Example employer stats cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
    <div class="bg-white p-4 shadow rounded-lg">
        <h2 class="font-semibold text-lg">Jobs Posted</h2>
        <p class="text-gray-500 mt-2">Total jobs posted: 12</p>
    </div>
    <div class="bg-white p-4 shadow rounded-lg">
        <h2 class="font-semibold text-lg">Applications</h2>
        <p class="text-gray-500 mt-2">Total applications received: 58</p>
    </div>
</div>
@endsection
