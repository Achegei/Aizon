@extends('layouts.app')

@section('content')
<section class="relative py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-white via-gray-50 to-white">

    {{-- Soft Background Glow --}}
    <div class="absolute inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-indigo-100 rounded-full blur-3xl opacity-40"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-purple-100 rounded-full blur-3xl opacity-40"></div>
    </div>

    <div class="max-w-6xl mx-auto">

        {{-- Header --}}
        <div class="mb-12 text-center">
            <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-gray-900">
                Explore AI Opportunities
            </h1>
            <p class="mt-4 text-lg text-gray-500 max-w-2xl mx-auto">
                Discover high-quality AI roles from innovative companies building the future.
            </p>
        </div>

        {{-- Jobs Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($jobs as $job)
                <x-cards.job-card :job="$job" />
            @empty
                <div class="col-span-3 bg-white/70 backdrop-blur border border-gray-200 rounded-2xl p-10 text-center shadow-sm">
                    <p class="text-gray-500 text-lg">
                        No jobs available at the moment.
                    </p>
                </div>
            @endforelse
        </div>

    </div>
</section>
@endsection
