@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>Membangun <br><span class="text-gradient">Generasi Unggul</span><br> & Berkarakter</h1>
            <p>{{ $profiles['visi'] ?? 'Menjadi sekolah terdepan dalam inovasi teknologi dan pembentukan karakter mulia di tingkat nasional.' }}</p>
            <div class="hero-buttons">
                @if($ppdb)
                    <a href="{{ route('ppdb.landing') }}" class="btn btn-primary">Daftar PPDB Sekarang</a>
                @endif
                <a href="#profil" class="btn btn-outline">Pelajari Profil Kami</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Siswa Sekolah">
        </div>
    </div>
</section>

<!-- Profil Singkat -->
<section id="profil" class="section section-alt">
    <div class="container">
        <div class="section-header">
            <h2 class="text-gradient">Profil Sekolah</h2>
            <p>Sejarah singkat dan tujuan kami mendidik putra-putri bangsa.</p>
        </div>
        <div class="grid-3">
            <div class="glass-card">
                <div class="card-icon">🎯</div>
                <h3>Sejarah</h3>
                <p style="color: var(--gray);">{{ $profiles['sejarah'] ?? 'Didirikan dengan semangat mencerdaskan anak bangsa melalui pendidikan berkualitas tinggi.' }}</p>
            </div>
            <div class="glass-card">
                <div class="card-icon">🚀</div>
                <h3>Tujuan</h3>
                <p style="color: var(--gray);">{{ $profiles['tujuan'] ?? 'Menghasilkan lulusan yang siap kerja, mandiri, dan mampu bersaing di era digital.' }}</p>
            </div>
            <div class="glass-card">
                <div class="card-icon">💡</div>
                <h3>Visi Misi</h3>
                <p style="color: var(--gray);">{{ $profiles['misi_singkat'] ?? 'Mengintegrasikan teknologi ke dalam setiap proses pembelajaran untuk mencetak innovator.' }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Berita Terbaru -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Berita & <span class="text-gradient">Artikel</span></h2>
        </div>
        <div class="grid-3">
            @forelse($berita as $post)
            <div class="news-card">
                @if($post->image_url)
                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="news-img">
                @else
                    <div class="news-img" style="display:flex;align-items:center;justify-content:center;color:var(--gray);font-size:3rem;">📰</div>
                @endif
                <div class="news-content">
                    <div class="news-meta">{{ $post->published_at->format('d M Y') }}</div>
                    <a href="{{ route('posts.show', $post) }}" style="text-decoration:none;color:inherit;">
                        <h3 style="font-size: 1.25rem;">{{ $post->title }}</h3>
                        <p style="color: var(--gray); font-size: 0.95rem;">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 80) }}</p>
                    </a>
                </div>
            </div>
            @empty
            <p style="color:var(--gray);text-align:center;grid-column:1/-1;">Belum ada berita terbaru.</p>
            @endforelse
        </div>
        @if($berita->count() > 0)
        <div style="text-align:center; margin-top: 3rem;">
            <a href="{{ route('berita.index') }}" class="btn btn-outline">Lihat Semua Berita</a>
        </div>
        @endif
    </div>
</section>

@if($ekskul->count() > 0)
<!-- Ekstrakurikuler -->
<section class="section section-alt" style="background: var(--white);">
    <div class="container">
        <div class="section-header">
            <h2>Ekstrakurikuler & <span class="text-gradient">Kegiatan Tambahan</span></h2>
        </div>
        <div class="grid-3">
            @foreach($ekskul as $post)
            <div class="news-card">
                @if($post->image_url)
                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="news-img">
                @else
                    <div class="news-img" style="display:flex;align-items:center;justify-content:center;color:var(--gray);font-size:3rem;background:var(--light);">🎨</div>
                @endif
                <div class="news-content">
                    <div class="news-meta">{{ $post->published_at->format('d M Y') }}</div>
                    <a href="{{ route('posts.show', $post) }}" style="text-decoration:none;color:inherit;">
                        <h3 style="font-size: 1.25rem;">{{ $post->title }}</h3>
                        <p style="color: var(--gray); font-size: 0.95rem;">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 80) }}</p>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div style="text-align:center; margin-top: 3rem;">
            <a href="{{ route('ekstrakurikuler.index') }}" class="btn btn-outline">Lihat Semua Kegiatan</a>
        </div>
    </div>
</section>
@endif

<!-- Lokasi & Peta -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Lokasi <span class="text-gradient">Sekolah</span></h2>
            <p>{{ $profiles['alamat'] ?? 'Jl. Komp. Pendidikan No.RT 08/09, Muara Ciujung Tim., Kec. Rangkasbitung, Kabupaten Lebak, Banten 42314' }}</p>
        </div>
        
        <div class="glass-card" style="padding: 0; overflow: hidden; height: 450px; border-radius: 24px; position: relative;">
            @if(isset($profiles['google_maps_embed']))
                <iframe src="{{ $profiles['google_maps_embed'] }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            @else
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m12!1m3!1d3964.123!2d106.255838!3d-6.357415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4210d60acf4ec5%3A0xd8e9280ff075d346!2sPondok%20Pesantren%20Modern%20Darel%20Azhar!5e0!3m2!1sid!2sid!4v1711700000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            @endif
            
            <div style="position: absolute; bottom: 20px; right: 20px;">
                <a href="{{ $profiles['google_maps_url'] ?? 'https://maps.app.goo.gl/vJkuCxZymQyDgQyN6' }}" target="_blank" class="btn btn-primary" style="box-shadow: 0 10px 20px rgba(0,0,0,0.2);">
                    Buka di Google Maps
                </a>
            </div>
        </div>
    </div>
</section>

<!-- PPDB CTA -->
<section class="section">
    <div class="container">
        <div class="ppdb-banner">
            <h2>Penerimaan Peserta Didik Baru</h2>
            @if($ppdb)
            <p>Pendaftaran PPDB Tahun Ajaran {{ $ppdb->academic_year }} sedang dibuka. Jangan lewatkan kesempatan emas ini.</p>
            <a href="{{ route('ppdb.landing') }}" class="btn btn-primary" style="background: white; color: var(--primary);">
                Informasi & Pendaftaran PPDB
            </a>
            @else
            <p>Pendaftaran PPDB saat ini sedang ditutup. Nantikan informasi dari kami selanjutnya.</p>
            <button class="btn btn-outline" style="border-color: rgba(255,255,255,0.3); color: white;" disabled>Pendaftaran Ditutup</button>
            @endif
        </div>
    </div>
</section>

@endsection
