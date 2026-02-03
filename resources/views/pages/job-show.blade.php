@extends('layouts.app')

@section('content')
<section x-data="{ open: false }" class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen relative">

    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-2xl border border-gray-200 p-8 sm:p-10">

        {{-- Job Header --}}
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $job->title }}</h1>
                <p class="text-gray-500 mb-1">Company: {{ $job->employer->name ?? 'Unknown Employer' }}</p>
                <p class="text-gray-400 text-sm">{{ $job->location ?? 'Remote' }} • {{ ucfirst($job->type ?? 'Full-time') }}</p>
            </div>

            <div class="flex-shrink-0">
                {{-- Apply Now Button --}}
                <button @click="open = true"
                        class="px-6 py-3 bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-lg hover:from-purple-600 hover:to-indigo-600 font-semibold transition w-full sm:w-auto">
                    Apply Now
                </button>
            </div>
        </div>

        {{-- Salary Info --}}
        @if($job->salary_min && $job->salary_max)
            <p class="text-gray-500 mb-6 font-medium">Salary: ${{ $job->salary_min }} - ${{ $job->salary_max }}</p>
        @endif

        {{-- Job Description --}}
        <h2 class="text-xl font-semibold mb-2 text-gray-900">Job Description</h2>
        <p class="text-gray-700 whitespace-pre-line mb-6">{{ $job->description }}</p>

        {{-- Back to Jobs --}}
        <a href="{{ route('public.jobs.index') }}" 
           class="inline-block px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 font-semibold transition">
           Back to Jobs
        </a>
    </div>

    {{-- Slide-in Panel --}}
    <div 
        x-show="open"
        x-cloak
        x-transition:enter="transition transform duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition transform duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed top-0 right-0 h-full w-full sm:max-w-md bg-white shadow-2xl z-50 overflow-y-auto border-l border-gray-200"
    >
        <div class="p-6 sm:p-8 flex flex-col h-full">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Apply for {{ $job->title }}</h2>
                <button @click="open = false" class="text-gray-500 hover:text-gray-700 font-bold text-xl">&times;</button>
            </div>

            <form method="POST" action="{{ route('jobs.apply', $job->id) }}" enctype="multipart/form-data" class="space-y-4 flex-1 flex flex-col">
                @csrf

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" required
                           class="w-full px-4 py-2 border border-purple-300 rounded-lg focus:ring focus:ring-purple-300 focus:outline-none text-gray-900 bg-white">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Email</label>
                    <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}" required
                           class="w-full px-4 py-2 border border-purple-300 rounded-lg focus:ring focus:ring-purple-300 focus:outline-none text-gray-900 bg-white">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Cover Letter</label>
                    <textarea name="cover_letter" rows="4" required
                              class="w-full px-4 py-2 border border-purple-300 rounded-lg focus:ring focus:ring-purple-300 focus:outline-none text-gray-900 bg-white"></textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Attach CV</label>
                    <input type="file" name="cv" accept=".pdf,.doc,.docx"
                           class="w-full px-3 py-2 border border-purple-300 rounded-lg text-gray-900 bg-white">
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" @click="open = false"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-semibold transition">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-lg hover:from-purple-600 hover:to-indigo-600 font-semibold transition">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>

</section>
@endsection
