<aside class="w-64 bg-white border-r min-h-screen">
    <div class="p-6 text-xl font-bold">
        AIZON Admin
    </div>

    <nav class="px-4 space-y-1">

        <a href="{{ route('admin.dashboard') }}"
           class="block px-4 py-2 rounded hover:bg-gray-100">
            Dashboard
        </a>

        <p class="text-xs text-gray-400 uppercase mt-4 mb-2">Management</p>

        <a href="{{ route('admin.users.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-100">
            Users
        </a>

        <a href="{{ route('admin.roles.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-100">
            Roles & Permissions
        </a>

        <a href="{{ route('admin.jobs.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-100">
            Jobs (Approve)
        </a>

        <a href="{{ route('admin.tools.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-100">
            Tools
        </a>

        <a href="{{ route('admin.orders.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-100">
            Orders
        </a>

        <a href="{{ route('admin.payouts.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-100">
            Payouts
        </a>
    </nav>

    <form method="POST" action="{{ route('logout') }}" class="p-4">
        @csrf
        <button class="text-red-600">Logout</button>
    </form>
</aside>
