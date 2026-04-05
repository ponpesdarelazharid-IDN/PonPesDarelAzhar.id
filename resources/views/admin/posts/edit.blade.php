@extends('layouts.admin')

@section('title', 'Edit Postingan')

@section('content')
<div class="relative">
    <div class="mb-10">
        <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-emerald-500 transition-all duration-300">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-4xl font-extrabold text-[#111c3a] dark:text-white tracking-tight mt-6">Edit Postingan</h1>
        <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Perbarui informasi berita, agenda, atau prestasi sekolah.</p>
    </div>

    <div class="bg-white dark:bg-dark-card rounded-[40px] p-8 md:p-12 shadow-2xl shadow-emerald-900/5 border border-slate-100 dark:border-slate-800">
        <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
            @csrf
            @method('PATCH')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Judul -->
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-4">Judul Postingan</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" 
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-bold" required>
                </div>

                <!-- Tipe Post -->
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-4">Kategori Konten</label>
                    <div class="relative">
                        <select name="type" id="post_type" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-bold appearance-none cursor-pointer" required>
                            <option value="berita" {{ $post->type == 'berita' ? 'selected' : '' }}>Berita Terbaru</option>
                            <option value="acara" {{ $post->type == 'acara' ? 'selected' : '' }}>Agenda Acara</option>
                            <option value="prestasi" {{ $post->type == 'prestasi' ? 'selected' : '' }}>Prestasi Unggulan</option>
                            <option value="ekstrakurikuler" {{ $post->type == 'ekstrakurikuler' ? 'selected' : '' }}>Ekstrakurikuler</option>
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
                            <option value="published" {{ $post->published_at ? 'selected' : '' }}>Publikasikan</option>
                            <option value="draft" {{ !$post->published_at ? 'selected' : '' }}>Simpan Draft</option>
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
                            @if($post->image_url)
                                <img id="image_preview" src="{{ $post->image_url }}" class="w-full h-full object-cover">
                                <div id="preview_placeholder" class="hidden flex flex-col items-center justify-center pt-5 pb-6 text-center">
                                    <div class="w-20 h-20 bg-white dark:bg-slate-800 rounded-3xl flex items-center justify-center text-4xl shadow-xl mb-6">🖼️</div>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 font-black uppercase tracking-widest">Ganti Gambar Postingan</p>
                                </div>
                            @else
                                <div id="preview_placeholder" class="flex flex-col items-center justify-center pt-5 pb-6 text-center">
                                    <div class="w-20 h-20 bg-white dark:bg-slate-800 rounded-3xl flex items-center justify-center text-4xl shadow-xl mb-6">🖼️</div>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 font-black uppercase tracking-widest">Pilih Gambar Postingan</p>
                                </div>
                                <img id="image_preview" class="hidden w-full h-full object-cover">
                            @endif
                            <!-- Overlay Change Image -->
                            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span class="px-6 py-3 bg-white text-black text-[10px] font-black uppercase tracking-widest rounded-2xl">Ubah Gambar</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Dynamic Fields Section -->
                <div id="dynamic_section" @class(['md:col-span-2 bg-emerald-50/50 dark:bg-emerald-900/10 p-8 rounded-[32px] border border-emerald-100 dark:border-emerald-800/50 space-y-8 mt-2', 'hidden' => !in_array($post->type, ['prestasi', 'acara'])])>
                    <!-- Achievement By (Only for type=prestasi) -->
                    <div id="achievement_field" @class(['hidden' => $post->type !== 'prestasi'])>
                        <label class="block text-[10px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-[0.2em] mb-4">Prestasi Diraih Oleh</label>
                        <div class="relative">
                            <select name="achievement_by" class="w-full px-6 py-4 rounded-2xl bg-white dark:bg-dark-main border border-emerald-100 dark:border-emerald-800 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-bold appearance-none cursor-pointer shadow-sm">
                                <option value="sekolah" {{ $post->achievement_by == 'sekolah' ? 'selected' : '' }}>Sekolah / Instansi</option>
                                <option value="guru" {{ $post->achievement_by == 'guru' ? 'selected' : '' }}>Guru / Staf Pengajar</option>
                                <option value="murid" {{ $post->achievement_by == 'murid' ? 'selected' : '' }}>Santri / Peserta Didik</option>
                            </select>
                            <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-emerald-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Event Date (Only for type=acara) -->
                    <div id="event_date_field" @class(['hidden' => $post->type !== 'acara'])>
                        <label class="block text-[10px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-[0.2em] mb-4">Tanggal Pelaksanaan Kegiatan</label>
                        <input type="date" name="event_date" value="{{ $post->event_date ? $post->event_date->format('Y-m-d') : '' }}" class="w-full px-6 py-4 rounded-2xl bg-white dark:bg-dark-main border border-emerald-100 dark:border-emerald-800 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-bold shadow-sm">
                    </div>
                </div>

                <!-- Ringkasan Singkat -->
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-4">Ringkasan Singkat (Excerpt)</label>
                    <textarea name="excerpt" rows="2" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-bold placeholder-slate-300">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>

                <!-- Konten Lengkap -->
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-4">Konten Utama Postingan</label>
                    <textarea name="content" rows="12" class="w-full px-8 py-6 rounded-[32px] bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-bold placeholder-slate-300 leading-relaxed" required>{{ old('content', $post->content) }}</textarea>
                </div>
            </div>

            <div class="pt-10 border-t border-slate-100 dark:border-slate-800 flex flex-col md:flex-row gap-5">
                <a href="{{ route('admin.posts.index') }}" class="flex-1 py-5 rounded-[20px] bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-center font-bold hover:bg-slate-200 dark:hover:bg-slate-700 transition duration-300">
                    Batalkan
                </a>
                <button type="submit" class="flex-[3] py-5 rounded-[20px] bg-emerald-500 text-white font-black uppercase tracking-widest text-sm shadow-2xl shadow-emerald-500/30 hover:bg-emerald-600 hover:-translate-y-1 active:translate-y-0 transition-all duration-300">
                    Perbarui Postingan ✨
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
</script>
@endsection
