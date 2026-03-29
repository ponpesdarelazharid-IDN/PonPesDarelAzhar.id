@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative bg-white dark:bg-black overflow-hidden transition-colors duration-300 border-b border-gray-100 dark:border-gray-900">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 bg-white dark:bg-black sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 transition-colors duration-300">
            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                <div class="sm:text-center lg:text-left">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white sm:text-5xl md:text-6xl transition-colors duration-300">
                        <span class="block">Membangun</span>
                        <span class="block text-blue-600 dark:text-gray-300">Generasi Unggul</span>
                        <span class="block">& Berkarakter</span>
                    </h1>
                    <p class="mt-3 text-base text-gray-500 dark:text-gray-400 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0 transition-colors duration-300">
                        {{ $profiles['visi'] ?? 'Menjadi sekolah terdepan dalam inovasi teknologi dan pembentukan karakter mulia di tingkat nasional.' }}
                    </p>
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                        @if($ppdb)
                        <div class="rounded-md shadow">
                            <a href="{{ route('ppdb.landing') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 dark:bg-white dark:text-black dark:hover:bg-gray-200 transition md:py-4 md:text-lg">
                                Daftar PPDB Sekarang
                            </a>
                        </div>
                        @endif
                        <div class="mt-3 sm:mt-0 sm:ml-3">
                            <a href="#profil" class="w-full flex items-center justify-center px-8 py-3 border border-gray-300 dark:border-gray-700 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-transparent dark:text-gray-300 dark:hover:bg-gray-900 dark:hover:text-white transition md:py-4 md:text-lg">
                                Pelajari Profil Kami
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full opacity-90 dark:opacity-70" src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Siswa Sekolah">
    </div>
</section>

<!-- Tentang Kami (Sejarah & Profil) -->
<section id="profil" class="py-16 bg-gray-50 dark:bg-[#0a0a0a] transition-colors duration-300 border-b border-gray-100 dark:border-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:flex lg:items-center lg:gap-12">
            <div class="lg:w-1/2 mb-10 lg:mb-0 text-center lg:text-left">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl transition-colors duration-300 mb-6">Tentang Kami</h2>
                <div class="prose prose-lg dark:prose-invert max-w-none text-gray-600 dark:text-gray-400">
                    <p class="mb-4 text-justify">
                        {{ $profiles['tentang_kami'] ?? 'Sekolah kami adalah lembaga pendidikan yang berdedikasi untuk mencetak generasi pemimpin masa depan yang bertaqwa, cerdas, dan kompetitif.' }}
                    </p>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Sejarah Singkat</h3>
                    <p class="text-justify">
                        {{ $profiles['sejarah'] ?? 'Didirikan dengan semangat mencerdaskan anak bangsa melalui pendidikan berkualitas tinggi yang mengintegrasikan nilai-nilai luhur dan teknologi modern.' }}
                    </p>
                </div>
            </div>
            <div class="lg:w-1/2">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl transition transform hover:scale-[1.02]">
                    <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Gedung Sekolah" class="w-full h-80 object-cover">
                    <div class="absolute inset-0 bg-blue-600/10 dark:bg-black/20"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi, Misi & Tujuan -->
