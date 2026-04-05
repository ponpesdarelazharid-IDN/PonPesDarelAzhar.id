@extends('layouts.admin')

@section('header')
<div>
    <h2 class="text-3xl font-black text-slate-800 dark:text-white uppercase tracking-tight">
        {{ __('Profil Sekolah') }}
    </h2>
    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">
        Perbarui informasi dasar, visi, misi, dan kontak sekolah Anda.
    </p>
</div>
@endsection

@section('content')
<div class="max-w-5xl">
    <!-- Feedback -->
    @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl text-emerald-600 dark:text-emerald-400 font-bold text-sm flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-8 p-4 bg-red-500/10 border border-red-500/20 rounded-2xl text-red-600 dark:text-red-400 font-bold text-sm space-y-1">
            @foreach ($errors->all() as $error)
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    {{ $error }}
                </div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.school-profiles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10 pb-20">
        @csrf
        
        <!-- Section 1: Identitas & Kontak -->
        <div class="bg-white dark:bg-slate-800 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-700/50 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50 dark:border-slate-700/50 flex items-center gap-4">
                <div class="w-10 h-10 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-black text-sm shadow-lg shadow-emerald-500/20">01</div>
                <h3 class="text-lg font-black text-slate-800 dark:text-white uppercase tracking-tight">Identitas & Kontak</h3>
            </div>
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Nama Sekolah</label>
                    <input type="text" name="nama_sekolah" value="{{ $profiles['nama_sekolah'] ?? '' }}" required
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all">
                </div>
                
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Nomor Telepon</label>
                    <input type="text" name="tlp" value="{{ $profiles['tlp'] ?? '' }}" required
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Email Resmi</label>
                    <input type="email" name="email" value="{{ $profiles['email'] ?? '' }}" required
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" required
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all leading-relaxed">{{ $profiles['alamat'] ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <!-- Section 2: Visi, Misi & Konten -->
        <div class="bg-white dark:bg-slate-800 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-700/50 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50 dark:border-slate-700/50 flex items-center gap-4">
                <div class="w-10 h-10 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-black text-sm shadow-lg shadow-emerald-500/20">02</div>
                <h3 class="text-lg font-black text-slate-800 dark:text-white uppercase tracking-tight">Konten Profil & Filosofi</h3>
            </div>
            <div class="p-8 space-y-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Tentang Kami / Sambutan</label>
                    <textarea name="tentang_kami" rows="4" placeholder="Jelaskan secara singkat mengenai sekolah Anda..."
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all leading-relaxed">{{ $profiles['tentang_kami'] ?? '' }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Visi Sekolah</label>
                        <textarea name="visi" rows="5"
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all leading-relaxed">{{ $profiles['visi'] ?? '' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Misi Sekolah (Gunakan Baris Baru per Poin)</label>
                        <textarea name="misi" rows="5" placeholder="Poin 1\nPoin 2\nPoin 3..."
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all leading-relaxed">{{ $profiles['misi'] ?? '' }}</textarea>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Misi Singkat (Footer)</label>
                    <input type="text" name="misi_singkat" value="{{ $profiles['misi_singkat'] ?? '' }}"
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Sejarah Singkat</label>
                        <textarea name="sejarah" rows="6"
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all leading-relaxed">{{ $profiles['sejarah'] ?? '' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Tujuan Sekolah</label>
                        <textarea name="tujuan" rows="6"
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all leading-relaxed">{{ $profiles['tujuan'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Section 3: Media & Galeri -->
        <div class="bg-white dark:bg-slate-800 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-700/50 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50 dark:border-slate-700/50 flex items-center gap-4">
                <div class="w-10 h-10 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-black text-sm shadow-lg shadow-emerald-500/20">03</div>
                <h3 class="text-lg font-black text-slate-800 dark:text-white uppercase tracking-tight">Media & Visual Utama</h3>
            </div>
            <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <!-- Logo -->
                <div class="space-y-4">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Logo Sekolah</label>
                    <div class="relative group aspect-square rounded-3xl bg-slate-50 dark:bg-slate-900 border-2 border-dashed border-slate-200 dark:border-slate-700 flex items-center justify-center overflow-hidden">
                        @if(isset($profiles['logo']))
                            <img src="{{ $profiles['logo'] }}" class="w-full h-full object-contain p-6 group-hover:scale-110 transition-all duration-500 relative z-0">
                        @else
                            <div class="text-slate-300 dark:text-slate-700">
                                <svg class="w-12 h-12 mx-auto mb-2 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                <span class="text-[9px] font-black uppercase tracking-widest">Upload Logo</span>
                            </div>
                        @endif
                        <input type="file" name="logo" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="space-y-4 md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Hero Image (Landing Page)</label>
                    <div class="relative group aspect-video rounded-3xl bg-slate-50 dark:bg-slate-900 border-2 border-dashed border-slate-200 dark:border-slate-700 flex items-center justify-center overflow-hidden text-center">
                        @if(isset($profiles['hero_image']))
                            <img src="{{ $profiles['hero_image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-500 relative z-0">
                        @else
                            <div class="text-slate-300 dark:text-slate-700">
                                <svg class="w-12 h-12 mx-auto mb-2 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                <span class="text-[9px] font-black uppercase tracking-widest">Upload Hero Image</span>
                            </div>
                        @endif
                        <input type="file" name="hero_image" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                    </div>
                </div>

                <!-- Secondary -->
                <div class="space-y-4 md:col-span-3">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Foto Fasilitas (Sekunder)</label>
                    <div class="relative group h-48 rounded-3xl bg-slate-50 dark:bg-slate-900 border-2 border-dashed border-slate-200 dark:border-slate-700 flex items-center justify-center overflow-hidden">
                        @if(isset($profiles['secondary_image']))
                            <img src="{{ $profiles['secondary_image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-500 relative z-0">
                        @else
                            <div class="text-slate-300 dark:text-slate-700">
                                <svg class="w-10 h-10 mx-auto mb-2 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                <span class="text-[9px] font-black uppercase tracking-widest text-center">Upload Foto Gedung / Fasilitas</span>
                            </div>
                        @endif
                        <input type="file" name="secondary_image" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 4: Lokasi -->
        <div class="bg-white dark:bg-slate-800 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-700/50 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50 dark:border-slate-700/50 flex items-center gap-4">
                <div class="w-10 h-10 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-black text-sm shadow-lg shadow-emerald-500/20">04</div>
                <h3 class="text-lg font-black text-slate-800 dark:text-white uppercase tracking-tight">Lokasi & Navigasi</h3>
            </div>
            <div class="p-8 space-y-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Link Google Maps (Share URL)</label>
                    <input type="text" name="google_maps_url" value="{{ $profiles['google_maps_url'] ?? '' }}" placeholder="https://www.google.com/maps/..."
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Maps Embed URL (src iframe)</label>
                    <textarea name="google_maps_embed" rows="3" placeholder="https://www.google.com/maps/embed?pb=..."
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all">{{ $profiles['google_maps_embed'] ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="fixed bottom-8 right-8 z-50">
            <button type="submit" 
                class="px-10 py-5 bg-emerald-500 hover:bg-emerald-600 text-white font-black uppercase tracking-widest text-xs rounded-2xl shadow-2xl shadow-emerald-500/40 transition-all transform hover:scale-[1.05] active:scale-95 flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<!-- Image Compression Logic (Critical for Vercel) -->
