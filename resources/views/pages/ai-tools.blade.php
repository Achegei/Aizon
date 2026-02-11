@extends('layouts.app')

@section('content')
<section id="tools" class="relative py-20 md:py-28 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-white via-gray-50 to-white">

    {{-- Soft ambient glow (very subtle, premium feel) --}}
    <div class="absolute inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-indigo-100 rounded-full blur-3xl opacity-30"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-purple-100 rounded-full blur-3xl opacity-30"></div>
    </div>

    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold tracking-tight text-gray-900 mb-6 text-center">
        Popular AI Tools
    </h2>

    <p class="text-gray-500 text-center max-w-2xl mx-auto mb-14 text-lg leading-relaxed">
        Discover AI tools approved and ready to use.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach(\App\Models\Tool::where('is_active', true)->latest()->get() as $tool)
            <x-cards.tool-card :tool="$tool"/>
        @endforeach
    </div>

</section>
@endsection
