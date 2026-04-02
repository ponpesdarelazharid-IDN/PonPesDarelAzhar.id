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

    @if($errors->any())
        <div class="mb-8 p-5 rounded-2xl bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-900/20 flex items-center gap-4 animate-in fade-in slide-in-from-top-4 duration-500">
            <div class="w-10 h-10 rounded-xl bg-red-500 text-white flex items-center justify-center shadow-lg">✕</div>
            <div class="text-red-800 dark:text-red-400 font-bold tracking-tight">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
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

<!-- Image Compression Script -->
<script>
document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', async (e) => {
        const file = e.target.files[0];
        if (!file || !file.type.startsWith('image/')) return;
        
        // Compress if file is larger than 500KB
        if (file.size < 500 * 1024) return;

        // Create overlay
        const container = e.target.closest('.group');
        const overlay = document.createElement('div');
        overlay.className = "absolute inset-0 bg-black/60 backdrop-blur-sm flex flex-col items-center justify-center z-50 text-white transition-opacity duration-300";
        overlay.innerHTML = `
            <div class="w-12 h-12 border-4 border-white/20 border-t-white rounded-full animate-spin mb-4"></div>
            <p class="text-[10px] font-black uppercase tracking-widest animate-pulse text-center px-4">Optimizing Image Quality...</p>
        `;
        container.appendChild(overlay);

        try {
            // Determine max dimensions based on the field name
            let maxDim = 1200;
            if (e.target.name === 'hero_image') maxDim = 1920;
            if (e.target.name === 'logo') maxDim = 800;

            const compressedFile = await compressImage(file, maxDim, 0.85);
            
            // Replace the file in the input using DataTransfer
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(compressedFile);
            e.target.files = dataTransfer.files;
            
            // Update preview
            const reader = new FileReader();
            reader.onload = (re) => {
                const img = container.querySelector('img');
                if (img) {
                    img.src = re.target.result;
                } else {
                    // Remove the placeholder cleanly without wiping the input
                    const placeholder = container.querySelector('.text-center');
                    if (placeholder) placeholder.remove();

                    const newImg = document.createElement('img');
                    newImg.src = re.target.result;
                    newImg.className = "w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 absolute inset-0 z-0";
                    e.target.classList.add('z-10'); // ensures input stays above image
                    container.insertBefore(newImg, e.target);
                }
            };
            reader.readAsDataURL(compressedFile);
            
            console.log(`Original: ${(file.size / 1024 / 1024).toFixed(2)}MB, Compressed: ${(compressedFile.size / 1024 / 1024).toFixed(2)}MB`);
        } catch (err) {
            console.error('Compression failed:', err);
        } finally {
            overlay.remove();
        }
    });
});

async function compressImage(file, maxDimension, quality) {
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

                // Only resize if bigger than maxDimension
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
                
                // Use high quality interpolation
                ctx.imageSmoothingEnabled = true;
                ctx.imageSmoothingQuality = 'high';
                
                ctx.drawImage(img, 0, 0, width, height);

                canvas.toBlob((blob) => {
                    if (!blob) return reject(new Error('Canvas to Blob failed'));
                    const compressedFile = new File([blob], file.name, {
                        type: 'image/jpeg',
                        lastModified: Date.now(),
                    });
                    
                    // If compressed file is somehow still bigger than original (rare), use original
                    if (compressedFile.size > file.size) {
                        resolve(file);
                    } else {
                        resolve(compressedFile);
                    }
                }, 'image/jpeg', quality);
            };
        };
        reader.onerror = (error) => reject(error);
    });
}
</script>
@endsection
