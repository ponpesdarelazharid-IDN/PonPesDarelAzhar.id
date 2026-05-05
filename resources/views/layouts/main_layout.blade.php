<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'Beranda') - {{ $profiles['nama_sekolah'] ?? 'Sekolah Kita' }}</title>
    
    <!-- Scripts -->
    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            colors: {
              brand: {
                deep: '#2D5A27',
                sage: '#5E8B4E',
                light: '#FDFEF8',
                cream: '#F0F4ED',
                dark: '#1B2E1A',
              },
              emerald: {
                50: '#f0f4ed',
                100: '#dde4d8',
                500: '#2D5A27',
                600: '#1E3D1A',
              }
            }
          }
        }
      }
    </script>
    
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

      /* CSS Safety-net for mobile WebView */
      body {
        overflow-x: hidden !important;
      }
      
      /* NUCLEAR MOBILE CSS - Inlined to bypass cache */
      @media (max-width: 768px) {
          .nav-links {
              position: fixed !important;
              top: 80px !important;
              left: -100% !important;
              width: 100% !important;
              height: calc(100vh - 80px) !important;
              background: #FDFEF8 !important;
              display: flex !important;
              flex-direction: column !important;
              padding: 2rem !important;
              transition: 0.3s ease !important;
              z-index: 9998 !important;
          }
          .nav-links.active {
              left: 0 !important;
          }
          .menu-toggle {
              display: flex !important;
              flex-direction: column !important;
              gap: 5px !important;
              cursor: pointer !important;
              z-index: 9999 !important;
          }
          .menu-toggle span {
              width: 30px !important;
              height: 4px !important;
              background: #2D5A27 !important; /* Forest Green */
              border-radius: 4px !important;
              display: block !important;
          }
          .menu-toggle.active span:nth-child(1) { transform: translateY(9px) rotate(45deg) !important; background: #ef4444 !important; }
          .menu-toggle.active span:nth-child(2) { opacity: 0 !important; }
          .menu-toggle.active span:nth-child(3) { transform: translateY(-9px) rotate(-45deg) !important; background: #ef4444 !important; }
          
          .nav-brand span.mobile-title { display: inline !important; font-size: 1.1rem !important; }
          .nav-brand span.desktop-title { display: none !important; }

    /* Custom Styles for Bottom Nav */
    .bottom-nav {
        position: fixed !important;
        bottom: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 70px !important;
        background: #2D5A27 !important;
        border-top: 3px solid #A8B89C !important;
        display: flex !important;
        justify-content: space-around !important;
        align-items: center !important;
        padding: 5px 0 !important;
        z-index: 9999999 !important;
        box-shadow: 0 -10px 30px rgba(0,0,0,0.8) !important;
        pointer-events: auto !important;
    }
    .nav-item {
        text-align: center !important;
        color: white !important;
        text-decoration: none !important;
        flex: 1 !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 10px !important;
        font-weight: bold !important;
    }
    .nav-item i {
        font-size: 20px !important;
        margin-bottom: 2px !important;
    }
      }
      @media (min-width: 769px) {
          .nav-brand span.mobile-title { display: none !important; }
          .nav-brand span.desktop-title { display: inline !important; }
          .bottom-nav { display: none !important; }
      }
    </style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body class="font-sans antialiased bg-brand-light text-brand-dark dark:bg-[#000000] dark:text-gray-100 transition-colors duration-500">
    <script>console.log('VERSI 1.7 AKTIF');</script>
    <!-- PENANDA VERSI FORCED UPDATE -->
    <div style="background: #2D5A27; color: white; text-align: center; font-weight: bold; padding: 15px; z-index: 10000; position: fixed; top: 0; width: 100%; border-bottom: 5px solid #A8B89C; font-size: 20px;">VERSI UPDATE 2.1 - NEW BRANDING SUCCESS</div>
    
    <!-- Loading Screen -->
    <div id="loading-screen">
      <img src="{{ asset('images/logo-da.png') }}" alt="Logo Darel Azhar" class="loading-logo">
      <div class="loading-text">MEMUAT...</div>
    </div>

    <nav class="navbar">
        <div class="container">
            <a href="/" class="nav-brand flex items-center gap-3 py-2">
                <!-- Logo untuk Light Mode -->
                <img src="{{ asset('images/logo-light.png') }}" alt="Logo Pondok Pesantren Modern Darel Azhar" class="h-24 sm:h-32 lg:h-40 w-auto block dark:hidden object-contain">
                <!-- Logo untuk Dark Mode -->
                <img src="{{ asset('images/logo-dark.png') }}" alt="Logo Pondok Pesantren Modern Darel Azhar" class="h-24 sm:h-32 lg:h-40 w-auto hidden dark:block object-contain">
            </a>
            <div class="nav-links" id="navLinks">
                <a href="/">Beranda</a>
                <a href="/#profil">Profil</a>
                <a href="{{ route('berita.index') }}">Berita</a>
                <a href="{{ route('acara.index') }}">Acara</a>
                <a href="{{ route('prestasi.index') }}">Prestasi</a>
                <a href="{{ route('ekstrakurikuler.index') }}">Ekskul</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-outline" style="padding: 0.5rem 1.25rem;">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline" style="padding: 0.5rem 1.25rem;">Login / Daftar PSB</a>
                @endauth
            </div>
            <div class="flex items-center gap-4">
                <div class="menu-toggle" id="menuToggle" style="z-index: 9999 !important; position: relative; padding: 10px; margin: -10px;">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Bottom Navigation Mobile - FORCED VISIBILITY -->
    <div class="bottom-nav">
        <a href="/" class="bottom-nav-item {{ request()->is('/') ? 'active' : '' }}">
            <span style="font-size: 20px;">🏠</span>
            <span style="font-weight: bold;">Beranda</span>
        </a>
        <a href="{{ route('berita.index') }}" class="bottom-nav-item {{ request()->routeIs('berita.*') ? 'active' : '' }}">
            <span style="font-size: 20px;">📰</span>
            <span>Berita</span>
        </a>
        <a href="{{ route('acara.index') }}" class="bottom-nav-item {{ request()->routeIs('acara.*') ? 'active' : '' }}">
            <span style="font-size: 20px;">📅</span>
            <span>Acara</span>
        </a>
        <a href="{{ route('ppdb.landing') }}" class="bottom-nav-item {{ request()->routeIs('ppdb.*') ? 'active' : '' }}">
            <span style="font-size: 20px;">📝</span>
            <span>PSB</span>
        </a>
        @auth
            <a href="{{ route('dashboard') }}" class="bottom-nav-item">
                <span style="font-size: 20px;">🔐</span>
                <span>Akun</span>
            </a>
        @else
            <a href="{{ route('login') }}" class="bottom-nav-item">
                <span style="font-size: 20px;">🔑</span>
                <span>Login</span>
            </a>
        @endauth
    </div>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-title">{{ $profiles['nama_sekolah'] ?? 'Sekolah Kita' }}</div>
                    <p style="color: var(--gray); margin-bottom: 1.5rem;">
                        {{ $profiles['misi_singkat'] ?? 'Mencerdaskan kehidupan bangsa dan membangun generasi yang unggul dan berakhlak mulia.' }}
                    </p>
                </div>
                <div>
                    <div class="footer-title">Jelajahi</div>
                    <ul class="footer-links">
                        <li><a href="/">Beranda</a></li>
                        <li><a href="/#profil">Profil Sekolah</a></li>
                        <li><a href="{{ route('ppdb.landing') }}">Informasi PSB (Pendaftaran)</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer-title">Informasi</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('berita.index') }}">Berita Terbaru</a></li>
                        <li><a href="{{ route('acara.index') }}">Agenda Acara</a></li>
                        <li><a href="{{ route('prestasi.index') }}">Galeri Prestasi</a></li>
                        <li><a href="{{ route('ekstrakurikuler.index') }}">Ekstrakurikuler</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer-title">Kontak</div>
                    <ul class="footer-links">
                        <li>
                                <a href="{{ $profiles['google_maps_url'] ?? 'https://maps.app.goo.gl/vJkuCxZymQyDgQyN6' }}" target="_blank" style="color: var(--gray); display:flex; gap:0.5rem; align-items:flex-start;">
                                    📍 <span>{{ $profiles['alamat'] ?? 'Jl. Pendidikan No. 1' }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="tel:{{ $profiles['tlp'] ?? '' }}" style="color: var(--gray);">
                                    📞 {{ $profiles['tlp'] ?? '(021) 1234567' }}
                                </a>
                            </li>
                            <li>
                                <a href="mailto:{{ $profiles['email'] ?? 'info@sekolah.com' }}" style="color: var(--gray);">
                                    ✉️ {{ $profiles['email'] ?? 'info@sekolah.com' }}
                                </a>
                            </li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; {{ date('Y') }} {{ $profiles['nama_sekolah'] ?? 'Sekolah Kita' }}. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Script to hide loading screen & Toggle Mobile Menu -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hide Loader
            const loader = document.getElementById('loading-screen');
            if (loader) {
                setTimeout(function() {
                    loader.style.opacity = '0';
                    setTimeout(() => loader.style.display = 'none', 500);
                }, 300);
            }

            // Mobile Menu Toggle
            const menuToggle = document.getElementById('menuToggle');
            const navLinks = document.getElementById('navLinks');

            if(menuToggle && navLinks) {
                menuToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    this.classList.toggle('active');
                    navLinks.classList.toggle('active');
                });

                // Close menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!navLinks.contains(event.target) && !menuToggle.contains(event.target)) {
                        menuToggle.classList.remove('active');
                        navLinks.classList.remove('active');
                    }
                });
            }
        });
    </script>
</body>
</html>
