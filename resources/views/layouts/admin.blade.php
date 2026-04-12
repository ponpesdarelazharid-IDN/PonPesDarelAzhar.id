<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full py-2 text-sm font-bold text-red-500 hover:bg-red-50 dark:hover:bg-red-900/10 rounded-lg transition uppercase tracking-widest">Logout</button>
                </form>
            </div>
        </aside>

    <!-- Page Content -->
    <main class="flex-1 p-6 md:p-12 overflow-y-auto min-h-screen bg-slate-50 dark:bg-dark-main transition-colors duration-500">
        <!-- Breadcrumbs / Top Bar -->
        <div class="mb-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 flex items-center gap-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-500 transition">Admin</a>
                <span class="opacity-30 text-xs">/</span>
                @if(View::hasSection('breadcrumb'))
                    @yield('breadcrumb')
                    <span class="opacity-30 text-xs">/</span>
                @endif
                <span class="text-emerald-500">@yield('title', 'Overview')</span>
            </div>
            <div class="flex items-center gap-4">
                <button id="dark-toggle" onclick="document.documentElement.classList.toggle('dark'); localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';" class="w-10 h-10 rounded-xl bg-white dark:bg-slate-800 shadow-sm border border-slate-100 dark:border-slate-800 flex items-center justify-center text-lg transition-transform hover:rotate-12">🌓</button>
            </div>
        </div>

        <!-- Page Header Slot -->
        @if(View::hasSection('header'))
            <div class="mb-10 animate-fade-in-down">
                @yield('header')
            </div>
        @endif

        <!-- Global Notifications (Premium Style) -->
        @if(session('success') || session('error') || $errors->any())
            <div class="fixed top-8 right-8 z-[100] w-full max-w-sm space-y-4 animate-slide-in">
                @if(session('success'))
                    <div class="p-5 rounded-[24px] bg-emerald-500 text-white shadow-2xl shadow-emerald-500/30 flex items-center gap-4 border border-white/20">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-xl">✨</div>
                        <div class="flex-1">
                            <p class="text-[10px] font-black uppercase tracking-widest opacity-70">Berhasil</p>
                            <p class="font-bold text-sm leading-tight">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error') || $errors->any())
                    <div class="p-5 rounded-[24px] bg-red-500 text-white shadow-2xl shadow-red-500/30 flex items-center gap-4 border border-white/20">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-xl">⚠️</div>
                        <div class="flex-1">
                            <p class="text-[10px] font-black uppercase tracking-widest opacity-70">Kesalahan</p>
                            <p class="font-bold text-sm leading-tight">
                                {{ session('error') ?: 'Terdapat beberapa kesalahan pada input Anda.' }}
                            </p>
                        </div>
                    </div>
                @endif
            </div>
            <script>
                setTimeout(() => {
                    document.querySelectorAll('.animate-slide-in').forEach(el => {
                        el.style.opacity = '0';
                        el.style.transform = 'translateX(100%)';
                        el.style.transition = 'all 0.5s ease-in-out';
                        setTimeout(() => el.remove(), 500);
                    });
                }, 5000);
            </script>
        @endif

        <div class="container mx-auto">
            @yield('content')
        </div>
    </main>

    <!-- Global Image Compression Helper -->
    <script>
        async function compressImageToBase64(file, maxDimension = 1200, quality = 0.8) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = (event) => {
                    const img = new Image();
                    img.src = event.target.result;
                    img.onload = () => {
                        const canvas = document.createElement('canvas');
                        let width = img.width;
                        let height = img.height;

                        if (width > maxDimension || height > maxDimension) {
                            if (width > height) {
                                height = Math.round((height * maxDimension) / width);
                                width = maxDimension;
                            } else {
                                width = Math.round((width * maxDimension) / height);
                                height = maxDimension;
                            }
                        }

                        canvas.width = width;
                        canvas.height = height;
                        const ctx = canvas.getContext('2d');
                        ctx.imageSmoothingEnabled = true;
                        ctx.imageSmoothingQuality = 'high';
                        ctx.drawImage(img, 0, 0, width, height);
                        
                        // Use original mime type if possible, default to jpeg
                        const mimeType = file.type === 'image/png' ? 'image/png' : 'image/jpeg';
                        resolve(canvas.toDataURL(mimeType, quality));
                    };
                };
                reader.onerror = reject;
            });
        }
    </script>

    <style>
        @keyframes slide-in {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes fade-in-down {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .animate-slide-in { animation: slide-in 0.5s ease-out; }
        .animate-fade-in-down { animation: fade-in-down 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    </style>

</body>
</html>