<section class="py-16 bg-white dark:bg-black transition-colors duration-300 border-b border-gray-100 dark:border-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 uppercase tracking-tighter">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-5xl">Visi & Misi</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="relative p-10 bg-gray-50 dark:bg-[#0a0a0a] rounded-3xl border border-gray-100 dark:border-gray-800 group hover:-translate-y-2 transition duration-500 shadow-xl">
                <div class="absolute -top-6 left-1/2 -translate-x-1/2 w-14 h-14 bg-[#1e293b] dark:bg-white rounded-2xl flex items-center justify-center text-white dark:text-black shadow-lg">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                </div>
                <h3 class="text-3xl font-black text-center mt-6 mb-6 text-[#1e293b] dark:text-white uppercase tracking-tight">Visi</h3>
                <p class="text-lg text-slate-600 dark:text-gray-400 text-center leading-relaxed font-medium">
                    {{ $profiles['visi'] ?? 'Menjadi pusat keunggulan pendidikan yang menghasilkan lulusan berkarakter, inovatif, dan berwawasan global.' }}
                </p>
            </div>
            
            <div class="relative p-10 bg-gray-50 dark:bg-[#0a0a0a] rounded-3xl border border-gray-100 dark:border-gray-800 group hover:-translate-y-2 transition duration-500 shadow-xl">
                <div class="absolute -top-6 left-1/2 -translate-x-1/2 w-14 h-14 bg-[#1e293b] dark:bg-white rounded-2xl flex items-center justify-center text-white dark:text-black shadow-lg">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                </div>
                <h3 class="text-3xl font-black text-center mt-6 mb-6 text-[#1e293b] dark:text-white uppercase tracking-tight">Misi</h3>
                <div class="text-slate-600 dark:text-gray-400 text-base leading-relaxed font-medium space-y-3">
                    @if(isset($profiles['misi']))
                        @foreach(explode("\n", $profiles['misi']) as $misi_point)
                            @if(trim($misi_point))
                                <div class="flex items-start gap-3">
                                    <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-[#1e293b] dark:bg-white flex-shrink-0"></span>
                                    <span>{{ trim($misi_point) }}</span>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="flex items-start gap-3">
                            <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-[#1e293b] dark:bg-white flex-shrink-0"></span>
                            <span>Menyelenggarakan pendidikan yang berkualitas.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-[#1e293b] dark:bg-white flex-shrink-0"></span>
                            <span>Membentuk karakter siswa yang religius.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-[#1e293b] dark:bg-white flex-shrink-0"></span>
                            <span>Mengembangkan potensi minat dan bakat.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Berita Terbaru -->
<section class="py-16 bg-white dark:bg-black transition-colors duration-300 border-b border-gray-100 dark:border-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white transition-colors duration-300">Berita & Artikel</h2>
        </div>
        
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            @forelse($berita as $post)
            <a href="{{ route('posts.show', $post) }}" class="group block bg-gray-50 dark:bg-[#0a0a0a] rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-800 hover:shadow-lg dark:hover:shadow-white/10 transition duration-300">
                @if($post->image_url)
                    <div class="aspect-w-16 aspect-h-9 w-full bg-gray-200 dark:bg-gray-800">
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="object-cover w-full h-48 group-hover:scale-105 transition duration-500">
                    </div>
                @else
                    <div class="aspect-w-16 aspect-h-9 w-full bg-gray-200 dark:bg-gray-800 flex items-center justify-center h-48">
                        <span class="text-4xl opacity-50">📰</span>
                    </div>
                @endif
                <div class="p-6">
                    <div class="text-sm text-blue-600 dark:text-gray-400 font-semibold mb-2 transition-colors">{{ $post->published_at->format('d M Y') }}</div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-gray-300 transition-colors">{{ $post->title }}</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm transition-colors">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 80) }}</p>
                </div>
            </a>
            @empty
            <div class="col-span-1 md:col-span-3 text-center py-12">
                <p class="text-gray-500 dark:text-gray-400 transition-colors">Belum ada berita terbaru.</p>
            </div>
            @endforelse
        </div>
        
        @if($berita->count() > 0)
        <div class="mt-12 text-center">
            <a href="{{ route('berita.index') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-700 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-transparent dark:text-gray-300 dark:hover:bg-gray-900 transition">
                Lihat Semua Berita
            </a>
        </div>
        @endif
    </div>
</section>

<!-- Acara Mendatang -->
<section class="py-16 bg-white dark:bg-black transition-colors duration-300 border-b border-gray-100 dark:border-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white transition-colors duration-300">Acara Mendatang</h2>
            <p class="mt-4 text-gray-500 dark:text-gray-400">Ikuti berbagai agenda dan kegiatan seru di sekolah kami.</p>
        </div>
        
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            @forelse($acara as $post)
            <div class="group relative bg-gray-50 dark:bg-[#0a0a0a] rounded-2xl p-8 border border-gray-100 dark:border-gray-800 hover:border-blue-500 dark:hover:border-gray-600 transition-all duration-300">
                <div class="flex items-center gap-4 mb-4">
                    <div class="flex-shrink-0 w-14 h-14 bg-blue-100 dark:bg-gray-800 rounded-xl flex flex-col items-center justify-center text-blue-600 dark:text-gray-300">
                        <span class="text-lg font-bold leading-none">{{ $post->published_at->format('d') }}</span>
                        <span class="text-xs uppercase font-semibold">{{ $post->published_at->format('M') }}</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-gray-300 transition-colors">{{ $post->title }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $post->event_date ? $post->event_date->format('H:i') . ' WIB' : 'Waktu menyusul' }}</p>
                    </div>
                </div>
                <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-3 mb-6">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center text-sm font-bold text-blue-600 dark:text-gray-300 hover:gap-2 transition-all">
                    Detail Acara 
                    <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
            @empty
            <div class="col-span-1 md:col-span-3 text-center py-12">
                <p class="text-gray-500 dark:text-gray-400">Belum ada agenda acara terbaru.</p>
            </div>
            @endforelse
        </div>
        
        @if($acara->count() > 0)
        <div class="mt-12 text-center">
            <a href="{{ route('acara.index') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-700 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-transparent dark:text-gray-300 dark:hover:bg-gray-900 transition">
                Lihat Semua Acara
            </a>
        </div>
        @endif
    </div>
</section>

<!-- Prestasi Unggulan -->
<section class="py-16 bg-gray-50 dark:bg-[#0a0a0a] transition-colors duration-300 border-b border-gray-100 dark:border-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white transition-colors duration-300">Prestasi Unggulan</h2>
            <p class="mt-4 text-gray-500 dark:text-gray-400">Fasilitas dan pencapaian terbaik putra-putri didik kami.</p>
        </div>
        
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            @forelse($prestasi as $post)
            <div class="bg-white dark:bg-black rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 group border border-gray-100 dark:border-gray-800">
                <div class="relative h-64 overflow-hidden">
                    @if($post->image_url)
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    @else
                        <div class="w-full h-full bg-blue-600 flex items-center justify-center text-6xl">🏆</div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end p-6">
                        <h3 class="text-xl font-bold text-white">{{ $post->title }}</h3>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-500 dark:text-gray-400 text-sm mb-4 line-clamp-2">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 100) }}</p>
                    <a href="{{ route('posts.show', $post) }}" class="text-blue-600 dark:text-gray-300 font-semibold hover:underline">Baca Selengkapnya &rarr;</a>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-3 text-center py-12">
                <p class="text-gray-500 dark:text-gray-400">Belum ada data prestasi yang ditampilkan.</p>
            </div>
            @endforelse
        </div>
        
        @if($prestasi->count() > 0)
        <div class="mt-12 text-center">
            <a href="{{ route('prestasi.index') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-700 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-transparent dark:text-gray-300 dark:hover:bg-gray-900 transition">
                Lihat Semua Prestasi
            </a>
        </div>
        @endif
    </div>
</section>

@if($ekskul->count() > 0)
<!-- Ekstrakurikuler -->
<section class="py-16 bg-white dark:bg-black transition-colors duration-300 border-b border-gray-100 dark:border-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white transition-colors duration-300">Ekstrakurikuler</h2>
        </div>
        
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            @foreach($ekskul as $post)
            <a href="{{ route('posts.show', $post) }}" class="group block bg-gray-50 dark:bg-[#0a0a0a] rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-800 hover:shadow-lg dark:hover:shadow-white/10 transition duration-300">
                @if($post->image_url)
                    <div class="aspect-w-16 aspect-h-9 w-full bg-gray-200 dark:bg-gray-800">
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="object-cover w-full h-48 group-hover:scale-105 transition duration-500">
                    </div>
                @else
                    <div class="aspect-w-16 aspect-h-9 w-full bg-gray-200 dark:bg-gray-800 flex items-center justify-center h-48">
                        <span class="text-4xl opacity-50">🎨</span>
                    </div>
                @endif
                <div class="p-6">
                    <div class="text-sm text-blue-600 dark:text-gray-400 font-semibold mb-2 transition-colors">{{ $post->published_at->format('d M Y') }}</div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-gray-300 transition-colors">{{ $post->title }}</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm transition-colors">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 80) }}</p>
                </div>
            </a>
            @endforeach
        </div>
        
        <div class="mt-12 text-center">
            <a href="{{ route('ekstrakurikuler.index') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-700 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-transparent dark:text-gray-300 dark:hover:bg-gray-900 transition">
                Lihat Semua Kegiatan
            </a>
        </div>
    </div>
