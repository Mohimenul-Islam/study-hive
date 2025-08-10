<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: false }" :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name', 'StudyHive') }}</title>

    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <!-- Modern font stack -->
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Meta tags for SEO -->
    <meta name="description" content="{{ $metaDescription ?? 'StudyHive - Share and discover educational resources' }}">
    <meta property="og:title" content="{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }}">
    <meta property="og:description"
        content="{{ $metaDescription ?? 'StudyHive - Share and discover educational resources' }}">

    @stack('head')
</head>

<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content"
        class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded-md z-50">
        Skip to main content
    </a>

    <!-- Main App Container -->
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page Header -->
        @if(isset($header))
            <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="py-6 md:py-8">
                        {{ $header }}
                    </div>
                </div>
            </header>
        @endif

        <!-- Main Content -->
        <main id="main-content" class="flex-1">
            <!-- Flash Messages -->
            @if (session('success'))
                <x-alert type="success" :message="session('success')" />
            @endif

            @if (session('error'))
                <x-alert type="error" :message="session('error')" />
            @endif

            @if (session('warning'))
                <x-alert type="warning" :message="session('warning')" />
            @endif

            @if (session('info'))
                <x-alert type="info" :message="session('info')" />
            @endif

            {{ $slot }}
        </main>

        <!-- Footer -->
        @include('layouts.footer')
    </div>

    <!-- Loading overlay for better UX -->
    <div x-data="{ loading: false }" x-show="loading" x-cloak
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-xl">
            <div class="flex items-center space-x-3">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                <span class="text-gray-700 dark:text-gray-300">Loading...</span>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>

</html>