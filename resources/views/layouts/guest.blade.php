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

    @stack('head')
</head>

<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <!-- Header with Logo and Dark Mode Toggle -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="flex justify-between items-center mb-6">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2 mx-auto group">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-200">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span
                        class="font-bold text-2xl text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                        StudyHive
                    </span>
                </a>

                <!-- Dark Mode Toggle -->
                <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
                    class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 hover:bg-white/50 dark:hover:bg-gray-800/50 rounded-lg transition-all duration-200"
                    title="Toggle dark mode">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Main Card -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div
                class="bg-white dark:bg-gray-800 py-8 px-6 shadow-xl rounded-2xl border border-gray-200 dark:border-gray-700">
                {{ $slot }}
            </div>
        </div>

        <!-- Footer Links -->
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="text-center space-y-4">
                <div class="flex justify-center space-x-6 text-sm">
                    <a href="{{ route('home') }}"
                        class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                        Home
                    </a>
                    <a href="#"
                        class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                        Help
                    </a>
                    <a href="#"
                        class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                        Privacy
                    </a>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    © {{ date('Y') }} StudyHive. All rights reserved.
                </p>
            </div>
        </div>
    </div>

    <script>
        // Initialize dark mode from localStorage
        document.addEventListener('DOMContentLoaded', function () {
            const darkMode = localStorage.getItem('darkMode') === 'true';
            if (darkMode) {
                document.documentElement.classList.add('dark');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>