<script>
document.querySelectorAll('input[type="file"]').forEach(input => {
    input.dataset.name = input.name;

    input.addEventListener('change', async (e) => {
        const file = e.target.files[0];
        if (!file || !file.type.startsWith('image/')) return;
        
        const container = e.target.closest('.group');
        const overlay = document.createElement('div');
        overlay.className = "absolute inset-0 bg-slate-950/80 backdrop-blur-sm flex flex-col items-center justify-center z-50 text-white transition-opacity duration-300 rounded-3xl";
        overlay.innerHTML = `
            <div class="w-10 h-10 border-4 border-emerald-500/20 border-t-emerald-500 rounded-full animate-spin mb-4"></div>
            <p class="text-[8px] font-black uppercase tracking-[0.2em] animate-pulse text-center px-4">Processing Visual...</p>
        `;
        container.appendChild(overlay);

        try {
            const fieldName = e.target.dataset.name;
            let maxDim = 1200;
            if (fieldName === 'hero_image') maxDim = 1920;
            if (fieldName === 'logo') maxDim = 800;

            const base64Data = await compressToBase64(file, maxDim, 0.82);
            
            let hiddenInput = container.querySelector(`input[name="${fieldName}_base64"]`);
            if (!hiddenInput) {
                hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = `${fieldName}_base64`;
                container.appendChild(hiddenInput);
            }
            hiddenInput.value = base64Data;
            
            e.target.removeAttribute('name');
            
            const img = container.querySelector('img');
            if (img) {
                img.src = base64Data;
            } else {
                const placeholder = container.querySelector('.text-slate-300');
                if (placeholder) placeholder.remove();

                const newImg = document.createElement('img');
                newImg.src = base64Data;
                newImg.className = "w-full h-full object-cover transition-all duration-500 absolute inset-0 z-0";
                if (fieldName === 'logo') newImg.classList.add('object-contain', 'p-6');
                container.insertBefore(newImg, e.target);
            }
            
        } catch (err) {
            console.error('Processing failed:', err);
            alert('Proses gambar gagal. Coba file lain.');
        } finally {
            overlay.remove();
        }
    });
});

async function compressToBase64(file, maxDimension, quality) {
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
                resolve(canvas.toDataURL('image/jpeg', quality));
            };
        };
        reader.onerror = reject;
    });
}
</script>
@endsection
