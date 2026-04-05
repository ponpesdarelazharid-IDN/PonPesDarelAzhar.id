@extends('layouts.admin')

@section('title', 'Tambah Postingan Baru')

@section('content')
<div class="relative">
    <div class="mb-10">
        <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-emerald-500 transition-all duration-300">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-4xl font-extrabold text-[#111c3a] dark:text-white tracking-tight mt-6">Buat Postingan Baru</h1>
        <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Publikasikan berita, agenda, atau prestasi terbaru sekolah.</p>
    </div>

    <div class="bg-white dark:bg-dark-card rounded-[40px] p-8 md:p-12 shadow-2xl shadow-emerald-900/5 border border-slate-100 dark:border-slate-800">
        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Judul -->
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-4">Judul Postingan</label>
                    <input type="text" name="title" value="{{ old('title') }}" 
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-bold placeholder-slate-300" required placeholder="Masukkan judul yang menarik...">
                </div>

                <!-- Tipe Post -->
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-4">Kategori Konten</label>
                    <div class="relative">
                        <select name="type" id="post_type" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-bold appearance-none cursor-pointer" required>
                            <option value="berita">Berita Terbaru</option>
                            <option value="acara">Agenda Acara</option>
                            <option value="prestasi">Prestasi Unggulan</option>
                            <option value="ekstrakurikuler">Ekstrakurikuler</option>
                        </select>
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-4">Status Publikasi</label>
                    <div class="relative">
                        <select name="status" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-bold appearance-none cursor-pointer" required>
                            <option value="published">Langsung Terbitkan</option>
                            <option value="draft">Simpan sebagai Draft</option>
                        </select>
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>
                </div>

                <!-- Gambar Utama -->
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-4">Gambar Sampul (Thumbnail)</label>
                    <div class="relative">
                        <input type="file" name="image" id="image_input" class="hidden" accept="image/*">
                        <label for="image_input" class="flex flex-col items-center justify-center w-full h-80 border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-[32px] cursor-pointer hover:border-emerald-500 dark:hover:border-emerald-400 transition-all bg-slate-50 dark:bg-dark-main overflow-hidden group">
                            <div id="preview_placeholder" class="flex flex-col items-center justify-center pt-5 pb-6 text-center group-hover:scale-105 transition-transform duration-500">
                                <div class="w-20 h-20 bg-white dark:bg-slate-800 rounded-3xl flex items-center justify-center text-4xl shadow-xl mb-6">🖼️</div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 font-black uppercase tracking-widest">Pilih Gambar Postingan</p>
                                <p class="text-[10px] text-slate-400 mt-3 font-medium">Format: JPG, PNG, WEBP (Maks. 2MB)</p>
                            </div>
                            <img id="image_preview" class="hidden w-full h-full object-cover">
                            <!-- Overlay Change Image -->
                            <div id="image_overlay" class="hidden absolute inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span class="px-6 py-3 bg-white text-black text-[10px] font-black uppercase tracking-widest rounded-2xl">Ganti Gambar</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Dynamic Fields Section (Emerald Background) -->
                <div id="dynamic_section" class="md:col-span-2 hidden bg-emerald-50/50 dark:bg-emerald-900/10 p-8 rounded-[32px] border border-emerald-100 dark:border-emerald-800/50 space-y-8 mt-2">
                    <!-- Achievement By (Only for type=prestasi) -->
                    <div id="achievement_field" class="hidden">
                        <label class="block text-[10px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-[0.2em] mb-4">Prestasi Diraih Oleh</label>
                        <div class="relative">
                            <select name="achievement_by" class="w-full px-6 py-4 rounded-2xl bg-white dark:bg-dark-main border border-emerald-100 dark:border-emerald-800 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-bold appearance-none cursor-pointer shadow-sm">
                                <option value="sekolah">Sekolah / Instansi</option>
                                <option value="guru">Guru / Staf Pengajar</option>
                                <option value="murid">Santri / Peserta Didik</option>
                            </select>
                            <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-emerald-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Event Date (Only for type=acara) -->
                    <div id="event_date_field" class="hidden">
                        <label class="block text-[10px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-[0.2em] mb-4">Tanggal Pelaksanaan Kegiatan</label>
                        <input type="date" name="event_date" class="w-full px-6 py-4 rounded-2xl bg-white dark:bg-dark-main border border-emerald-100 dark:border-emerald-800 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-bold shadow-sm">
                    </div>
                </div>

                <!-- Ringkasan Singkat -->
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-4">Ringkasan Singkat (Excerpt)</label>
                    <textarea name="excerpt" rows="2" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-bold placeholder-slate-300" placeholder="Cuplikan singkat yang muncul di halaman depan..."></textarea>
                </div>

                <!-- Konten Lengkap -->
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-4">Konten Utama Postingan</label>
                    <textarea name="content" rows="12" class="w-full px-8 py-6 rounded-[32px] bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-bold placeholder-slate-300 leading-relaxed" required placeholder="Tuliskan isi berita atau detail agenda di sini..."></textarea>
                </div>
            </div>

            <div class="pt-10 border-t border-slate-100 dark:border-slate-800 flex flex-col md:flex-row gap-5">
                <a href="{{ route('admin.posts.index') }}" class="flex-1 py-5 rounded-[20px] bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-center font-bold hover:bg-slate-200 dark:hover:bg-slate-700 transition duration-300">
                    Batalkan
                </a>
                <button type="submit" class="flex-[3] py-5 rounded-[20px] bg-emerald-500 text-white font-black uppercase tracking-widest text-sm shadow-2xl shadow-emerald-500/30 hover:bg-emerald-600 hover:-translate-y-1 active:translate-y-0 transition-all duration-300">
                    Simpan & Terbitkan Postingan &rarr;
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Image Preview logic
    document.getElementById('image_input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image_preview').src = e.target.result;
                document.getElementById('image_preview').classList.remove('hidden');
                document.getElementById('preview_placeholder').classList.add('hidden');
                document.getElementById('image_overlay').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    // Dynamic fields logic
    const postTypeSelect = document.getElementById('post_type');
    const dynamicSection = document.getElementById('dynamic_section');
    const achievementField = document.getElementById('achievement_field');
    const eventDateField = document.getElementById('event_date_field');

    function toggleFields() {
        achievementField.classList.add('hidden');
        eventDateField.classList.add('hidden');
        dynamicSection.classList.add('hidden');
        
        if (postTypeSelect.value === 'prestasi') {
            dynamicSection.classList.remove('hidden');
            achievementField.classList.remove('hidden');
        } else if (postTypeSelect.value === 'acara') {
            dynamicSection.classList.remove('hidden');
            eventDateField.classList.remove('hidden');
        }
    }

    postTypeSelect.addEventListener('change', toggleFields);
    toggleFields();
</script>
@endsection
