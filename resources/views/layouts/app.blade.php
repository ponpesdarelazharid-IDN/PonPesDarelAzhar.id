<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Sekolah Kita'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

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
<body class="font-sans antialiased bg-white text-slate-900 dark:bg-[#000000] dark:text-gray-100 transition-colors duration-500">
    <!-- Loading Screen -->
    <div id="loading-screen">
      <img src="{{ asset('images/logo-da.png') }}" alt="Logo Darel Azhar" class="loading-logo">
      <div class="loading-text">MEMUAT...</div>
    </div>

    <div x-data="{ mobileMenuOpen: false }" class="min-h-screen flex flex-col">
        
        <!-- Navbar (Navy/Black Accents) -->
        <nav class="sticky top-0 z-50 bg-white/90 dark:bg-[#000000]/90 backdrop-blur-lg border-b border-slate-200 dark:border-gray-800 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <!-- Logo & Brand -->
                    <div class="flex items-center flex-shrink-0">
                        <a href="/" class="flex items-center gap-3 group whitespace-nowrap">
                            <img src="{{ asset('images/logo-da.png') }}" alt="Logo Darel Azhar" class="w-10 h-auto sm:w-12 group-hover:scale-105 transition-transform duration-300">
                            <span class="font-bold text-lg sm:text-xl tracking-tighter text-[#1e293b] dark:text-white truncate max-w-[150px] sm:max-w-none uppercase">
                                {{ $profiles['nama_sekolah'] ?? 'Darel Azhar' }}
                            </span>
                        </a>
                    </div>
                    
                    <!-- Desktop Main Links -->
                    <div class="hidden lg:flex items-center justify-center flex-1 px-4">
                        <div class="flex items-center space-x-6 shrink-0">
                            <a href="/" class="text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-[#1e293b] dark:text-gray-400 dark:hover:text-white transition-colors relative group">
                                Beranda
                                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#1e293b] dark:bg-white group-hover:w-full transition-all duration-300"></span>
                            </a>
                            <a href="/#profil" class="text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-[#1e293b] dark:text-gray-400 dark:hover:text-white transition-colors relative group">
                                Profil
                                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#1e293b] dark:bg-white group-hover:w-full transition-all duration-300"></span>
                            </a>
                            <a href="{{ route('berita.index') }}" class="text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-[#1e293b] dark:text-gray-400 dark:hover:text-white transition-colors relative group">
                                Berita
                                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#1e293b] dark:bg-white group-hover:w-full transition-all duration-300"></span>
                            </a>
                            <a href="{{ route('prestasi.index') }}" class="text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-[#1e293b] dark:text-gray-400 dark:hover:text-white transition-colors relative group">
                                Prestasi
                                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#1e293b] dark:bg-white group-hover:w-full transition-all duration-300"></span>
                            </a>
                            <a href="{{ route('ekstrakurikuler.index') }}" class="text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-[#1e293b] dark:text-gray-400 dark:hover:text-white transition-colors relative group">
                                Ekskul
                                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#1e293b] dark:bg-white group-hover:w-full transition-all duration-300"></span>
                            </a>
                            <a href="{{ route('ppdb.landing') }}" class="text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-[#1e293b] dark:text-gray-400 dark:hover:text-white transition-colors relative group">
                                PPDB
                                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#1e293b] dark:bg-white group-hover:w-full transition-all duration-300"></span>
                            </a>
                        </div>
                    </div>

                    <!-- Right Side (Theme Toggle + Auth Link) -->
                    <div class="hidden md:flex items-center space-x-6">
                        <!-- Theme Toggle Button -->
                        <button id="theme-toggle" type="button" class="w-10 h-10 flex items-center justify-center text-slate-500 dark:text-gray-400 hover:bg-slate-100 dark:hover:bg-gray-800 rounded-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white">
                            <!-- Sun Icon -->
                            <svg id="theme-toggle-light-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path></svg>
                            <!-- Moon Icon -->
                            <svg id="theme-toggle-dark-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        </button>

                        @auth
                            <div class="flex items-center gap-3">
                                @if(auth()->check() && strtolower(auth()->user()->role) === 'admin' && request()->is('admin*'))
                                    <div x-data="{ adminDropdown: false }" class="relative">
                                        <button @click="adminDropdown = !adminDropdown" @click.away="adminDropdown = false" class="flex items-center gap-2 px-4 py-2 text-[10px] font-black uppercase tracking-widest text-[#1e293b] dark:text-white bg-slate-100 dark:bg-white/10 rounded-lg hover:bg-slate-200 dark:hover:bg-white/20 transition shadow-sm border border-slate-200 dark:border-gray-800">
                                            Admin Menu
                                            <svg class="w-3 h-3 transition-transform" :class="adminDropdown ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                        </button>
                                        
                                        <div x-show="adminDropdown" x-transition class="absolute right-0 mt-2 w-56 bg-white dark:bg-[#0a0a0a] border border-slate-100 dark:border-gray-800 rounded-2xl shadow-2xl py-2 z-50">
                                            <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 text-xs font-bold text-slate-600 dark:text-gray-400 hover:bg-slate-50 dark:hover:bg-white/5 uppercase tracking-widest transition">Overview Panel</a>
                                            <a href="{{ route('admin.school-profiles.index') }}" class="block px-6 py-3 text-xs font-bold text-slate-600 dark:text-gray-400 hover:bg-slate-50 dark:hover:bg-white/5 uppercase tracking-widest transition">Profil Sekolah</a>
                                            <a href="{{ route('admin.ekstrakurikuler.index') }}" class="block px-6 py-3 text-xs font-bold text-slate-600 dark:text-gray-400 hover:bg-slate-50 dark:hover:bg-white/5 uppercase tracking-widest transition">Kelola Ekskul</a>
                                            <a href="{{ route('admin.ppdb-settings.index') }}" class="block px-6 py-3 text-xs font-bold text-blue-600 dark:text-white hover:bg-slate-50 dark:hover:bg-white/5 uppercase tracking-widest transition">Aktifasi PPDB</a>
                                            <a href="{{ route('admin.posts.index') }}" class="block px-6 py-3 text-xs font-bold text-slate-600 dark:text-gray-400 hover:bg-slate-50 dark:hover:bg-white/5 uppercase tracking-widest transition">Kelola Berita</a>
                                            <div class="border-t border-slate-100 dark:border-gray-800 my-1"></div>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="w-full text-left px-6 py-3 text-xs font-bold text-red-500 hover:bg-red-50 dark:hover:bg-red-900/10 uppercase tracking-widest transition">Logout</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                                
                                <a href="{{ (auth()->check() && strtolower(auth()->user()->role) === 'admin') ? route('admin.dashboard') : route('dashboard') }}" class="hidden sm:inline-flex px-5 py-2.5 text-xs font-black rounded-full text-white bg-[#1e293b] hover:bg-black dark:bg-white dark:text-black dark:hover:bg-gray-200 shadow-xl transition-all duration-300 uppercase tracking-widest">
                                    Dashboard
                                </a>
                            </div>
                        @else
                            <div class="flex items-center gap-4">
                                <a href="{{ route('login') }}" class="text-sm font-bold text-[#1e293b] dark:text-white hover:opacity-80 transition-opacity">Login</a>
                                <a href="{{ route('register') }}" class="px-6 py-2.5 text-sm font-bold rounded-full text-white bg-[#1e293b] hover:bg-black dark:bg-white dark:text-black dark:hover:bg-gray-200 shadow-xl transition-all duration-300">
                                    Daftar
                                </a>
                            </div>
                        @endauth
                    </div>

                    <!-- Mobile menu button -->
                    <div class="flex items-center md:hidden gap-3">
                        <button id="theme-toggle-mobile" type="button" class="text-slate-500 dark:text-gray-400 hover:bg-slate-100 dark:hover:bg-gray-800 rounded-xl p-2.5 transition">
                            <svg id="theme-toggle-light-icon-mobile" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path></svg>
                            <svg id="theme-toggle-dark-icon-mobile" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        </button>
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 hover:text-[#1e293b] hover:bg-slate-100 dark:hover:bg-gray-800 dark:hover:text-white transition-all">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': !mobileMenuOpen, 'inline-flex': mobileMenuOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="md:hidden border-t border-slate-100 dark:border-gray-900 bg-white dark:bg-[#000000] shadow-2xl" style="display: none;">
                <div class="pt-4 pb-6 space-y-2">
                    <a href="/" class="block pl-6 pr-4 py-3 text-base font-bold text-slate-600 hover:text-[#1e293b] hover:bg-slate-50 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-900 transition">Beranda</a>
                    <a href="/#profil" class="block pl-6 pr-4 py-3 text-base font-bold text-slate-600 hover:text-[#1e293b] hover:bg-slate-50 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-900 transition">Profil</a>
                    <a href="{{ route('berita.index') }}" class="block pl-6 pr-4 py-3 text-base font-bold text-slate-600 hover:text-[#1e293b] hover:bg-slate-50 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-900 transition">Berita</a>
                    <a href="{{ route('prestasi.index') }}" class="block pl-6 pr-4 py-3 text-base font-bold text-slate-600 hover:text-[#1e293b] hover:bg-slate-50 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-900 transition">Prestasi</a>
                    <a href="{{ route('ekstrakurikuler.index') }}" class="block pl-6 pr-4 py-3 text-base font-bold text-slate-600 hover:text-[#1e293b] hover:bg-slate-50 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-900 transition">Ekskul</a>
                    <a href="{{ route('ppdb.landing') }}" class="block pl-6 pr-4 py-3 text-base font-bold text-slate-600 hover:text-[#1e293b] hover:bg-slate-50 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-900 transition">PPDB</a>
                </div>
                <div class="pt-6 pb-8 border-t border-slate-100 dark:border-gray-900 px-6 space-y-4">
                    @auth
                        @if(auth()->check() && strtolower(auth()->user()->role) === 'admin' && request()->is('admin*'))
                            <div class="space-y-2 mb-6">
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-gray-500 mb-4 px-2">Manajemen Sekolah</p>
                                <a href="{{ route('admin.dashboard') }}" class="block w-full py-3 px-6 rounded-2xl bg-blue-600 text-white font-bold text-center shadow-lg transition">Panel Admin</a>
                                <a href="{{ route('admin.school-profiles.index') }}" class="block w-full py-3 px-6 rounded-2xl bg-white dark:bg-white/5 border border-slate-200 dark:border-gray-800 text-slate-700 dark:text-white font-bold text-center transition">Profil Sekolah</a>
                                <a href="{{ route('admin.ekstrakurikuler.index') }}" class="block w-full py-3 px-6 rounded-2xl bg-white dark:bg-white/5 border border-slate-200 dark:border-gray-800 text-slate-700 dark:text-white font-bold text-center transition">Kelola Ekskul</a>
                                <a href="{{ route('admin.ppdb-settings.index') }}" class="block w-full py-3 px-6 rounded-2xl bg-white dark:bg-white/5 border border-slate-200 dark:border-gray-800 text-slate-700 dark:text-white font-bold text-center transition">Aktifasi PPDB</a>
                            </div>
                        @endif

                        <a href="{{ (auth()->check() && strtolower(auth()->user()->role) === 'admin') ? route('admin.dashboard') : route('dashboard') }}" class="block w-full text-center py-4 px-4 rounded-2xl text-white bg-[#1e293b] hover:bg-black dark:bg-white dark:text-black font-extrabold shadow-xl transition uppercase tracking-widest text-xs">Buka Dashboard</a>
                        
                        <form method="POST" action="{{ route('logout') }}" class="mt-4">
                            @csrf
                            <button type="submit" class="w-full text-center py-3 text-xs font-bold text-red-500 uppercase tracking-widest">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center py-3.5 px-4 rounded-2xl text-[#1e293b] bg-slate-100 dark:bg-gray-900 dark:text-white font-bold transition">Login</a>
                        <a href="{{ route('register') }}" class="block w-full text-center py-3.5 px-4 rounded-2xl text-white bg-[#1e293b] hover:bg-black dark:bg-white dark:text-black font-bold shadow-lg transition">Daftar</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Page Heading (Optional) -->
        @hasSection('header')
            <header class="bg-slate-50 dark:bg-[#000000] border-b border-slate-100 dark:border-gray-900 transition-colors">
                <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        <!-- Main Content (with subtle entry animation) -->
        <main class="flex-grow">
            <div class="animate-in fade-in slide-in-from-bottom-4 duration-700">
                @yield('content')
                
                @if(isset($slot))
                    {{ $slot }}
                @endif
            </div>
        </main>

        <!-- Footer (Premium & All-Black) -->
        <footer class="bg-slate-50 dark:bg-[#000000] border-t border-slate-100 dark:border-gray-900 mt-auto transition-colors">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                    <!-- Brand -->
                    <div class="col-span-1 md:col-span-1">
                        <span class="text-2xl font-extrabold text-[#1e293b] dark:text-white tracking-tighter">{{ $profiles['nama_sekolah'] ?? 'Sekolah Kita' }}</span>
                        <p class="mt-6 text-sm text-slate-500 dark:text-gray-400 leading-relaxed">
                            {{ $profiles['misi_singkat'] ?? 'Mencerdaskan kehidupan bangsa dan membangun generasi yang unggul dan berakhlak mulia melalui pendidikan berkualitas.' }}
                        </p>
                    </div>
                    <!-- Links -->
                    <div>
                        <h3 class="text-xs font-black text-[#1e293b] dark:text-white tracking-widest uppercase">Jelajahi</h3>
                        <ul class="mt-6 space-y-4">
                            <li><a href="/" class="text-sm text-slate-500 hover:text-[#1e293b] dark:text-gray-400 dark:hover:text-white transition-colors">Beranda</a></li>
                            <li><a href="/#profil" class="text-sm text-slate-500 hover:text-[#1e293b] dark:text-gray-400 dark:hover:text-white transition-colors">Profil Sekolah</a></li>
                            <li><a href="{{ route('ppdb.landing') }}" class="text-sm text-slate-500 hover:text-[#1e293b] dark:text-gray-400 dark:hover:text-white transition-colors">Informasi PPDB</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xs font-black text-[#1e293b] dark:text-white tracking-widest uppercase">Informasi</h3>
                        <ul class="mt-6 space-y-4">
                            <li><a href="{{ route('berita.index') }}" class="text-sm text-slate-500 hover:text-[#1e293b] dark:text-gray-400 dark:hover:text-white transition-colors">Berita Terbaru</a></li>
                            <li><a href="{{ route('acara.index') }}" class="text-sm text-slate-500 hover:text-[#1e293b] dark:text-gray-400 dark:hover:text-white transition-colors">Agenda Acara</a></li>
                            <li><a href="{{ route('prestasi.index') }}" class="text-sm text-slate-500 hover:text-[#1e293b] dark:text-gray-400 dark:hover:text-white transition-colors">Galeri Prestasi</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xs font-black text-[#1e293b] dark:text-white tracking-widest uppercase">Hubungi Kami</h3>
                        <ul class="mt-6 space-y-4">
                            <li class="flex items-start text-sm text-slate-500 dark:text-gray-400">
                                <span class="mr-3 opacity-50">📍</span>
                                <span>{{ $profiles['alamat'] ?? 'Jl. Komp. Pendidikan No. RT 08/09, Banten' }}</span>
                            </li>
                            <li class="flex items-center text-sm text-slate-500 dark:text-gray-400">
                                <span class="mr-3 opacity-50">📞</span>
                                <span>{{ $profiles['tlp'] ?? '(021) 1234567' }}</span>
                            </li>
                            <li class="flex items-center text-sm text-slate-500 dark:text-gray-400">
                                <span class="mr-3 opacity-50">✉️</span>
                                <span>{{ $profiles['email'] ?? 'info@sekolah.com' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-16 border-t border-slate-100 dark:border-gray-900 pt-10 flex flex-col md:flex-row items-center justify-between gap-6">
                    <p class="text-sm text-slate-400 dark:text-gray-600">
                        &copy; {{ date('Y') }} {{ $profiles['nama_sekolah'] ?? 'Sekolah Kita' }}. Premium Web Experience.
                    </p>
                    <div class="flex gap-6">
                        <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-gray-900 flex items-center justify-center text-[#1e293b] dark:text-white hover:scale-110 transition-transform cursor-pointer">f</div>
                        <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-gray-900 flex items-center justify-center text-[#1e293b] dark:text-white hover:scale-110 transition-transform cursor-pointer">i</div>
                        <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-gray-900 flex items-center justify-center text-[#1e293b] dark:text-white hover:scale-110 transition-transform cursor-pointer">y</div>
                    </div>
                </div>
            </div>
        </footer>
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
    
    <!-- Script to hide loading screen -->
    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('loading-screen');
            loader.style.opacity = '0';
            setTimeout(function() {
                loader.style.display = 'none';
            }, 500);
        });
    </script>
</body>
</html>
