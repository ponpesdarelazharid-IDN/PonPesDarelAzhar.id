<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <style>
            body { font-family: 'Outfit', sans-serif; }
        </style>
    </head>
    <body class="h-full antialiased bg-slate-50 dark:bg-black transition-colors duration-500">
        <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
                <a href="/" class="inline-block transform hover:scale-110 transition duration-500">
                    <div class="w-16 h-16 bg-[#1e293b] dark:bg-white rounded-2xl flex items-center justify-center shadow-2xl mx-auto">
                        <span class="text-white dark:text-black text-2xl font-black">DA</span>
                    </div>
                </a>
                <h2 class="mt-6 text-2xl font-black tracking-tight text-[#1e293b] dark:text-white uppercase">
                    {{ $title ?? 'PPDB ONLINE' }}
                </h2>
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white dark:bg-[#0a0a0a] py-10 px-6 shadow-2xl rounded-3xl sm:px-10 border border-slate-100 dark:border-gray-900 mx-4 sm:mx-0">
                    {{ $slot }}
                </div>
                
                <p class="mt-8 text-center text-xs font-bold text-slate-400 dark:text-gray-600 uppercase tracking-widest">
                    &copy; {{ date('Y') }} {{ config('app.name') }}
                </p>
            </div>
        </div>
    </body>
</html>
