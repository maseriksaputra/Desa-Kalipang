<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
    </head>
    <body class="font-sans antialiased text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-900 dark:bg-gradient-to-br dark:from-gray-900 dark:via-gray-900 dark:to-indigo-950/30 transition-colors duration-300 selection:bg-indigo-500 selection:text-white">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-slate-800/80 dark:backdrop-blur-xl shadow dark:shadow-xl dark:border-b dark:border-slate-700/50 transition-all duration-300">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script>
            function setupThemeToggle(btnId, darkIconId, lightIconId) {
                var themeToggleDarkIcon = document.getElementById(darkIconId);
                var themeToggleLightIcon = document.getElementById(lightIconId);
                var themeToggleBtn = document.getElementById(btnId);

                if (!themeToggleBtn || !themeToggleDarkIcon || !themeToggleLightIcon) return;

                // Set initial icons
                if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    themeToggleLightIcon.classList.remove('hidden');
                } else {
                    themeToggleDarkIcon.classList.remove('hidden');
                }

                themeToggleBtn.addEventListener('click', function() {
                    // toggle icons
                    themeToggleDarkIcon.classList.toggle('hidden');
                    themeToggleLightIcon.classList.toggle('hidden');

                    // If mobile and desktop buttons both exist, sync their icons
                    var otherDarkIcon = darkIconId === 'theme-toggle-dark-icon' ? document.getElementById('theme-toggle-dark-icon-mobile') : document.getElementById('theme-toggle-dark-icon');
                    var otherLightIcon = lightIconId === 'theme-toggle-light-icon' ? document.getElementById('theme-toggle-light-icon-mobile') : document.getElementById('theme-toggle-light-icon');
                    if(otherDarkIcon && otherLightIcon) {
                        otherDarkIcon.classList.toggle('hidden');
                        otherLightIcon.classList.toggle('hidden');
                    }

                    // if set via local storage previously
                    if (localStorage.getItem('color-theme')) {
                        if (localStorage.getItem('color-theme') === 'light') {
                            document.documentElement.classList.add('dark');
                            localStorage.setItem('color-theme', 'dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                            localStorage.setItem('color-theme', 'light');
                        }
                    } else {
                        if (document.documentElement.classList.contains('dark')) {
                            document.documentElement.classList.remove('dark');
                            localStorage.setItem('color-theme', 'light');
                        } else {
                            document.documentElement.classList.add('dark');
                            localStorage.setItem('color-theme', 'dark');
                        }
                    }
                });
            }

            setupThemeToggle('theme-toggle', 'theme-toggle-dark-icon', 'theme-toggle-light-icon');
            setupThemeToggle('theme-toggle-mobile', 'theme-toggle-dark-icon-mobile', 'theme-toggle-light-icon-mobile');
        </script>
    </body>
</html>
