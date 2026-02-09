@extends('layouts.app')

@section('content')

<section class="py-20 md:py-32 text-center bg-gradient-to-r from-purple-700 to-indigo-700 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white">
        Explore Thousands of AI Tools
    </h1>
    <p class="mt-4 text-gray-200 max-w-3xl mx-auto">
        Find AI solutions for workflow, automation, marketing, customer support, and more.
    </p>
    <a href="#tools" class="mt-6 px-6 py-3 bg-white text-purple-700 rounded-lg font-semibold shadow-lg hover:bg-gray-100 transition duration-300 inline-block">
        Browse Tools
    </a>
</section>

<section id="tools" class="py-16 md:py-24 px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold mb-6 text-center">Popular AI Tools</h2>
    <p class="text-gray-500 text-center max-w-2xl mx-auto mb-8">
        Discover AI tools approved and ready to use.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach(\App\Models\Tool::where('is_active', true)->latest()->get() as $tool)
            <x-cards.tool-card :tool="$tool"/>
        @endforeach
    </div>
</section>

@endsection
