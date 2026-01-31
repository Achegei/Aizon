<footer class="bg-gray-900 px-8 py-16 text-sm text-gray-400">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">

        <div>
            <h4 class="text-white font-semibold mb-3">AIZON Market</h4>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-purple-400">About</a></li>
                <li><a href="{{ route('pricing.index') }}" class="hover:text-purple-400">Pricing</a></li>
                <li><a href="#" class="hover:text-purple-400">FAQ</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white font-semibold mb-3">Marketplace</h4>
            <ul class="space-y-2">
                <li><a href="{{ route('tools.index') }}" class="hover:text-purple-400">AI Tools</a></li>
                <li><a href="{{ route('courses.index') }}" class="hover:text-purple-400">Courses</a></li>
                <li><a href="{{ route('jobs.index') }}" class="hover:text-purple-400">Jobs</a></li>
                <li><a href="{{ route('hire.index') }}" class="hover:text-purple-400">Hire Talent</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white font-semibold mb-3">Creators</h4>
            <ul class="space-y-2">
                <li><a href="{{ route('sell.index') }}" class="hover:text-purple-400">Sell on AIZON</a></li>
                <li><a href="#" class="hover:text-purple-400">Creator Dashboard</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white font-semibold mb-3">Legal</h4>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-purple-400">Terms</a></li>
                <li><a href="#" class="hover:text-purple-400">Privacy</a></li>
            </ul>
        </div>
        

    </div>

    <!-- Social Links -->
<div class="flex justify-center gap-6 mt-10">
    <!-- Twitter -->
    <a href="#" class="text-gray-400 hover:text-white transition">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 002.2-2.48 9.11 9.11 0 01-2.88 1.1 4.52 4.52 0 00-7.7 4.12A12.94 12.94 0 013 1.67a4.52 4.52 0 001.39 6.06 4.47 4.47 0 01-2.04-.56v.06c0 2.2 1.56 4.03 3.64 4.44a4.5 4.5 0 01-2.04.08 4.52 4.52 0 004.2 3.13A9.05 9.05 0 012 19.54a12.77 12.77 0 006.92 2.03c8.3 0 12.84-6.87 12.84-12.84 0-.2 0-.42-.01-.63A9.18 9.18 0 0023 3z"/>
        </svg>
    </a>

    <!-- LinkedIn -->
    <a href="#" class="text-gray-400 hover:text-white transition">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19 0h-14a5 5 0 00-5 5v14a5 5 0 005 5h14a5 5 0 005-5v-14a5 5 0 00-5-5zm-11.5 20h-3v-11h3v11zm-1.5-12.27a1.72 1.72 0 110-3.44 1.72 1.72 0 010 3.44zm13 12.27h-3v-5.5c0-1.32-.02-3-1.83-3-1.83 0-2.11 1.43-2.11 2.9v5.6h-3v-11h2.88v1.5h.04c.4-.75 1.38-1.54 2.84-1.54 3.04 0 3.6 2 3.6 4.6v6.44z"/>
        </svg>
    </a>

    <!-- YouTube -->
    <a href="#" class="text-gray-400 hover:text-white transition">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M23.5 6.2a2.82 2.82 0 00-1.98-2 29.88 29.88 0 00-9.52-.8 29.88 29.88 0 00-9.52.8 2.82 2.82 0 00-1.98 2A29.88 29.88 0 000 12a29.88 29.88 0 00.5 5.8 2.82 2.82 0 001.98 2A29.88 29.88 0 0012 20a29.88 29.88 0 009.52-1.2 2.82 2.82 0 001.98-2A29.88 29.88 0 0024 12a29.88 29.88 0 00-.5-5.8zM10 15V9l6 3-6 3z"/>
        </svg>
    </a>

    <!-- Facebook -->
    <a href="#" class="text-gray-400 hover:text-white transition">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M22.68 0H1.32A1.32 1.32 0 000 1.32v21.36A1.32 1.32 0 001.32 24h11.5V14.7h-3.13v-3.6h3.13V8.29c0-3.1 1.89-4.79 4.65-4.79 1.32 0 2.46.1 2.78.14v3.22h-1.91c-1.5 0-1.8.71-1.8 1.76v2.3h3.6l-.47 3.6h-3.13V24h6.13A1.32 1.32 0 0024 22.68V1.32A1.32 1.32 0 0022.68 0z"/>
        </svg>
    </a>
</div>

    <p class="mt-10 text-center">
        © {{ date('Y') }} AIZON Market™. All rights reserved.
    </p>
</footer>
