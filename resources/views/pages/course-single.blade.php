@extends('layouts.app')

@section('content')

<!-- Success Message -->
@if(session('success'))
    <div class="max-w-5xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg shadow-md">
            {{ session('success') }}
        </div>
    </div>
@endif

<!-- Hero Section -->
<section class="py-20 md:py-32 text-center bg-gradient-to-r from-purple-600 to-indigo-500 px-4 sm:px-6 lg:px-8 rounded-b-3xl shadow-lg">
    <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white">
        {{ $course->title }}
    </h1>

    <p class="mt-4 text-white/90 max-w-3xl mx-auto whitespace-pre-line text-lg sm:text-xl">
        {{ $course->description }}
    </p>

    <p class="mt-2 text-white/70 text-sm">
        By {{ optional($course->creator)->name ?? 'Unknown Instructor' }}
    </p>

    <a href="#enroll" 
       class="mt-8 px-8 py-4 bg-white text-purple-600 font-semibold rounded-xl shadow-lg hover:shadow-xl transition duration-300 inline-block">
        Enroll Now
    </a>
</section>

<!-- Course Details & Enrollment Form -->
<section id="enroll" class="py-16 md:py-24 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
    <div class="bg-white rounded-3xl shadow-xl p-10">
        <h2 class="text-3xl font-bold mb-6 text-gray-900">Course Details</h2>

        <div class="text-gray-700 leading-relaxed space-y-4 text-lg">
            {!! nl2br(e($course->content ?? $course->description)) !!}
        </div>

        <!-- Enrollment Form -->
        <div class="mt-12 bg-gray-50 p-8 rounded-2xl shadow-lg">
            <h3 class="text-2xl font-bold mb-6 text-gray-900">Enroll in {{ $course->title }}</h3>

            <form method="POST" action="{{ route('courses.enroll', $course->slug) }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" required
                           class="w-full px-5 py-3 border border-gray-300 text-gray-900 rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none transition">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}" required
                           class="w-full px-5 py-3 border border-gray-300 text-gray-900 rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none transition">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="px-6 py-3 bg-purple-600 text-white font-semibold rounded-xl shadow-lg hover:bg-purple-700 hover:shadow-xl transition duration-300">
                        Enroll Now
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
