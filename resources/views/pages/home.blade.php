@extends('layouts.app')

@section('content')

{{-- HERO SECTION --}}
<section class="py-20 md:py-32 text-center bg-gradient-to-r from-purple-700 to-indigo-700 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-snug md:leading-tight">
        All AI in One Marketplace.<br>
        Tools. Automations. Courses. Jobs.
    </h1>
    <p class="mt-4 sm:mt-6 text-lg sm:text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto">
        AIZON Market is the world’s first unified AI ecosystem —
        where businesses buy AI tools, creators earn globally,
        learners master AI skills, and employers hire AI talent.
    </p>
    <div class="mt-6 md:mt-10 flex flex-col sm:flex-row justify-center gap-4 flex-wrap">
        <a href="#" class="px-6 py-3 bg-white text-purple-700 rounded-lg font-semibold shadow-lg hover:bg-gray-100 transition duration-300">Explore AI Tools</a>
        <a href="#" class="px-6 py-3 border border-white text-white rounded-lg font-semibold hover:bg-white hover:text-purple-700 transition duration-300">Hire AI Talent</a>
        <a href="#" class="px-6 py-3 border border-white text-white rounded-lg font-semibold hover:bg-white hover:text-purple-700 transition duration-300">Enroll in AI Courses</a>
        <a href="#" class="px-6 py-3 border border-white text-white rounded-lg font-semibold hover:bg-white hover:text-purple-700 transition duration-300">Post AI Jobs</a>
    </div>
</section>

{{-- WHY AIZON --}}
<section class="py-16 md:py-24 bg-gray-900 text-center px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl sm:text-4xl md:text-5xl font-semibold text-white mb-4 md:mb-6">The Entire AI World — in One Marketplace</h2>
    <p class="text-gray-300 max-w-2xl mx-auto text-base sm:text-lg md:text-xl">
        AIZON Market is built for businesses, developers, AI creators, job seekers, employers, students, and entrepreneurs.  
        Four integrated marketplaces — One platform: AI Tools, Courses, Jobs, and Talent.
    </p>
</section>

{{-- AI TOOLS --}}
<section class="py-16 md:py-24 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto text-center">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold mb-4 md:mb-6">Instant AI Solutions for Any Business</h2>
        <p class="text-gray-500 mb-6 md:mb-8 text-sm sm:text-base md:text-lg">Explore thousands of AI tools and automations for your workflow, sales, customer support, and industry-specific needs.</p>
        <a href="#" class="px-6 py-3 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-500 transition duration-300">Browse AI Tools</a>
    </div>
</section>

{{-- AI COURSES --}}
<section class="py-16 md:py-24 bg-gray-900 text-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-white mb-4 md:mb-6">AI Skills for Everyone. Beginner to Advanced</h2>
        <p class="text-gray-300 mb-6 md:mb-8 text-sm sm:text-base md:text-lg">Learn AI concepts, workflows, prompt engineering, building agents, and industry-specific courses from anywhere in the world.</p>
        <a href="#" class="px-6 py-3 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-500 transition duration-300">Explore AI Courses</a>
    </div>
</section>

{{-- AI JOBS --}}
<section class="py-16 md:py-24 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto text-center">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold mb-4 md:mb-6">Hire AI Talent or Get Hired — Globally</h2>
        <p class="text-gray-500 mb-6 md:mb-8 text-sm sm:text-base md:text-lg">Post jobs, find certified AI professionals, create profiles, and showcase skills to employers and recruiters.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4 flex-wrap">
            <a href="#" class="px-6 py-3 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-500 transition duration-300">Find AI Jobs</a>
            <a href="#" class="px-6 py-3 border border-gray-600 text-gray-800 sm:text-white rounded-lg font-semibold hover:bg-purple-600 hover:text-white transition duration-300">Post a Job</a>
        </div>
    </div>
</section>

{{-- SELL YOUR AI TOOLS (CREATORS) --}}
<section class="py-16 md:py-24 bg-gray-900 text-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-white mb-4 md:mb-6">Monetize Your AI Skills. Earn Worldwide</h2>
        <p class="text-gray-300 mb-6 md:mb-8 text-sm sm:text-base md:text-lg">Creators can list AI tools, automations, prompts, mini-courses, and templates. Marketplace takes a 10–20% commission.</p>
        <a href="#" class="px-6 py-3 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-500 transition duration-300">Become a Creator</a>
    </div>
</section>

{{-- INDUSTRIES SERVED --}}
<section class="py-16 md:py-24 text-center px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold mb-6">Industries AIZON Market Serves</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 max-w-6xl mx-auto">
        @foreach(['Real Estate','Retail','Education','Finance','Healthcare','Hospitality','E-commerce','NGOs','Small Businesses','Startups','Enterprises'] as $industry)
            <div class="px-4 py-3 border border-gray-600 rounded-lg text-gray-200 hover:bg-purple-700 hover:text-white transition duration-300 text-sm sm:text-base md:text-base">{{ $industry }}</div>
        @endforeach
    </div>
</section>

{{-- TRUST & SAFETY --}}
<section class="py-16 md:py-24 bg-gray-900 text-center px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-white mb-6">Trust & Safety</h2>
    <div class="max-w-4xl mx-auto text-gray-300 space-y-4 text-sm sm:text-base md:text-lg">
        <p>Secure payment systems</p>
        <p>Creator verification</p>
        <p>Quality-tested AI tools</p>
        <p>Course certification system</p>
        <p>Job posting review</p>
    </div>
</section>

{{-- FINAL CTA --}}
<section class="py-20 md:py-32 text-center bg-gradient-to-r from-purple-600 to-indigo-600 px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white leading-snug md:leading-tight">Your AI Journey Starts in One Place — AIZON Market</h2>
    <div class="mt-6 md:mt-8 flex flex-col sm:flex-row justify-center gap-4 flex-wrap">
        <a href="#" class="px-6 py-3 bg-black text-white rounded-lg font-semibold hover:bg-gray-800 transition duration-300">Explore AI Tools</a>
        <a href="#" class="px-6 py-3 bg-black text-white rounded-lg font-semibold hover:bg-gray-800 transition duration-300">Hire AI Talent</a>
    </div>
</section>

@endsection
