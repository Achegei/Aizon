@extends('layouts.app')

@section('content')
<section class="relative bg-gray-50 py-20 md:py-32 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto text-center">

        {{-- Page Heading --}}
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-gray-900 mb-6">
            About AIZON
        </h1>
        <p class="text-gray-600 text-lg sm:text-xl max-w-3xl mx-auto leading-relaxed mb-12">
            At AIZON, we empower businesses, creators, and innovators to thrive in the AI-driven world. 
            Founded with the vision of bridging talent, learning, and tools, we provide a platform where 
            employers can hire top tech talent, creators can sell their courses, and developers can share 
            bespoke AI tools with the global market.
        </p>

        {{-- Core Mission Section --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left max-w-6xl mx-auto mb-16">
            <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-200 hover:shadow-2xl transition duration-300">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">For Employers</h2>
                <p class="text-gray-600">
                    Post jobs, discover top-tier talent, and scale your tech team with ease. 
                    AIZON connects you with skilled developers and AI professionals ready to deliver results.
                </p>
            </div>
            <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-200 hover:shadow-2xl transition duration-300">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">For Creators</h2>
                <p class="text-gray-600">
                    Monetize your expertise by creating and selling courses. Reach learners worldwide, 
                    grow your community, and share knowledge in a trusted, modern platform.
                </p>
            </div>
            <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-200 hover:shadow-2xl transition duration-300">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">AIzon Marketplace</h2>
                <p class="text-gray-600">
                    Showcase bespoke AI tools and solutions in our marketplace. 
                    Developers and innovators can reach businesses looking for cutting-edge AI technology 
                    to accelerate their operations.
                </p>
            </div>
        </div>

        {{-- Story / Why AIZON --}}
        <div class="max-w-4xl mx-auto text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Story</h2>
            <p class="text-gray-600 text-lg leading-relaxed">
                AIZON was built for the new era of work and learning — where talent, knowledge, and technology converge. 
                From our early days helping companies hire software developers to enabling creators and AI innovators 
                to showcase their work, we’ve always been about connecting opportunity with impact. 
                Today, our platform continues to evolve, offering seamless experiences for employers, creators, 
                and tech enthusiasts worldwide.
            </p>
        </div>

        {{-- Call-to-Action --}}
        <div class="text-center">
            <a href="{{ route('public.jobs.index') }}"
               class="inline-block px-8 py-4 bg-gradient-to-r from-purple-500 to-indigo-500 text-white font-semibold rounded-xl shadow-lg hover:from-purple-600 hover:to-indigo-600 transition duration-300">
               Explore Opportunities
            </a>
        </div>
    </div>
</section>
@endsection