</section>
@endif

<!-- Lokasi & Peta -->
<section class="py-16 bg-white dark:bg-black transition-colors duration-300 border-b border-gray-100 dark:border-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white transition-colors duration-300">Lokasi Sekolah</h2>
            <p class="mt-4 text-gray-500 dark:text-gray-400 transition-colors">{{ $profiles['alamat'] ?? 'Jl. Komp. Pendidikan No.RT 08/09, Muara Ciujung Tim., Kec. Rangkasbitung, Kabupaten Lebak, Banten 42314' }}</p>
        </div>
        
        <div class="relative w-full h-96 rounded-2xl overflow-hidden shadow-sm dark:shadow-md dark:shadow-white/5 border border-gray-100 dark:border-gray-800 group">
            @php
                $mapUrl = !empty($profiles['google_maps_embed']) 
                    ? $profiles['google_maps_embed'] 
                    : "https://maps.google.com/maps?q=Pondok%20Pesantren%20Modern%20Darel%20Azhar&t=&z=15&ie=UTF8&iwloc=&output=embed";
                
                // Safety fallback if it's not a valid embed URL (doesn't have /embed or output=embed)
                if (strpos($mapUrl, 'embed') === false) {
                    $mapUrl = "https://maps.google.com/maps?q=Pondok%20Pesantren%20Modern%20Darel%20Azhar&t=&z=15&ie=UTF8&iwloc=&output=embed";
                }
            @endphp
            <iframe src="{{ $mapUrl }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="filter dark:contrast-125 dark:brightness-75 transition-all duration-300 group-hover:dark:brightness-100"></iframe>
            
            <div class="absolute bottom-6 right-6">
                <a href="{{ $profiles['google_maps_url'] ?? '#' }}" target="_blank" class="inline-flex items-center px-4 py-3 border border-transparent shadow-lg text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 dark:bg-white dark:text-black dark:hover:bg-gray-200 transition">
                    <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Buka di Google Maps
                </a>
            </div>
        </div>
    </div>
