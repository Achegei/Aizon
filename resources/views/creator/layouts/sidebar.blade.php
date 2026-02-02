<aside class="w-64 bg-white border-r min-h-screen">
    <div class="p-6 text-xl font-bold">
        AIZON Creator
    </div>

    <nav class="px-4 space-y-1">

        <a href="{{ route('creator.dashboard') }}"
           class="block px-4 py-2 rounded hover:bg-gray-100">
            Dashboard
        </a>

        <p class="text-xs text-gray-400 uppercase mt-4 mb-2">Content</p>

        <a href="{{ route('creator.courses.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-100">
            My Courses
        </a>

        <a href="{{ route('creator.courses.create') }}"
           class="block px-4 py-2 rounded hover:bg-gray-100">
            Create Course
        </a>

        <a href="{{ route('creator.tools.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-100">
            My Tools
        </a>

        <a href="{{ route('creator.tools.create') }}"
           class="block px-4 py-2 rounded hover:bg-gray-100">
            Create Tool
        </a>

        <p class="text-xs text-gray-400 uppercase mt-4 mb-2">Account</p>

        @if (\Illuminate\Support\Facades\Route::has('creator.profile'))
            <a href="{{ route('creator.profile') }}"
               class="block px-4 py-2 rounded hover:bg-gray-100">
                Profile
            </a>
        @endif
    </nav>

    <form method="POST" action="{{ route('logout') }}" class="p-4">
        @csrf
        <button class="text-red-600">Logout</button>
    </form>
</aside>
