@extends('layouts.app')

@section('content')
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold">{{ $tool->title }}</h1>
        <p class="text-gray-600 mt-2">{{ $tool->category?->name ?? 'Uncategorized' }}</p>
        @if($tool->price > 0)
            <span class="text-purple-700 font-semibold text-lg mt-1 inline-block">
                {{ $tool->formattedPrice() }}
            </span>
        @else
            <span class="text-green-600 font-semibold text-lg mt-1 inline-block">Free</span>
        @endif
    </div>

    <div class="flex flex-col md:flex-row gap-8">
        <div class="md:w-1/2">
            @if($tool->thumbnail)
                <img src="{{ asset('storage/' . $tool->thumbnail) }}" alt="{{ $tool->title }}" class="rounded-lg shadow-lg w-full">
            @endif
        </div>
        <div class="md:w-1/2">
            <h2 class="text-2xl font-semibold mb-4">Description</h2>
            <p class="text-gray-700 mb-6">{{ $tool->description }}</p>

            {{-- Fixed route --}}
            <form method="POST" action="{{ route('tools.request', $tool->slug) }}" class="w-full">
                @csrf
                <button
                    type="submit"
                    class="w-full px-6 py-3 bg-indigo-600 text-white font-semibold rounded-2xl shadow-md hover:bg-indigo-700 transition-all duration-300"
                >
                    Get This Tool
                </button>
            </form>

        </div>
    </div>
</section>
@endsection
