@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto p-6">
    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Creator Courses</h1>
        <p class="text-gray-600 mt-1">Review courses submitted by creators and manage approvals.</p>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 mb-6 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- Courses Table --}}
    <div class="overflow-x-auto bg-white rounded-xl shadow border border-gray-200">
        <table class="w-full min-w-max table-auto divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr class="text-left text-gray-600 uppercase text-sm tracking-wide">
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Title</th>
                    <th class="px-6 py-3">Creator</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($courses as $course)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3 font-mono text-gray-700">{{ $course->id }}</td>
                        <td class="px-6 py-3 font-medium text-gray-900">{{ $course->title }}</td>
                        <td class="px-6 py-3 text-gray-700">{{ $course->creator->name ?? 'Unknown' }}</td>
                        <td class="px-6 py-3">
                            @if($course->is_active && $course->is_approved)
                                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                    Approved
                                </span>
                            @elseif($course->is_active && !$course->is_approved)
                                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending Admin Approval
                                </span>
                            @else
                                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-3 flex flex-wrap gap-2">
                            {{-- View Course --}}
                            <a href="{{ route('admin.courses.show', $course->slug) }}" 
                               class="bg-blue-600 text-white px-3 py-1 rounded shadow hover:bg-blue-700 transition font-semibold text-sm">
                                View
                            </a>

                            {{-- Approve / Disapprove --}}
                            @if(!$course->is_approved)
                                <form action="{{ route('admin.courses.approve', $course->slug) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="bg-green-600 text-white px-3 py-1 rounded shadow hover:bg-green-700 transition font-semibold text-sm">
                                        Approve
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.courses.disapprove', $course->slug) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="bg-yellow-500 text-white px-3 py-1 rounded shadow hover:bg-yellow-600 transition font-semibold text-sm">
                                        Disapprove
                                    </button>
                                </form>
                            @endif

                            {{-- Delete Course --}}
                            <form action="{{ route('admin.courses.destroy', $course->slug) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this course?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded shadow hover:bg-red-700 transition font-semibold text-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            No courses submitted by creators yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
