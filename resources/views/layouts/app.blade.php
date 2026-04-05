<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $profiles['nama_sekolah'] ?? 'PonPes Darel Azhar')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        emerald: { 
                            400: '#34D399', // Mint for Dark Mode
                            500: '#10B981', // Emerald for Light Mode
                            600: '#059669', 
                            700: '#047857'
                        },
                        slate: {
                            900: '#1E293B', // Text Primary Light
                        },
                        dark: { 
                            main: '#0F172A', // Background Dark
                            card: '#1E293B', // surface/card Dark
                            text: '#F1F5F9'  // Text Primary Dark
                        },
                        light: {
                            main: '#F8FAFC', // Background Light
                            text: '#1E293B'  // Text Primary Light
                        }
                    }
                }
            }
        }
        
        // Dark Mode Logic (Persistent)
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
        
        function toggleDarkMode() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ $profiles['logo'] ?? asset('images/logo-da.png') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-da.png') }}">

    <style>
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
        font-family: Arial, sans-serif;
        transition: opacity 0.5s ease;
      }

      /* Ukuran logo diatur proporsional */
      .loading-logo {
        width: 150px; /* Atur lebar sesuai kebutuhan */
        height: auto; /* Memastikan logo tidak peyang/distorsi */
        animation: pulse 2s infinite ease-in-out;
      }

      .loading-text {
        margin-top: 20px;
        color: #333333;
        font-size: 16px;
        font-weight: bold;
        letter-spacing: 2px;
      }

      /* Animasi halus membesar-mengecil sedikit */
      @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
      }
    </style>
