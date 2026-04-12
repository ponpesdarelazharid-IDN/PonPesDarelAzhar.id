@section('title', 'Tambah Program')

@section('breadcrumb')
<a href="{{ route('admin.programs.index') }}" class="hover:text-emerald-500 transition">Program Unggulan</a>
@endsection

@section('header')
<div class="flex items-center gap-4">
    <a href="{{ route('admin.programs.index') }}" 
       class="p-2 bg-white dark:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-700/50 text-slate-400 hover:text-emerald-500 transition-colors shadow-sm">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
    </a>
    <div>
        <h2 class="text-3xl font-black text-slate-800 dark:text-white uppercase tracking-tight">
            {{ __('Tambah Program') }}
        </h2>
        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">
            Buat program unggulan baru untuk ditampilkan di beranda.
        </p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Form Fields -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-sm border border-slate-100 dark:border-slate-700/50 space-y-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 px-1">Nama Program</label>
                        <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Tahfidz Qur'an..."
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all">
                        @error('title') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 px-1">Deskripsi Singkat</label>
                        <textarea name="description" rows="6" placeholder="Jelaskan secara singkat tentang program ini..." required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-medium focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all leading-relaxed">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 mt-8">
                    <a href="{{ route('admin.programs.index') }}" 
                        class="px-8 py-4 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 font-black uppercase tracking-widest text-[10px] rounded-2xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                        Batal
                    </a>
                    <button type="submit" 
                        class="px-12 py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-black uppercase tracking-widest text-[10px] rounded-2xl shadow-lg shadow-emerald-500/20 transition-all transform hover:scale-[1.05] active:scale-95">
                        Simpan Program
                    </button>
                </div>
            </div>

            <!-- Sidebar Info/Image -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-700/50">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4 px-1 text-center">Ikon Program</label>
                    
                    <div class="relative group">
                        <!-- We use data-name="icon" for our javascript compression script -->
                        <input type="file" name="icon" id="image_upload" data-name="icon" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div id="image_preview_container" class="aspect-square rounded-2xl border-2 border-dashed border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 flex flex-col items-center justify-center group-hover:bg-slate-100 dark:group-hover:bg-emerald-500/5 transition-all overflow-hidden relative">
                            <div class="text-slate-300 dark:text-slate-700 text-center p-4">
                                <svg class="w-10 h-10 mx-auto mb-2 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-600">Klik & Upload Ikon</p>
                            </div>
                        </div>
                    </div>
                    @error('icon') <p class="text-red-500 text-[10px] mt-1 font-bold text-center">{{ $message }}</p> @enderror
                </div>

                <div class="p-6 bg-emerald-500/5 dark:bg-emerald-500/10 rounded-3xl border border-emerald-500/10">
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-emerald-600 dark:text-emerald-400 mb-2">Tips Ikon</h4>
                    <p class="text-[11px] text-emerald-800/70 dark:text-emerald-400/70 leading-relaxed font-medium"> Gunakan gambar dengan rasio 1:1 (persegi) berupa grafik vector atau icon PNG transparan untuk tampilan terindah.</p>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Image Compression Logic (Critical for Vercel) -->
<script>
document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', async (e) => {
        const file = e.target.files[0];
        if (!file || !file.type.startsWith('image/')) return;
        
        const container = e.target.closest('.group');
        const overlay = document.createElement('div');
        overlay.className = "absolute inset-0 bg-slate-950/80 backdrop-blur-sm flex flex-col items-center justify-center z-50 text-white transition-opacity duration-300 rounded-3xl";
        overlay.innerHTML = `
            <div class="w-10 h-10 border-4 border-emerald-500/20 border-t-emerald-500 rounded-full animate-spin mb-4"></div>
            <p class="text-[8px] font-black uppercase tracking-[0.2em] animate-pulse text-center px-4">Processing Icon...</p>
        `;
        container.appendChild(overlay);

        try {
            const fieldName = e.target.dataset.name;
            // Use global helper from admin.blade.php
            const base64Data = await compressImageToBase64(file, 800, 0.9);
            
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
                newImg.className = "w-full h-full object-contain p-4 transition-all duration-500 absolute inset-0 z-0";
                
                // insert inside image preview container
                const previewContainer = container.querySelector('#image_preview_container');
                previewContainer.appendChild(newImg);
            }
            
        } catch (err) {
            console.error('Processing failed:', err);
            alert('Proses gambar gagal. Coba file lain.');
        } finally {
            overlay.remove();
        }
    });
});
</script>
@endsection
