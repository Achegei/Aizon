@extends('employer.layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-10">

    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight text-zinc-900">My Jobs</h1>
        <p class="mt-2 text-sm text-zinc-500">
            Manage your job postings and keep track of applications.
        </p>
    </div>

    {{-- Jobs List --}}
    @if($jobs->isEmpty())
        <div class="bg-white border border-zinc-200 rounded-xl p-6 shadow-sm text-zinc-500">
            You haven't posted any jobs yet.
        </div>
    @else
        <div class="grid gap-6">
            @foreach ($jobs as $job)
                <div class="bg-white rounded-xl border border-zinc-200 p-6 shadow-sm hover:shadow-md transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-semibold text-zinc-900">{{ $job->title }}</h2>
                            <p class="text-sm text-zinc-500 mt-1">
                                {{ $job->type }} — {{ $job->location ?? 'Location not specified' }}
                            </p>
                        </div>
                        <a href="{{ route('employer.jobs.edit', $job) }}"
                           class="text-indigo-600 font-medium hover:underline">
                           ✏️ Edit
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Quick Action --}}
    <div class="mt-8">
        <a href="{{ route('employer.jobs.create') }}"
           class="inline-block bg-gradient-to-r from-teal-600 to-emerald-600 text-white font-medium px-6 py-3 rounded-lg shadow hover:opacity-90 transition">
           ➕ Post a New Job
        </a>
    </div>

</div>
@endsection
