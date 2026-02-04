@extends('creator.layouts.app')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

    <h1 class="text-3xl font-extrabold mb-8 text-gray-900">
        Course Enrollments
    </h1>

    @if($enrollments->isEmpty())
        <div class="bg-white p-8 rounded-2xl shadow-sm text-gray-500 text-center">
            No enrollments yet for your courses.
        </div>
    @else
        <div class="overflow-x-auto bg-white rounded-2xl shadow ring-1 ring-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Student Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Course
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Enrolled On
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($enrollments as $enrollment)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $enrollment->user->name ?? 'Guest User' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $enrollment->user->email ?? '—' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $enrollment->course->title ?? 'Course deleted' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $enrollment->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
