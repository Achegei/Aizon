@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto p-6">
    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $course->title }}</h1>
            <p class="text-gray-600 mt-1">By {{ $course->creator->name ?? 'Unknown Creator' }}</p>
        </div>

        <div class="flex flex-wrap gap-2">
            {{-- Back to Courses --}}
            <a href="{{ route('admin.courses.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600 transition font-semibold">
                ← Back to Courses
            </a>

            {{-- Approve / Disapprove --}}
            @if(!$course->is_approved)
                <form action="{{ route('admin.courses.approve', $course->slug) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" 
                            class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700 transition font-semibold">
                        Approve Course
                    </button>
                </form>
            @else
                <form action="{{ route('admin.courses.disapprove', $course->slug) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" 
                            class="bg-yellow-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-600 transition font-semibold">
                        Disapprove Course
                    </button>
                </form>
            @endif

            {{-- Delete --}}
            <form action="{{ route('admin.courses.destroy', $course->slug) }}" method="POST" 
                  onsubmit="return confirm('Are you sure you want to delete this course?');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700 transition font-semibold">
                    Delete
                </button>
            </form>
        </div>
    </div>

    {{-- Course Description --}}
    <section class="py-12 px-4 sm:px-6 lg:px-8 bg-gray-100 rounded-xl shadow mb-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Course Description</h2>
        <p class="text-gray-700 whitespace-pre-line">{{ $course->description }}</p>
    </section>
</div>
@endsection
