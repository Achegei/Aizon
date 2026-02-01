<nav class="px-8 py-4 flex justify-between items-center border-b border-gray-800">
    <div class="text-2xl font-bold">
        AIZON<span class="text-purple-500">Market</span>
    </div>

    <ul class="flex gap-6 text-sm">
        <li><a href="{{ route('public.tools.index') }}" class="hover:text-purple-400">AI Tools</a></li>
        <li><a href="{{ route('public.courses.index') }}" class="hover:text-purple-400">Courses</a></li>
        <li><a href="{{ route('public.jobs.index') }}" class="hover:text-purple-400">Jobs</a></li>
        <li><a href="{{ route('public.hire.index') }}" class="hover:text-purple-400">Hire Talent</a></li>
        <li><a href="{{ route('public.sell.index') }}" class="hover:text-purple-400">Sell on AIZON</a></li>
        <li><a href="{{ route('public.pricing.index') }}" class="hover:text-purple-400">Pricing</a></li>

        @guest
            <!-- Show Login if not logged in -->
            <li><a href="{{ route('login') }}" class="hover:text-purple-400">Login</a></li>
        @else
            <!-- Show user name and Logout if logged in -->
            <li class="flex items-center gap-2">
                <span class="text-gray-300">Hi, {{ auth()->user()->name }}</span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-purple-400">Logout</button>
                </form>
            </li>
        @endguest
    </ul>
</nav>
