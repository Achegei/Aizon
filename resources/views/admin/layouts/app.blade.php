<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AIZON Admin</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- ADMIN SIDEBAR --}}
    @include('admin.layouts.sidebar')

    {{-- MAIN CONTENT --}}
    <div class="flex-1">
        <header class="bg-white shadow px-6 py-4 flex justify-between">
            <h1 class="text-xl font-bold">Admin Panel</h1>
            <span>Hello, {{ auth()->user()->name }}</span>
        </header>

        <main class="p-6">
            @yield('content')
        </main>
    </div>

</div>

</body>
</html>
