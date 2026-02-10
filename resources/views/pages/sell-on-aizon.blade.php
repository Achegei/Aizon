@extends('layouts.app')

@section('content')

<section class="py-20 md:py-32 text-center bg-purple-700 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white">
        Monetize Your AI Skills — Join AIZON Marketplace
    </h1>
    <p class="mt-4 text-gray-200 max-w-3xl mx-auto">
        List AI tools, automations, prompts, mini-courses, and templates. Earn globally.
    </p>
    <a href="{{ route('register') }}" class="mt-6 px-6 py-3 bg-white text-purple-700 rounded-lg font-semibold shadow-lg hover:bg-gray-100 transition duration-300 inline-block">
        Become a Creator
    </a>
</section>

<section class="py-16 md:py-24 px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold mb-6 text-center">Creator Benefits</h2>
    <p class="text-gray-400 text-center max-w-2xl mx-auto">
        Placeholder for features and benefits. Later, we'll show real-time earnings, tools, and listings.
    </p>
</section>

@endsection
