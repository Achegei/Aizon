@extends('employer.layouts.app') <!-- or dashboard layout -->

@section('content')
<h1 class="text-2xl font-bold mb-4">My Jobs</h1>

@if($jobs->isEmpty())
    <p>No jobs posted yet.</p>
@else
    @foreach ($jobs as $job)
        <div class="border p-4 mb-2 rounded">
            <h2 class="font-bold">{{ $job->title }}</h2>
            <p>{{ $job->type }} — {{ $job->location ?? 'Location not specified' }}</p>
            <a href="{{ route('employer.jobs.edit', $job) }}" class="text-blue-600">Edit</a>
        </div>
    @endforeach
@endif
@endsection
