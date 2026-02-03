@extends('layouts.app')

@section('content')
<section class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-50">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Available AI Jobs</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($jobs as $job)
                {{-- Make sure the component path matches: resources/views/components/cards/job-card.blade.php --}}
                <x-cards.job-card :job="$job" />
            @empty
                <p class="col-span-3 text-gray-500 text-center text-lg">No jobs available at the moment.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
