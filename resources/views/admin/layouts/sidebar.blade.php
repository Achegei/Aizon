<aside class="w-52 bg-white border-r min-h-screen flex flex-col">

    {{-- Brand --}}
    <div class="px-4 py-4 text-lg font-semibold tracking-tight text-gray-900">
        AIZON
        <span class="text-xs text-gray-400 font-medium">Admin</span>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-2 space-y-1 text-sm">

        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center px-3 py-2 rounded-md font-medium text-gray-700 hover:bg-gray-100">
            Dashboard
        </a>

        <div class="mt-4 px-3 text-[11px] font-semibold uppercase tracking-wider text-gray-400">
            Management
        </div>

        <a href="{{ route('admin.users.index') }}"
           class="flex items-center px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100">
            Users
        </a>

        <a href="{{ route('admin.roles.index') }}"
           class="flex items-center px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100">
            Roles
        </a>

        <a href="{{ route('admin.jobs.index') }}"
           class="flex items-center px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100">
            Jobs
        </a>

        <a href="{{ route('admin.tools.index') }}"
           class="flex items-center px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100">
            Tools
        </a>

        <a href="{{ route('admin.orders.index') }}"
           class="flex items-center px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100">
            Orders
        </a>

        <a href="{{ route('admin.payouts.index') }}"
           class="flex items-center px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100">
            Payouts
        </a>
    </nav>

    {{-- Logout --}}
    <form method="POST" action="{{ route('logout') }}" class="px-4 py-4 border-t">
        @csrf
        <button class="text-sm font-semibold text-red-600 hover:text-red-700">
            Logout
        </button>
    </form>

</aside>
