@extends('employer.layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Job Applications</h1>

    @if($applications->isEmpty())
        <p class="text-gray-500">No applications received yet.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($applications as $application)
                <div class="bg-white rounded-xl shadow p-4 hover:shadow-lg transition duration-200">
                    <h2 class="font-semibold text-lg text-gray-800">
                        {{ optional($application->job)->title ?? 'Unknown Job' }}
                    </h2>

                    <p class="text-gray-500 text-sm mt-1">
                        Applicant: {{ optional($application->user)->name ?? 'Guest' }}<br>
                        Email: {{ optional($application->user)->email ?? $application->email ?? 'N/A' }}<br>
                        Applied: {{ $application->created_at->diffForHumans() }}
                    </p>

                    <p class="mt-2 text-gray-700">
                        {{ \Illuminate\Support\Str::limit($application->cover_letter_text ?? 'No cover letter provided', 100) }}
                    </p>

                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ route('employer.applications.show', $application) }}"
                           class="text-blue-600 font-medium hover:underline">
                            View Details
                        </a>
                        <span class="text-sm text-gray-400">
                            {{ ucfirst($application->status ?? 'pending') }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
