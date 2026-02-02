<aside class="w-64 bg-white border-r min-h-screen">
    <div class="p-6 text-xl font-bold">
        AIZON Employer
    </div>

    <nav class="px-4 space-y-1">

        <a href="{{ route('employer.dashboard') }}"
           class="block px-4 py-2 rounded hover:bg-gray-100">
            Dashboard
        </a>

        <p class="text-xs text-gray-400 uppercase mt-4 mb-2">Jobs</p>

        <a href="{{ route('employer.jobs.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-100">
            My Jobs
        </a>

        <a href="{{ route('employer.jobs.create') }}"
           class="block px-4 py-2 rounded hover:bg-gray-100">
            Post New Job
        </a>

        <a href="#"
           class="block px-4 py-2 rounded hover:bg-gray-100">
            Applications
        </a>

        <p class="text-xs text-gray-400 uppercase mt-4 mb-2">Account</p>

        <a href="#"
           class="block px-4 py-2 rounded hover:bg-gray-100">
            Profile
        </a>
    </nav>

    <form method="POST" action="{{ route('logout') }}" class="p-4">
        @csrf
        <button class="text-red-600">Logout</button>
    </form>
</aside>
