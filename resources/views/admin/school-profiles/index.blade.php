@extends('layouts.app')

@section('title', 'Kelola Profil Sekolah')

@section('content')
<div class="px-4 py-8 max-w-5xl mx-auto">
    <div class="mb-10 flex justify-between items-end">
        <div>
            <h1 class="text-4xl font-black text-[#1e293b] dark:text-white tracking-tighter uppercase">Profil Sekolah</h1>
            <p class="text-slate-500 dark:text-gray-400 mt-2 font-medium">Perbarui informasi dasar, visi, misi, dan kontak sekolah Anda.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-8 p-5 rounded-2xl bg-emerald-50 dark:bg-emerald-900/10 border border-emerald-100 dark:border-emerald-900/20 flex items-center gap-4 animate-in fade-in slide-in-from-top-4 duration-500">
            <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center shadow-lg">✓</div>
            <p class="text-emerald-800 dark:text-emerald-400 font-bold tracking-tight">{{ session('success') }}</p>
        </div>
    @endif

    <form action="{{ route('admin.school-profiles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
        @csrf
        
        <!-- Identitas Sekolah -->
        <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl shadow-2xl border border-slate-100 dark:border-gray-900 overflow-hidden">
            <div class="p-8 border-b border-slate-50 dark:border-gray-900 bg-slate-50/50 dark:bg-white/5">
                <h3 class="text-xl font-black text-[#1e293b] dark:text-white flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-[#1e293b] dark:bg-white text-white dark:text-black flex items-center justify-center text-sm">01</span>
                    Identitas & Kontak Dasar
                </h3>
            </div>
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-3">Nama Sekolah</label>
                    <input type="text" name="nama_sekolah" value="{{ $profiles['nama_sekolah'] ?? '' }}" required
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">
                </div>
                
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-3">Nomor Telepon</label>
                    <input type="text" name="tlp" value="{{ $profiles['tlp'] ?? '' }}" required
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-3">Email Resmi</label>
                    <input type="email" name="email" value="{{ $profiles['email'] ?? '' }}" required
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-3">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" required
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">{{ $profiles['alamat'] ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <!-- Visi, Misi & Tentang -->
        <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl shadow-2xl border border-slate-100 dark:border-gray-900 overflow-hidden">
            <div class="p-8 border-b border-slate-50 dark:border-gray-900 bg-slate-50/50 dark:bg-white/5">
                <h3 class="text-xl font-black text-[#1e293b] dark:text-white flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-[#1e293b] dark:bg-white text-white dark:text-black flex items-center justify-center text-sm">02</span>
                    Konten Profil & Filosofi
                </h3>
            </div>
            <div class="p-8 space-y-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-3">Tentang Kami / Sambutan</label>
                    <textarea name="tentang_kami" rows="4" placeholder="Jelaskan secara singkat mengenai sekolah Anda..."
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">{{ $profiles['tentang_kami'] ?? '' }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-3">Visi Sekolah</label>
                        <textarea name="visi" rows="5"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">{{ $profiles['visi'] ?? '' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-3">Misi Sekolah (Poin-poin)</label>
                        <textarea name="misi" rows="5" placeholder="Gunakan baris baru untuk setiap poin misi..."
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">{{ $profiles['misi'] ?? '' }}</textarea>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-3">Misi Singkat (Untuk Footer)</label>
                    <input type="text" name="misi_singkat" value="{{ $profiles['misi_singkat'] ?? '' }}"
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-3">Sejarah Singkat</label>
                    <textarea name="sejarah" rows="6"
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">{{ $profiles['sejarah'] ?? '' }}</textarea>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-3">Tujuan Sekolah</label>
                    <textarea name="tujuan" rows="6" placeholder="Sebutkan tujuan strategis sekolah Anda..."
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">{{ $profiles['tujuan'] ?? '' }}</textarea>
                </div>
            </div>
        </div>
        
        <!-- Media & Galeri Utama -->
        <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl shadow-2xl border border-slate-100 dark:border-gray-900 overflow-hidden">
            <div class="p-8 border-b border-slate-50 dark:border-gray-900 bg-slate-50/50 dark:bg-white/5">
                <h3 class="text-xl font-black text-[#1e293b] dark:text-white flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-[#1e293b] dark:bg-white text-white dark:text-black flex items-center justify-center text-sm">03</span>
                    Media & Galeri Utama
                </h3>
            </div>
            <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Logo Sekolah -->
                <div class="space-y-4">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Logo Sekolah</label>
                    <div class="relative group aspect-square rounded-3xl bg-slate-50 dark:bg-gray-900 border-2 border-dashed border-slate-200 dark:border-gray-800 flex items-center justify-center overflow-hidden">
                        @if(isset($profiles['logo']))
                            <img src="{{ $profiles['logo'] }}" class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="text-center p-4">
                                <span class="text-4xl block mb-2">📸</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Pilih Logo</span>
                            </div>
                        @endif
                        <input type="file" name="logo" class="absolute inset-0 opacity-0 cursor-pointer">
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="space-y-4 md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Hero Image (Halaman Depan)</label>
                    <div class="relative group aspect-video rounded-3xl bg-slate-50 dark:bg-gray-900 border-2 border-dashed border-slate-200 dark:border-gray-800 flex items-center justify-center overflow-hidden">
                        @if(isset($profiles['hero_image']))
                            <img src="{{ $profiles['hero_image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="text-center p-4">
                                <span class="text-4xl block mb-2">🌅</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Pilih Foto Hero</span>
                            </div>
                        @endif
                        <input type="file" name="hero_image" class="absolute inset-0 opacity-0 cursor-pointer">
                    </div>
                </div>

                <!-- Secondary Image -->
                <div class="space-y-4 md:col-span-3">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Foto Gedung/Fasilitas (Sekunder)</label>
                    <div class="relative group h-48 rounded-3xl bg-slate-50 dark:bg-gray-900 border-2 border-dashed border-slate-200 dark:border-gray-800 flex items-center justify-center overflow-hidden">
                        @if(isset($profiles['secondary_image']))
                            <img src="{{ $profiles['secondary_image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="text-center p-4">
                                <span class="text-4xl block mb-2">🏫</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Pilih Foto Gedung</span>
                            </div>
                        @endif
                        <input type="file" name="secondary_image" class="absolute inset-0 opacity-0 cursor-pointer">
                    </div>
                </div>
            </div>
        </div>

        <!-- Lokasi & Peta -->
        <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl shadow-2xl border border-slate-100 dark:border-gray-900 overflow-hidden">
            <div class="p-8 border-b border-slate-50 dark:border-gray-900 bg-slate-50/50 dark:bg-white/5">
                <h3 class="text-xl font-black text-[#1e293b] dark:text-white flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-[#1e293b] dark:bg-white text-white dark:text-black flex items-center justify-center text-sm">04</span>
                    Lokasi & Google Maps
                </h3>
            </div>
            <div class="p-8 space-y-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-3">Link Google Maps (Share Link)</label>
                    <input type="text" name="google_maps_url" value="{{ $profiles['google_maps_url'] ?? '' }}" placeholder="https://www.google.com/maps/place/..."
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-3">Maps Embed URL (Bagian src="..." iframe)</label>
                    <textarea name="google_maps_embed" rows="3" placeholder="https://www.google.com/maps/embed?pb=..."
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">{{ $profiles['google_maps_embed'] ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-6 pb-20">
            <button type="submit" class="px-12 py-5 rounded-2xl bg-[#1e293b] dark:bg-white text-white dark:text-black font-extrabold text-sm uppercase tracking-widest shadow-2xl hover:scale-[1.02] active:scale-95 transition-all duration-300">
                Simpan Semua Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