</section>

<!-- PPDB CTA -->
<section class="py-20 bg-blue-600 dark:bg-[#111111] transition-colors duration-300">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-extrabold text-white sm:text-4xl mb-6">Penerimaan Peserta Didik Baru</h2>
        @if($ppdb && $ppdb->is_open)
        <p class="text-xl text-blue-100 dark:text-gray-400 mb-8">Pendaftaran PPDB Tahun Ajaran {{ $ppdb->academic_year }} sedang dibuka. Jangan lewatkan kesempatan emas ini.</p>
        <a href="{{ route('ppdb.landing') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-lg font-bold rounded-md text-blue-600 bg-white hover:bg-gray-50 dark:bg-white dark:text-black dark:hover:bg-gray-200 shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1">
            Informasi & Pendaftaran PPDB
        </a>
        @else
        <p class="text-xl text-blue-100 dark:text-gray-400 mb-8">Pendaftaran PPDB saat ini sedang ditutup. Nantikan informasi dari kami selanjutnya.</p>
        <button disabled class="inline-flex items-center justify-center px-8 py-4 border border-white/30 dark:border-gray-700 text-lg font-medium rounded-md text-white/70 dark:text-gray-500 bg-transparent cursor-not-allowed">
            Pendaftaran Ditutup
        </button>
        @endif
    </div>
</section>
@endsection
