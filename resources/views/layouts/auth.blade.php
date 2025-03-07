<!-- auth.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Geraimu') }} - Your Elegant Coffee Experience</title>

    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css2?family=Sorts+Mill+Goudy:wght@400&display=swap" rel="stylesheet"> --}}
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <style>
        .brand-goudy {
            font-family: 'Sorts Mill Goudy', serif;
        }
        
        .auth-pattern {
            background-color: #1a472a;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23255c3b' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style> --}}
</head>
<body class="brand-goudy font-sans antialiased text-gray-800 min-h-screen flex flex-col bg-primary-50">
    <!-- Background Pattern -->
    <div class="fixed inset-0 auth-pattern opacity-10"></div>
    
    <!-- Main Content -->
    <div class="relative flex-grow flex items-center justify-center p-4 sm:p-8">
        <div class="w-full max-w-md">
            <!-- Centered Logo -->
            <div class="text-center mb-8 transform hover:scale-105 transition-transform duration-300">
                <a href="/" class="inline-flex flex-col items-center">
                    <img src="/img/logo.png" alt="Geraimu Logo" class="h-20 mb-3 drop-shadow-xl">
                    <span class="text-4xl font-bold text-primary-800 tracking-wide">Geraimu</span>
                </a>
            </div>

            <!-- Auth Content -->
            <div class="glass-effect p-8 rounded-2xl shadow-2xl border border-primary-100/50">
                {{ $slot }}
            </div>

            <!-- Additional Links -->
            <div class="mt-8 text-center text-sm text-primary-600">
                <a href="/" class="inline-flex items-center hover:text-primary-800 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </div>

    <!-- Simplified Footer -->
    <footer class="relative glass-effect py-6 border-t border-primary-100/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-primary-800">&copy; {{ date('Y') }} Geraimu Coffee Shop. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>