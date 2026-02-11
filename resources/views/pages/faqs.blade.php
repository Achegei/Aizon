@extends('layouts.app')

@section('content')
<section class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
    <div class="max-w-7xl mx-auto text-center mb-12">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 mb-4">
            Frequently Asked Questions
        </h1>
        <p class="text-gray-600 text-lg sm:text-xl max-w-3xl mx-auto">
            Everything you need to know about AIZON, our platform, and how we empower employers, creators, and innovators.
        </p>
    </div>

    <div class="max-w-4xl mx-auto space-y-6">

        {{-- FAQ Item --}}
        <div x-data="{ open: false }" class="bg-white rounded-3xl shadow-lg border border-gray-200 overflow-hidden">
            <button @click="open = !open" class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none">
                <span class="font-semibold text-gray-900 text-lg">What is AIZON?</span>
                <svg :class="{'rotate-180': open}" class="h-5 w-5 text-gray-500 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" x-collapse class="px-6 pb-6 text-gray-600">
                AIZON is a modern platform that connects employers with top talent, empowers creators to sell courses, 
                and allows innovators to showcase and monetize bespoke AI tools in our marketplace.
            </div>
        </div>

        <div x-data="{ open: false }" class="bg-white rounded-3xl shadow-lg border border-gray-200 overflow-hidden">
            <button @click="open = !open" class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none">
                <span class="font-semibold text-gray-900 text-lg">How can I post a job on AIZON?</span>
                <svg :class="{'rotate-180': open}" class="h-5 w-5 text-gray-500 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" x-collapse class="px-6 pb-6 text-gray-600">
                Employers can post jobs by creating an account and navigating to the 'Post a Job' section in their dashboard. 
                Simply fill in the job details, requirements, and publish — your posting will be visible to thousands of skilled candidates.
            </div>
        </div>

        <div x-data="{ open: false }" class="bg-white rounded-3xl shadow-lg border border-gray-200 overflow-hidden">
            <button @click="open = !open" class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none">
                <span class="font-semibold text-gray-900 text-lg">Can I sell my course or AI tool on AIZON?</span>
                <svg :class="{'rotate-180': open}" class="h-5 w-5 text-gray-500 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" x-collapse class="px-6 pb-6 text-gray-600">
                Yes! Creators can submit their courses and AI tools through their dashboard. Once approved, your listing will appear in the AIzon Marketplace 
                where employers and learners can access and purchase them.
            </div>
        </div>

        <div x-data="{ open: false }" class="bg-white rounded-3xl shadow-lg border border-gray-200 overflow-hidden">
            <button @click="open = !open" class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none">
                <span class="font-semibold text-gray-900 text-lg">How do I get paid for my courses or AI tools?</span>
                <svg :class="{'rotate-180': open}" class="h-5 w-5 text-gray-500 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" x-collapse class="px-6 pb-6 text-gray-600">
                Payouts are processed automatically to your account once a course or AI tool is purchased. 
                You can track your earnings in your dashboard in real-time and withdraw funds anytime.
            </div>
        </div>

        <div x-data="{ open: false }" class="bg-white rounded-3xl shadow-lg border border-gray-200 overflow-hidden">
            <button @click="open = !open" class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none">
                <span class="font-semibold text-gray-900 text-lg">Is AIZON safe and secure?</span>
                <svg :class="{'rotate-180': open}" class="h-5 w-5 text-gray-500 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" x-collapse class="px-6 pb-6 text-gray-600">
                Absolutely. AIZON uses industry-standard security protocols, encrypted payments, and robust data protection measures 
                to ensure all users, creators, and employers are safe on the platform.
            </div>
        </div>

    </div>
</section>
@endsection
