@extends('employer.layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Application Details</h1>

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="font-semibold text-lg text-gray-800">{{ $application->job->title ?? 'Unknown Job' }}</h2>
        <p class="text-gray-500 text-sm mt-1">
            Applicant: {{ $application->user->name ?? 'Guest' }}<br>
            Email: {{ $application->user->email ?? $application->email }}<br>
            Applied: {{ $application->created_at->diffForHumans() }}
        </p>

        <h3 class="mt-4 font-semibold text-gray-700">Cover Letter:</h3>
        <p class="mt-1 text-gray-700">{{ $application->cover_letter ?? 'No cover letter provided' }}</p>

        @if($application->cv_path)
            <h3 class="mt-4 font-semibold text-gray-700">CV:</h3>
            <a href="{{ asset($application->cv_path) }}" target="_blank" class="text-blue-600 hover:underline">
                Download CV
            </a>
        @endif

        <p class="mt-4">
            <strong>Status:</strong> {{ $application->status ?? 'Pending' }}
        </p>

        <a href="{{ route('employer.applications.index') }}" class="mt-6 inline-block text-blue-600 hover:underline">
            ← Back to Applications
        </a>
    </div>
</div>
@endsection
