<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Sekolah Kita'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Theme Initialization (prevents FOUC) -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 dark:bg-[#000000] dark:text-gray-100 transition-colors duration-300">
    <div x-data="{ mobileMenuOpen: false }" class="min-h-screen flex flex-col">
        
        <!-- Navbar -->
        <nav class="sticky top-0 z-50 bg-white/80 dark:bg-[#0a0a0a]/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 transition-colors">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo & Brand -->
                    <div class="flex items-center">
                        <a href="/" class="flex items-center gap-2">
                            <!-- Logo Placeholder or SVG -->
                            <div class="w-8 h-8 rounded-lg bg-blue-600 dark:bg-white flex items-center justify-center text-white dark:text-black font-bold text-xl">S</div>
                            <span class="font-bold text-xl tracking-tight text-gray-900 dark:text-white">
                                {{ $profiles['nama_sekolah'] ?? 'Sekolah Kita' }}
                            </span>
                        </a>
                        
                        <!-- Desktop Main Links -->
                        <div class="hidden md:flex md:ml-10 md:space-x-8">
                            <a href="/" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-600 transition">Beranda</a>
                            <a href="/#profil" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-600 transition">Profil</a>
                            <a href="{{ route('berita.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-600 transition">Berita</a>
                            <a href="{{ route('ppdb.landing') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-600 transition">PPDB</a>
                        </div>
                    </div>

                    <!-- Right Side (Theme Toggle + Auth Link) -->
                    <div class="hidden md:flex items-center space-x-4">
                        <!-- Theme Toggle Button -->
                        <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 transition">
                            <!-- Sun Icon -->
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path></svg>
                            <!-- Moon Icon -->
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        </button>

                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 dark:bg-white dark:text-black dark:hover:bg-gray-200 shadow-sm transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-slate-900 hover:bg-black dark:bg-white dark:text-black dark:hover:bg-gray-200 shadow-sm transition">
                                Login / Daftar
                            </a>
                        @endauth
                    </div>

                    <!-- Mobile menu button -->
                    <div class="flex items-center md:hidden gap-2">
                        <button id="theme-toggle-mobile" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg p-2.5 transition">
                            <svg id="theme-toggle-light-icon-mobile" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path></svg>
                            <svg id="theme-toggle-dark-icon-mobile" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        </button>
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white transition">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': !mobileMenuOpen, 'inline-flex': mobileMenuOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" class="md:hidden border-t border-gray-100 dark:border-gray-800 bg-white dark:bg-[#0a0a0a]" style="display: none;">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="/" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-900 transition">Beranda</a>
                    <a href="/#profil" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-900 transition">Profil</a>
                    <a href="{{ route('berita.index') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-900 transition">Berita</a>
                    <a href="{{ route('ppdb.landing') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-900 transition">PPDB</a>
                </div>
                <div class="pt-4 pb-4 border-t border-gray-100 dark:border-gray-800 px-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="block w-full text-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 dark:bg-white dark:text-black transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-slate-900 hover:bg-black dark:bg-white dark:text-black transition">Login / Daftar</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Page Heading (Optional) -->
        @hasSection('header')
            <header class="bg-white dark:bg-[#0a0a0a] shadow dark:shadow-none dark:border-b dark:border-gray-800 transition-colors">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        <!-- Main Content -->
        <main class="flex-grow">
            @yield('content')
            
            @if(isset($slot))
                {{ $slot }}
            @endif
        </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-[#0a0a0a] border-t border-gray-200 dark:border-gray-900 mt-auto transition-colors">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Brand -->
                    <div class="col-span-1 md:col-span-1">
                        <span class="text-xl font-bold text-gray-900 dark:text-white tracking-tight">{{ $profiles['nama_sekolah'] ?? 'Sekolah Kita' }}</span>
                        <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                            {{ $profiles['misi_singkat'] ?? 'Mencerdaskan kehidupan bangsa dan membangun generasi yang unggul dan berakhlak mulia.' }}
                        </p>
                    </div>
                    <!-- Links -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white tracking-wider uppercase">Jelajahi</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="/" class="text-sm text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">Beranda</a></li>
                            <li><a href="/#profil" class="text-sm text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">Profil Sekolah</a></li>
                            <li><a href="{{ route('ppdb.landing') }}" class="text-sm text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">Informasi PPDB</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white tracking-wider uppercase">Informasi</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="{{ route('berita.index') }}" class="text-sm text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">Berita Terbaru</a></li>
                            <li><a href="{{ route('acara.index') }}" class="text-sm text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">Agenda Acara</a></li>
                            <li><a href="{{ route('prestasi.index') }}" class="text-sm text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">Galeri Prestasi</a></li>
                            <li><a href="{{ route('ekstrakurikuler.index') }}" class="text-sm text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">Ekstrakurikuler</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white tracking-wider uppercase">Kontak</h3>
                        <ul class="mt-4 space-y-2">
                            <li class="flex items-start">
                                <span class="mr-2 text-gray-400">📍</span>
                                <a href="{{ $profiles['google_maps_url'] ?? '#' }}" target="_blank" class="text-sm text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">
                                    {{ $profiles['alamat'] ?? 'Jl. Pendidikan No. 1' }}
                                </a>
                            </li>
                            <li class="flex items-center">
                                <span class="mr-2 text-gray-400">📞</span>
                                <a href="tel:{{ $profiles['tlp'] ?? '' }}" class="text-sm text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">
                                    {{ $profiles['tlp'] ?? '(021) 1234567' }}
                                </a>
                            </li>
                            <li class="flex items-center">
                                <span class="mr-2 text-gray-400">✉️</span>
                                <a href="mailto:{{ $profiles['email'] ?? 'info@sekolah.com' }}" class="text-sm text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">
                                    {{ $profiles['email'] ?? 'info@sekolah.com' }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 border-t border-gray-200 dark:border-gray-800 pt-8 flex items-center justify-between">
                    <p class="text-sm text-gray-400 dark:text-gray-500">
                        &copy; {{ date('Y') }} {{ $profiles['nama_sekolah'] ?? 'Sekolah Kita' }}. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Theme Toggle Script -->
    <script>
        // Icons
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        const themeToggleDarkIconMobile = document.getElementById('theme-toggle-dark-icon-mobile');
        const themeToggleLightIconMobile = document.getElementById('theme-toggle-light-icon-mobile');

        // Initial Icon State
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
            if(themeToggleLightIconMobile) themeToggleLightIconMobile.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
            if(themeToggleDarkIconMobile) themeToggleDarkIconMobile.classList.remove('hidden');
        }

        function toggleTheme() {
            // toggle icons
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');
            if(themeToggleDarkIconMobile) themeToggleDarkIconMobile.classList.toggle('hidden');
            if(themeToggleLightIconMobile) themeToggleLightIconMobile.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.theme === 'dark') {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        }

        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeToggleBtnMobile = document.getElementById('theme-toggle-mobile');

        if(themeToggleBtn) {
            themeToggleBtn.addEventListener('click', toggleTheme);
        }
        if(themeToggleBtnMobile) {
            themeToggleBtnMobile.addEventListener('click', toggleTheme);
        }
    </script>
</body>
</html>
