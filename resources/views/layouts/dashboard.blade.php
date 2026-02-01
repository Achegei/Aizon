<!-- resources/views/layouts/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} - AIZON</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    @include('components.navbar')

    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md">
            @php
                $role = auth()->user()->role ?? null;
            @endphp

            @if($role === \App\Enums\UserRole::ADMIN->value)
                @include('layouts.partials.nav.admin')
            @elseif($role === \App\Enums\UserRole::CREATOR->value)
                @include('layouts.partials.nav.creator')
            @elseif($role === \App\Enums\UserRole::EMPLOYER->value)
                @include('layouts.partials.nav.employer')
            @endif
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    @include('components.footer')

</body>
</html>
