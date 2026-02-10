@extends('layouts.app')

@section('content')
<!-- Courses Grid -->
<section id="courses" class="py-16 md:py-24 px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 max-w-7xl mx-auto">
        @forelse($courses as $course)
            <div class="bg-white rounded-3xl shadow-xl hover:shadow-2xl transition border border-gray-200 flex flex-col justify-between p-6">
                
                {{-- Removed image --}}
                <h3 class="text-2xl font-bold text-gray-900">{{ $course->title }}</h3>
                <p class="text-gray-500 mt-1 text-sm">
                    By {{ optional($course->creator)->name ?? 'Unknown Instructor' }}
                </p>
                <p class="text-gray-600 mt-2 text-sm">{{ \Illuminate\Support\Str::limit($course->description, 120) }}</p>
                <p class="text-gray-400 mt-2 text-xs">
                    🕒 Created {{ $course->created_at->diffForHumans() }}
                </p>

                <div class="mt-6 flex justify-between gap-2">
                    <a href="{{ route('public.courses.show', $course->slug) }}"
                       class="px-5 py-2 bg-gray-100 text-gray-800 rounded-xl hover:bg-gray-200 font-semibold transition shadow">
                        View Details
                    </a>

                    <a href="{{ route('public.courses.show', $course->slug) }}#enroll"
                       class="px-5 py-2 bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-xl hover:from-purple-600 hover:to-indigo-600 font-semibold transition shadow">
                        Enroll
                    </a>
                </div>
            </div>
        @empty
            <p class="text-gray-400 col-span-3 text-center text-lg">
                No approved courses available yet.
            </p>
        @endforelse
    </div>
</section>

<!-- Hero Section -->
<section class="py-20 md:py-32 text-center bg-gradient-to-r from-purple-600 to-indigo-500 px-4 sm:px-6 lg:px-8 rounded-b-3xl shadow-lg">
    <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white">
        Explore Our AI Courses
    </h1>
    <p class="mt-4 text-white/90 max-w-3xl mx-auto text-lg sm:text-xl">
        Learn AI skills from beginner to advanced. Browse courses created by expert instructors.
    </p>
    <a href="{{ route('public.courses.index') }}"
       class="mt-8 px-8 py-4 bg-white text-purple-600 font-semibold rounded-xl shadow-lg hover:shadow-xl transition duration-300 inline-block">
        Browse Courses
    </a>
</section>

@endsection
