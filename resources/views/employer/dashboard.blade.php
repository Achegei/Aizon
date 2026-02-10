@extends('employer.layouts.app')

@section('content')
@php
    // Get counts dynamically
    $jobsPostedCount = \App\Models\JobListing::where('employer_id', auth()->id())->count();
    $applicationsCount = \App\Models\JobApplication::whereHas('job', function ($query) {
        $query->where('employer_id', auth()->id());
    })->count();
@endphp

<div class="max-w-5xl mx-auto px-6 py-10">

    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight text-zinc-900">
            Employer Dashboard
        </h1>
        <p class="mt-2 text-sm text-zinc-500">
            Welcome back, {{ auth()->user()->name }}! Here's a quick overview of your job postings and applications.
        </p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl border border-zinc-200 p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-zinc-900">Jobs Posted</h2>
                <span class="bg-teal-50 text-teal-700 text-xs font-medium px-2 py-1 rounded-full">
                    {{ $jobsPostedCount }}
                </span>
            </div>
            <p class="mt-3 text-sm text-zinc-500">
                Total jobs you have posted on the platform.
            </p>
        </div>

        <div class="bg-white rounded-xl border border-zinc-200 p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-zinc-900">Applications</h2>
                <span class="bg-indigo-50 text-indigo-700 text-xs font-medium px-2 py-1 rounded-full">
                    {{ $applicationsCount }}
                </span>
            </div>
            <p class="mt-3 text-sm text-zinc-500">
                Total applications received from candidates for your job postings.
            </p>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-4">
        <a href="{{ route('employer.jobs.create') }}"
           class="block rounded-lg bg-gradient-to-r from-teal-600 to-emerald-600
                  px-6 py-4 text-white font-medium shadow hover:opacity-90 transition">
            ➕ Post a New Job
        </a>

        <a href="{{ route('employer.jobs.index') }}"
           class="block rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600
                  px-6 py-4 text-white font-medium shadow hover:opacity-90 transition">
            📋 View All Jobs
        </a>
    </div>

</div>
@endsection
