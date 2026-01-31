@extends('layouts.app')

@section('content')

<section class="py-20 md:py-32 text-center bg-gradient-to-r from-purple-700 to-indigo-700 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white">
        Hire AI Talent or Get Hired Globally
    </h1>
    <p class="mt-4 text-gray-200 max-w-3xl mx-auto">
        Post jobs or browse AI professionals ready to join your team.
    </p>
    <div class="mt-6 flex flex-col sm:flex-row justify-center gap-4 flex-wrap">
        <a href="#" class="px-6 py-3 bg-white text-purple-700 rounded-lg font-semibold shadow-lg hover:bg-gray-100 transition duration-300">
            Browse Jobs
        </a>
        <a href="#" class="px-6 py-3 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-500 transition duration-300">
            Post a Job
        </a>
    </div>
</section>

<section class="py-16 md:py-24 px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold mb-6 text-center">Job Listings</h2>
    <p class="text-gray-500 text-center max-w-2xl mx-auto">
        Placeholder for job cards. Real job listings will populate from database.
    </p>
</section>

@endsection
