<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel - ' . ($profiles['nama_sekolah'] ?? 'PonPes Darel Azhar'))</title>

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
                            600: '#059669'
                        },
                        dark: { 
                            main: '#0F172A',
                            card: '#1E293B'
                        }
                    }
                }
            }
        }
        
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="bg-slate-100 dark:bg-[#0a1128] text-slate-900 dark:text-slate-100 font-sans transition-colors duration-300">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white dark:bg-[#111c3a] border-r border-slate-200 dark:border-slate-800 flex flex-col transition-colors duration-300">
            <div class="h-20 flex items-center px-8 border-b border-slate-200 dark:border-slate-800">
                <a href="/" class="text-xl font-bold text-emerald-500 flex items-center gap-2">
                    <span>🕌</span> Admin Panel
                </a>
            </div>
            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }} rounded-xl font-medium transition">
                    📊 Dashboard
                </a>
                <a href="{{ route('admin.registrations.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.registrations.*') ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }} rounded-xl font-medium transition">
                    📝 Data PPDB
                </a>
                <a href="{{ route('admin.posts.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.posts.*') ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }} rounded-xl font-medium transition">
                    📰 Berita & Event
                </a>
                <a href="{{ route('admin.school-profiles.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.school-profiles.*') ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }} rounded-xl font-medium transition">
                    🏫 Profil Sekolah
                </a>
                <a href="{{ route('admin.ekstrakurikuler.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.ekstrakurikuler.*') ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }} rounded-xl font-medium transition">
                    🎨 Ekstrakurikuler
                </a>
                <a href="{{ route('admin.programs.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.programs.*') ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }} rounded-xl font-medium transition">
                    🌟 Program Unggulan
                </a>
                <a href="{{ route('admin.ppdb-settings.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.ppdb-settings.*') ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }} rounded-xl font-medium transition">
                    ⚙️ Pengaturan PPDB
                </a>
            </nav>
            <div class="p-4 border-t border-slate-200 dark:border-slate-800">
                <button onclick="document.documentElement.classList.toggle('dark'); localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-slate-100 dark:bg-slate-800 rounded-lg text-sm transition">
                    <span>🌓</span> Toggle Mode
                </button>
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full py-2 text-sm font-bold text-red-500 hover:bg-red-50 dark:hover:bg-red-900/10 rounded-lg transition uppercase tracking-widest">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-8 relative">
            <!-- Background Glow -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl -z-10"></div>
            
            <div class="mb-8">
                @hasSection('header')
                    @yield('header')
                @endif
            </div>

            @yield('content')
        </main>
    </div>
</body>
</html>
