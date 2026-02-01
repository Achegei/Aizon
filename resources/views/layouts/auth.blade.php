<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aizon') - Auth</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Tailwind CSS CDN (optional: replace with compiled app.css) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom Silicon Valley-inspired styles */
        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fa;
        }
        .auth-left {
            background: white;
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }
        .auth-right {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-right h1 {
            font-size: 2.5rem;
            font-weight: 700;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-6xl flex shadow-lg rounded-lg overflow-hidden">

        <!-- Left: Form Panel -->
        <div class="auth-left w-full md:w-1/2">
            <div class="mb-6 text-center">
                <a href="{{ route('home') }}" class="text-3xl font-bold text-indigo-600">Aizon</a>
            </div>

            @yield('content')
        </div>

        <!-- Right: Visual / Branding -->
        <div class="auth-right hidden md:flex w-1/2 p-10">
            <div class="text-center">
                <h1>Empower Your Digital Business</h1>
                <p class="mt-4 text-indigo-200">AI tools, Courses, Jobs, and Talent at your fingertips.</p>
            </div>
        </div>
    </div>
</body>
</html>
