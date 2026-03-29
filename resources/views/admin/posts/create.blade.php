@extends('layouts.app')

@section('title', 'Tambah Postingan Baru')

@section('content')
<div class="px-4 py-8 max-w-4xl mx-auto">
    <div class="mb-10">
        <a href="{{ route('admin.posts.index') }}" class="text-sm font-bold uppercase tracking-widest text-slate-400 hover:text-[#1e293b] dark:hover:text-white transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-4xl font-black text-[#1e293b] dark:text-white tracking-tighter mt-4">Buat Postingan Baru</h1>
    </div>

    <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl p-8 md:p-12 shadow-2xl border border-slate-100 dark:border-gray-900">
        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Judul -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-3">Judul Postingan</label>
                    <input type="text" name="title" value="{{ old('title') }}" 
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm" required placeholder="Contoh: Juara 1 Lomba Pidato Bahasa Arab">
                </div>

                <!-- Tipe Post -->
                <div>
                    <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-3">Kategori</label>
                    <select name="type" x-data="{ type: '' }" x-model="type" id="post_type" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm" required>
                        <option value="berita">Berita Terbaru</option>
                        <option value="acara">Agenda Acara</option>
                        <option value="prestasi">Prestasi Unggulan</option>
                        <option value="ekstrakurikuler">Ekstrakurikuler</option>
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-3">Status Publikasi</label>
                    <select name="status" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm" required>
                        <option value="published">Langsung Terbitkan</option>
                        <option value="draft">Simpan sebagai Draft</option>
                    </select>
                </div>

                <!-- Gambar Utama -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-3">Gambar Utama</label>
                    <div class="relative">
                        <input type="file" name="image" id="image_input" class="hidden" accept="image/*">
                        <label for="image_input" class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed border-slate-200 dark:border-gray-800 rounded-3xl cursor-pointer hover:border-[#1e293b] dark:hover:border-white transition-all bg-slate-50 dark:bg-gray-900 overflow-hidden">
                            <div id="preview_placeholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                                <span class="text-4xl mb-4">🖼️</span>
                                <p class="text-sm text-slate-500 dark:text-gray-400 font-bold uppercase tracking-widest">Pilih Gambar Postingan</p>
                                <p class="text-[10px] text-slate-400 mt-2">Format: JPG, PNG, WEBP (Maks. 2MB)</p>
                            </div>
                            <img id="image_preview" class="hidden w-full h-full object-cover">
                        </label>
                    </div>
                </div>

                <!-- Achievement By (Only for type=prestasi) -->
                <div id="achievement_field" class="hidden">
                    <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-3">Prestasi Oleh</label>
                    <select name="achievement_by" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm">
                        <option value="sekolah">Sekolah</option>
                        <option value="guru">Guru/Staf</option>
                        <option value="murid">Santri/Murid</option>
                    </select>
                </div>

                <!-- Event Date (Only for type=acara) -->
                <div id="event_date_field" class="hidden">
                    <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-3">Tanggal Kegiatan</label>
                    <input type="date" name="event_date" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm">
                </div>

                <!-- Ringkasan Singkat -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-3">Ringkasan Singkat (Excerpt)</label>
                    <textarea name="excerpt" rows="2" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm" placeholder="Akan muncul di halaman depan sebagai cuplikan berita..."></textarea>
                </div>

                <!-- Konten Lengkap -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-3">Isi Lengkap Postingan</label>
                    <textarea name="content" rows="10" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm" required placeholder="Tuliskan berita atau detail prestasi di sini..."></textarea>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-5 rounded-2xl bg-[#1e293b] dark:bg-white text-white dark:text-black font-extrabold text-lg shadow-xl hover:scale-[1.01] active:scale-95 transition-all duration-300">
                    Simpan Postingan 🚀
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
    const achievementField = document.getElementById('achievement_field');
    const eventDateField = document.getElementById('event_date_field');

    function toggleFields() {
        achievementField.classList.add('hidden');
        eventDateField.classList.add('hidden');
        
        if (postTypeSelect.value === 'prestasi') {
            achievementField.classList.remove('hidden');
        } else if (postTypeSelect.value === 'acara') {
            eventDateField.classList.remove('hidden');
        }
    }

    postTypeSelect.addEventListener('change', toggleFields);
    toggleFields();
</script>
@endsection
