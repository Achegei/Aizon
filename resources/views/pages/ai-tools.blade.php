@extends('layouts.app')

@section('content')
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
