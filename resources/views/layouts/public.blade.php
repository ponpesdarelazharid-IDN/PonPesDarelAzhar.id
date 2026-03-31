<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Beranda') - {{ $profiles['nama_sekolah'] ?? 'Sekolah Kita' }}</title>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('LOGO_DA_new.png') }}">

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

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body class="font-sans antialiased bg-white text-slate-900 dark:bg-[#000000] dark:text-gray-100 transition-colors duration-500">
    <!-- Loading Screen -->
    <div id="loading-screen">
      <img src="{{ asset('LOGO_DA_new.png') }}" alt="Logo Darel Azhar" class="loading-logo">
      <div class="loading-text">MEMUAT...</div>
    </div>

    <nav class="navbar">
        <div class="container">
            <a href="/" class="nav-brand">
                <span class="text-gradient">{{ $profiles['nama_sekolah'] ?? 'Sekolah Kita' }}</span>
            </a>
            <div class="nav-links">
                <a href="/">Beranda</a>
                <a href="/#profil">Profil</a>
                <a href="{{ route('berita.index') }}">Berita</a>
                <a href="{{ route('acara.index') }}">Acara</a>
                <a href="{{ route('prestasi.index') }}">Prestasi</a>
                <a href="{{ route('ekstrakurikuler.index') }}">Ekskul</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-outline" style="padding: 0.5rem 1.25rem;">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline" style="padding: 0.5rem 1.25rem;">Login / Daftar PPDB</a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

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
                        <li><a href="{{ route('ppdb.landing') }}">Informasi PPDB</a></li>
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

    <!-- Script to hide loading screen -->
    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('loading-screen');
            if (loader) {
                loader.style.opacity = '0';
                setTimeout(function() {
                    loader.style.display = 'none';
                }, 500);
            }
        });
    </script>
</body>
</html>
