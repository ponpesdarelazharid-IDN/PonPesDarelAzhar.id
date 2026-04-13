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
        
        <!-- Favicon -->
        <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-da.png') }}">

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

            /* Styling untuk Loading Screen */
            #loading-screen {
              position: fixed;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              background-color: #ffffff;
              display: flex;
              flex-direction: column;
              justify-content: center;
              align-items: center;
              z-index: 9999;
              transition: opacity 0.5s ease;
            }

            .loading-logo {
              width: 120px;
              height: auto;
              animation: pulse 2s infinite ease-in-out;
            }

            @keyframes pulse {
              0% { transform: scale(1); }
              50% { transform: scale(1.05); }
              100% { transform: scale(1); }
            }
        </style>
    </head>
    <body class="h-full antialiased bg-slate-50 dark:bg-black transition-colors duration-500">
        <!-- Loading Screen -->
        <div id="loading-screen" class="fixed inset-0 z-[9999] bg-white dark:bg-black flex flex-col items-center justify-center transition-opacity duration-500">
          <div class="relative flex flex-col items-center">
            <img src="{{ asset('images/logo-da.png') }}" 
                 alt="Logo" 
                 class="loading-logo w-24 h-24 object-contain mb-6">
            
            <div class="absolute inset-x-0 -bottom-2 flex justify-center">
                <div class="w-8 h-8 border-4 border-emerald-500/20 border-t-emerald-500 rounded-full animate-spin"></div>
            </div>
          </div>
          <div class="mt-8 text-emerald-500 font-black tracking-widest uppercase text-[10px] animate-pulse">MEMUAT...</div>
        </div>

        <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
                <a href="/" class="inline-block transform hover:scale-110 transition duration-500">
                    <div class="flex items-center justify-center p-4">
                        <img src="{{ asset('images/logo-da.png') }}" alt="Logo Darel Azhar" class="w-20 h-auto">
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

        <!-- Script to hide loading screen -->
        <script>
            window.addEventListener('load', function() {
                const loader = document.getElementById('loading-screen');
                if (loader) {
                    loader.style.opacity = '0';
                    setTimeout(function() {
                        loader.remove();
                    }, 600);
                }
            });
            
            // Fail-safe
            setTimeout(() => {
                const loader = document.getElementById('loading-screen');
                if(loader && loader.style.opacity !== '0') {
                   loader.style.opacity = '0';
                   setTimeout(() => loader.remove(), 600);
                }
            }, 5000);
        </script>
    </body>
</html>
