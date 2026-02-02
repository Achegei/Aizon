@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Employer Jobs</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Title</th>
                <th class="border px-4 py-2">Employer</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jobs as $job)
                <tr>
                    <td class="border px-4 py-2">{{ $job->id }}</td>
                    <td class="border px-4 py-2">{{ $job->title }}</td>
                    <td class="border px-4 py-2">{{ $job->employer->name ?? 'Unknown' }}</td>
                    <td class="border px-4 py-2">
                        @if($job->is_active)
                            <span class="text-green-600 font-bold">Approved</span>
                        @else
                            <span class="text-red-600 font-bold">Pending</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2 flex gap-2">
                        @if(!$job->is_active)
                            <!-- Approve button for pending jobs -->
                            <form action="{{ route('admin.jobs.approve', $job->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">
                                    Approve
                                </button>
                            </form>
                        @else
                            <!-- Disapprove button for approved jobs -->
                            <form action="{{ route('admin.jobs.reject', $job->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded">
                                    Disapprove
                                </button>
                            </form>
                        @endif

                        <!-- Delete button -->
                        <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border px-4 py-2 text-center">No jobs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
