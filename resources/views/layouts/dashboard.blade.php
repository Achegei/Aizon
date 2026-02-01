{{-- resources/views/layouts/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | AIZON Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex h-screen bg-gray-50 font-sans text-gray-800">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-md flex-shrink-0 flex flex-col">
        <div class="px-6 py-4 text-2xl font-bold border-b border-gray-200">
            AIZON Admin
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 font-semibold' : '' }}">Dashboard</a>

            <h3 class="mt-4 mb-2 text-gray-500 uppercase text-xs font-bold">Management</h3>
            <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.users.*') ? 'bg-gray-100 font-semibold' : '' }}">Users</a>
            <a href="{{ route('admin.roles.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.roles.*') ? 'bg-gray-100 font-semibold' : '' }}">Roles</a>
            <a href="{{ route('admin.tools.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.tools.*') ? 'bg-gray-100 font-semibold' : '' }}">Tools</a>
            <a href="{{ route('admin.courses.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.courses.*') ? 'bg-gray-100 font-semibold' : '' }}">Courses</a>
            <a href="{{ route('admin.jobs.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.jobs.*') ? 'bg-gray-100 font-semibold' : '' }}">Jobs</a>
            <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.orders.*') ? 'bg-gray-100 font-semibold' : '' }}">Orders</a>
            <a href="{{ route('admin.payouts.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.payouts.*') ? 'bg-gray-100 font-semibold' : '' }}">Payouts</a>
        </nav>

        <div class="px-6 py-4 border-t border-gray-200">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left text-red-600 font-semibold hover:text-red-800">Logout</button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="flex items-center justify-between bg-white shadow px-6 py-4">
            <h1 class="text-xl font-semibold">@yield('page-title', 'Dashboard')</h1>
            <span class="text-gray-700 font-medium">Hello, {{ auth()->user()->name }}</span>
        </header>

        <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
            @yield('content')
        </main>
    </div>

</body>
</html>
