<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Login' }} - Daily Workers ERP</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <!-- Logo -->
        <div class="mb-8">
            <a href="/" class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-primary-600 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <span class="text-2xl font-bold text-gray-900">Daily Workers ERP</span>
            </a>
        </div>

        <!-- Auth Card -->
        <div class="w-full max-w-md">
            <div class="bg-white shadow-lg rounded-2xl p-8">
                {{ $slot }}
            </div>
        </div>

        <!-- Footer -->
        <p class="mt-8 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Daily Workers ERP. All rights reserved.
        </p>
    </div>
</body>
</html>