</head>
<<body class="bg-light-main text-light-text dark:bg-dark-main dark:text-dark-text transition-colors duration-300 font-sans antialiased">
    <!-- Loading Screen (Preserved) -->
    <div id="loading-screen" class="fixed inset-0 z-[9999] bg-white dark:bg-dark-main flex flex-col items-center justify-center transition-opacity duration-500">
      <img src="{{ $profiles['logo'] ?? asset('images/logo-da.png') }}" alt="Logo" class="loading-logo w-32 h-32 object-contain mb-4 animate-pulse">
      <div class="text-emerald-500 font-bold tracking-widest uppercase animate-bounce">MEMUAT...</div>
    </div>

    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="sticky top-0 z-50 bg-white/80 dark:bg-dark-card/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 transition-all">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <!-- Brand -->
                    <div class="flex items-center gap-3">
                        <img src="{{ $profiles['logo'] ?? asset('images/logo-da.png') }}" alt="Logo" class="w-10 h-10 object-contain">
                        <div class="font-bold text-xl text-emerald-600 dark:text-emerald-400 truncate">
                            {{ $profiles['nama_sekolah'] ?? 'PonPes Darel Azhar' }}
                        </div>
                    </div>

                    <!-- Links -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="/" class="text-sm font-semibold hover:text-emerald-500 transition">Beranda</a>
                        <a href="{{ route('berita.index') }}" class="text-sm font-semibold hover:text-emerald-500 transition">Berita</a>
                        @if(isset($ppdb) && $ppdb->is_open)
                            <a href="{{ route('ppdb.landing') }}" class="px-6 py-2 bg-emerald-500 text-white rounded-full font-bold hover:bg-emerald-600 transition shadow-lg shadow-emerald-500/30">Daftar PPDB</a>
                        @else
                            <a href="{{ route('ppdb.landing') }}" class="text-sm font-semibold hover:text-emerald-500 transition">PPDB</a>
                        @endif
                        
                        <!-- Dark Mode Toggle -->
                        <button onclick="toggleDarkMode()" class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 hover:ring-2 hover:ring-emerald-500 transition">
                            <span class="dark:hidden">🌙</span>
                            <span class="hidden dark:inline">☀️</span>
                        </button>

                        @auth
                            <a href="{{ (auth()->check() && strtolower(auth()->user()->role) === 'admin') ? route('admin.dashboard') : route('dashboard') }}" class="text-sm font-bold px-4 py-2 border-2 border-emerald-500 text-emerald-600 dark:text-emerald-400 rounded-full hover:bg-emerald-500 hover:text-white transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 dark:text-slate-400">Login</a>
                        @endauth
                    </div>

                    <!-- Mobile Toggle -->
                    <div class="md:hidden flex items-center gap-4">
                        <button onclick="toggleDarkMode()" class="p-2 rounded-lg bg-slate-100 dark:bg-slate-800">
                             <span class="dark:hidden">🌙</span>
                             <span class="hidden dark:inline">☀️</span>
                        </button>
                        <button class="p-2 text-slate-600 dark:text-slate-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow">
            @yield('content')
            @if(isset($slot))
                {{ $slot }}
            @endif
        </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-dark-card border-t border-slate-200 dark:border-slate-800 py-12 transition-colors">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div>
                        <div class="font-bold text-xl text-emerald-600 dark:text-emerald-400 mb-4 uppercase">
                            {{ $profiles['nama_sekolah'] ?? 'PonPes Darel Azhar' }}
                        </div>
                        <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                            {{ $profiles['misi_singkat'] ?? 'Membangun generasi berakhlak mulia dan berprestasi.' }}
                        </p>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4 uppercase tracking-wider text-xs text-slate-400">Hubungi Kami</h4>
                        <ul class="text-sm space-y-3 text-slate-500 dark:text-slate-400">
                            <li>📍 {{ $profiles['alamat'] ?? 'Jl. Pesantren No. 1' }}</li>
                            <li>📞 {{ $profiles['tlp'] ?? '08123456789' }}</li>
                            <li>✉️ {{ $profiles['email'] ?? 'info@ponpes.id' }}</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4 uppercase tracking-wider text-xs text-slate-400">Sosial Media</h4>
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center hover:bg-emerald-500 hover:text-white transition cursor-pointer">FB</div>
                            <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center hover:bg-emerald-500 hover:text-white transition cursor-pointer">IG</div>
                            <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center hover:bg-emerald-500 hover:text-white transition cursor-pointer">YT</div>
                        </div>
                    </div>
                </div>
                <div class="mt-12 pt-8 border-t border-slate-100 dark:border-slate-800 text-center text-xs text-slate-400">
                    &copy; {{ date('Y') }} {{ $profiles['nama_sekolah'] ?? 'PonPes Darel Azhar' }}. All Rights Reserved.
                </div>
            </div>
        </footer>
    </div>
   </div>

    <!-- Theme Toggle Script (Enhanced & Persistent) -->
    <script>
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        const themeToggleDarkIconMobile = document.getElementById('theme-toggle-dark-icon-mobile');
        const themeToggleLightIconMobile = document.getElementById('theme-toggle-light-icon-mobile');

        // Check local storage or system preference
        function initTheme() {
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                if(themeToggleLightIcon) themeToggleLightIcon.classList.remove('hidden');
                if(themeToggleLightIconMobile) themeToggleLightIconMobile.classList.remove('hidden');
                if(themeToggleDarkIcon) themeToggleDarkIcon.classList.add('hidden');
                if(themeToggleDarkIconMobile) themeToggleDarkIconMobile.classList.add('hidden');
            } else {
                document.documentElement.classList.remove('dark');
                if(themeToggleDarkIcon) themeToggleDarkIcon.classList.remove('hidden');
                if(themeToggleDarkIconMobile) themeToggleDarkIconMobile.classList.remove('hidden');
                if(themeToggleLightIcon) themeToggleLightIcon.classList.add('hidden');
                if(themeToggleLightIconMobile) themeToggleLightIconMobile.classList.add('hidden');
            }
        }

        function toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
            initTheme();
        }

        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeToggleBtnMobile = document.getElementById('theme-toggle-mobile');

        if(themeToggleBtn) themeToggleBtn.addEventListener('click', toggleTheme);
        if(themeToggleBtnMobile) themeToggleBtnMobile.addEventListener('click', toggleTheme);
        
        initTheme();
    </script>
    
    <!-- Scripts -->
    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('loading-screen');
            if(loader) {
                loader.style.opacity = '0';
                setTimeout(function() {
                    loader.style.display = 'none';
                }, 500);
            }
        });
    </script>
</body>
</html>
