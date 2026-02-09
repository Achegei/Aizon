@props(['tool'])

<div x-data="{ open: false }" class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 ease-in-out border border-gray-200 flex flex-col justify-between p-6">

    {{-- Tool Info --}}
    <div>
        <img src="{{ $tool->thumbnail_url ?? 'https://via.placeholder.com/400x200' }}" alt="{{ $tool->title }}" class="rounded-lg mb-4">
        <h3 class="text-2xl font-bold text-gray-900">{{ $tool->title }}</h3>
        <p class="text-gray-500 mt-1 text-sm">By {{ $tool->creator->name ?? 'Unknown' }}</p>
        <p class="text-gray-400 mt-2 text-sm">{{ Str::limit($tool->description, 120) }}</p>
        <p class="text-gray-400 mt-2 text-xs">🕒 Added {{ $tool->created_at->diffForHumans() }}</p>
        @if($tool->price)
            <p class="text-gray-700 mt-2 font-semibold">💰 ${{ number_format($tool->price, 2) }}</p>
        @else
            <p class="text-gray-700 mt-2 font-semibold">Free</p>
        @endif
    </div>

    {{-- Buttons --}}
    <div class="mt-4 flex justify-between gap-2">
        <button @click="open = true"
                class="px-5 py-2 bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-lg hover:from-purple-600 hover:to-indigo-600 font-semibold transition duration-200 shadow-md hover:shadow-lg">
            Get Tool
        </button>
        <a href="{{ route('public.tools.show', $tool->slug) }}"
           class="px-5 py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 font-semibold transition duration-200">
           Details
        </a>
    </div>

    {{-- Slide-in Modal --}}
    <div x-show="open" x-cloak
         x-transition:enter="transition transform ease-out duration-300"
         x-transition:enter-start="translate-x-full opacity-0"
         x-transition:enter-end="translate-x-0 opacity-100"
         x-transition:leave="transition transform ease-in duration-200"
         x-transition:leave-start="translate-x-0 opacity-100"
         x-transition:leave-end="translate-x-full opacity-0"
         class="fixed inset-0 z-50 flex pointer-events-none">

        <div class="w-full pointer-events-auto flex justify-end">
            <div @click.away="open = false"
                 x-transition:enter="transition transform ease-out duration-300"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition transform ease-in duration-200"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full"
                 class="w-full max-w-md h-full bg-white shadow-2xl rounded-l-3xl p-6 overflow-y-auto pointer-events-auto backdrop-blur-sm">

                {{-- Close Button --}}
                <button @click="open = false" class="mb-4 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>

                {{-- Modal Content --}}
                <h2 class="text-3xl font-bold mb-4 text-gray-900">{{ $tool->title }}</h2>
                <p class="text-gray-600 mb-6 whitespace-pre-line">{{ $tool->description }}</p>

                {{-- Public-style tool request form --}}
                <form method="POST" action="{{ route('tools.request', $tool->slug) }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full px-6 py-3 bg-indigo-600 text-white rounded-2xl shadow-md hover:bg-indigo-700 transition-all duration-300">
                        Get This Tool
                    </button>
                </form>

                {{-- Creator Info --}}
                <div class="mt-6 flex items-center border-t pt-4">
                    <div class="flex-shrink-0">
                        <img class="h-12 w-12 rounded-full border" src="{{ $tool->creator->avatar ?? '/images/default-avatar.png' }}" alt="{{ $tool->creator->name }}">
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-900 font-semibold">{{ $tool->creator->name ?? 'Unknown' }}</p>
                        <p class="text-gray-500 text-sm">Creator</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
