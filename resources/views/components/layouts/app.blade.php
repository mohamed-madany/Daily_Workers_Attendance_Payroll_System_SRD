<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'لوحة التحكم' }} - نظام العمال اليومية</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cairo:400,500,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen flex">
        <!-- Sidebar -->
        @include('components.navigation.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:mr-64">
            <!-- Topbar -->
            @include('components.navigation.topbar')

            <!-- Page Content -->
            <main class="flex-1 p-4 lg:p-6">
                <!-- Page Header -->
                @if(isset($header))
                <div class="mb-6">
                    {{ $header }}
                </div>
                @endif

                <!-- Flash Messages -->
                @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg">
                    {{ session('error') }}
                </div>
                @endif

                <!-- Main Content Slot -->
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-4 px-6 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} نظام العمال اليومية. جميع الحقوق محفوظة.
            </footer>
        </div>
    </div>
</body>
</html>
