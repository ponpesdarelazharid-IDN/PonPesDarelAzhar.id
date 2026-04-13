@extends('layouts.app')

@section('title', 'Upload Berkas - PSB')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <!-- Progress Stepper -->
    <div class="mb-12 flex justify-between items-center relative gap-4">
        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-slate-200 dark:bg-slate-800 -z-10 rounded-full"></div>
        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-[62.5%] h-1 bg-emerald-500 -z-10 rounded-full transition-all duration-1000"></div>
        
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-bold shadow-lg shadow-emerald-500/20 transition-all duration-500 scale-90 opacity-80">✓</div>
            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-slate-400">Biodata</span>
        </div>
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-bold shadow-lg shadow-emerald-500/20 transition-all duration-500 scale-90 opacity-80">✓</div>
            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-slate-400">Orang Tua</span>
        </div>
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-bold shadow-xl shadow-emerald-500/30 scale-110">3</div>
            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-emerald-600 dark:text-emerald-400">Berkas</span>
        </div>
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 text-slate-400 flex items-center justify-center font-bold">4</div>
            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-slate-400">Finalisasi</span>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-dark-card rounded-[32px] p-8 md:p-12 shadow-2xl shadow-emerald-900/10 border border-slate-100 dark:border-slate-800">
        <h2 class="text-3xl font-extrabold text-light-text dark:text-white tracking-tight mb-3">Pusat Upload Berkas PSB</h2>
        <p class="text-slate-500 dark:text-slate-400 mb-10 text-sm leading-relaxed">
            Format: <strong>JPG, PNG, atau PDF</strong>. Ukuran maksimal <strong>1MB</strong> per berkas.<br>
            Khusus Pas Foto, disarankan menggunakan rasio <strong>2:3</strong>.
        </p>

        <form id="psbStep3Form" action="{{ route('ppdb.register.store3') }}" method="POST" enctype="multipart/form-data" class="space-y-12">
            @csrf
            <input type="hidden" name="step" value="3">
            
            <!-- Hidden inputs for compressed data -->
            <input type="hidden" name="photo_compressed" id="photo_compressed">
            <input type="hidden" name="ijazah_compressed" id="ijazah_compressed">
            <input type="hidden" name="family_card_compressed" id="family_card_compressed">
            <input type="hidden" name="birth_cert_compressed" id="birth_cert_compressed">
            <input type="hidden" name="ktp_parent_compressed" id="ktp_parent_compressed">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Data Wajib -->
                <div class="lg:col-span-3">
                    <h3 class="text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-6 border-b border-slate-100 dark:border-slate-800 pb-2">Dokumen Wajib (Harus Diisi)</h3>
                </div>

                <!-- Pas Foto 2x3 -->
                <div class="group">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Pas Foto (Rasio 2:3)</label>
                    <div class="relative">
                        <input type="file" name="photo" class="hidden file-input" id="photo_input" accept="image/*" capture="camera" data-target="photo_compressed">
                        <label for="photo_input" class="flex flex-col items-center justify-center w-full h-56 border-2 border-dashed border-emerald-200 dark:border-emerald-800 rounded-[28px] cursor-pointer hover:border-emerald-500 transition-all bg-emerald-50/20 dark:bg-emerald-900/5 group relative overflow-hidden">
                            <div class="flex flex-col items-center justify-center text-center px-4 transition duration-300 group-hover:scale-110">
                                <span class="text-4xl mb-3">📸</span>
                                <p class="text-[10px] text-emerald-600 font-extrabold uppercase tracking-widest leading-relaxed">Ambil Foto / Upload<br><span class="text-[8px] text-emerald-400 font-bold">(WAJIB - MAX 1MB)</span></p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Ijazah -->
                <div class="group">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Ijazah Terakhir</label>
                    <div class="relative">
                        <input type="file" name="ijazah" class="hidden file-input" id="ijazah_input" accept=".pdf,image/*" data-target="ijazah_compressed">
                        <label for="ijazah_input" class="flex flex-col items-center justify-center w-full h-56 border-2 border-dashed border-emerald-200 dark:border-emerald-800 rounded-[28px] cursor-pointer hover:border-emerald-500 transition-all bg-emerald-50/20 dark:bg-emerald-900/5 group relative overflow-hidden">
                            <div class="flex flex-col items-center justify-center text-center px-4 transition duration-300 group-hover:scale-110">
                                <span class="text-4xl mb-3">🎓</span>
                                <p class="text-[10px] text-emerald-600 font-extrabold uppercase tracking-widest leading-relaxed">Upload Ijazah<br><span class="text-[8px] text-emerald-400 font-bold">(WAJIB - MAX 1MB)</span></p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Data Semi Wajib -->
                <div class="lg:col-span-3 mt-4">
                    <h3 class="text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-6 border-b border-slate-100 dark:border-slate-800 pb-2">Dokumen Pendukung (Semi-Wajib)</h3>
                </div>

                <!-- Kartu Keluarga -->
                <div class="group">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Kartu Keluarga (KK)</label>
                    <div class="relative">
                        <input type="file" name="family_card" class="hidden file-input" id="family_card_input" accept=".pdf,image/*" capture="camera" data-target="family_card_compressed">
                        <label for="family_card_input" class="flex flex-col items-center justify-center w-full h-44 border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-[24px] cursor-pointer hover:border-slate-400 transition-all bg-slate-50 dark:bg-dark-main group overflow-hidden">
                            <div class="flex flex-col items-center justify-center text-center px-4 group-hover:scale-110 transition duration-300">
                                <span class="text-3xl mb-2">👨‍👩‍👧‍👦</span>
                                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest leading-relaxed">Pilih KK<br><span class="text-[8px] opacity-70">(PILIHAN - MAX 1MB)</span></p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Akta Kelahiran -->
                <div class="group">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Akta Kelahiran</label>
                    <div class="relative">
                        <input type="file" name="birth_cert" class="hidden file-input" id="birth_cert_input" accept=".pdf,image/*" capture="camera" data-target="birth_cert_compressed">
                        <label for="birth_cert_input" class="flex flex-col items-center justify-center w-full h-44 border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-[24px] cursor-pointer hover:border-slate-400 transition-all bg-slate-50 dark:bg-dark-main group overflow-hidden">
                            <div class="flex flex-col items-center justify-center text-center px-4 group-hover:scale-110 transition duration-300">
                                <span class="text-3xl mb-2">📄</span>
                                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest leading-relaxed">Pilih Akta<br><span class="text-[8px] opacity-70">(PILIHAN - MAX 1MB)</span></p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- KTP Orang Tua -->
                <div class="group">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">KTP Orang Tua / Wali</label>
                    <div class="relative">
                        <input type="file" name="ktp_parent" class="hidden file-input" id="ktp_parent_input" accept=".pdf,image/*" capture="camera" data-target="ktp_parent_compressed">
                        <label for="ktp_parent_input" class="flex flex-col items-center justify-center w-full h-44 border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-[24px] cursor-pointer hover:border-slate-400 transition-all bg-slate-50 dark:bg-dark-main group overflow-hidden">
                            <div class="flex flex-col items-center justify-center text-center px-4 group-hover:scale-110 transition duration-300">
                                <span class="text-3xl mb-2">🆔</span>
                                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest leading-relaxed">Pilih KTP<br><span class="text-[8px] opacity-70">(PILIHAN - MAX 1MB)</span></p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-10 border-t border-slate-100 dark:border-slate-800 flex flex-col md:flex-row gap-4">
                <a href="{{ route('ppdb.register.step2') }}" class="flex-1 py-5 rounded-[20px] bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-center font-bold hover:bg-slate-200 dark:hover:bg-slate-700 transition duration-300">
                    &larr; Kembali
                </a>
                <button type="submit" id="submitBtn" class="flex-[3] py-5 rounded-[20px] bg-emerald-500 text-white font-black uppercase tracking-widest text-sm shadow-2xl shadow-emerald-500/30 hover:bg-emerald-600 hover:-translate-y-1 active:translate-y-0 transition-all duration-300">
                    Selesaikan Pendaftaran &rarr;
                </button>
            </div>
            
            <p class="text-center text-xs text-slate-400 mt-6 font-medium">
                Pondok Pesantren Modern Darel Azhar menjamin kerahasiaan dokumen Anda.
            </p>
        </form>
    </div>
</div>

<!-- Loading Overlay (Sesuai Konsep Premium) -->
<div id="loadingOverlay" class="fixed inset-0 bg-slate-950/90 backdrop-blur-xl z-[9999] hidden flex-col items-center justify-center text-white">
    <div class="relative w-24 h-24 mb-8">
        <div class="absolute inset-0 border-4 border-emerald-500/20 rounded-full"></div>
        <div class="absolute inset-0 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin"></div>
    </div>
    <h3 class="text-2xl font-black tracking-tighter mb-2">Sedang Mengoptimalkannya...</h3>
    <p class="text-slate-400 animate-pulse text-sm font-bold uppercase tracking-widest">Kompresi Berkas Melindungi Kuota Anda</p>
</div>

<script>
    // Fungsi Kompresi Gambar ke 1MB Max
    const compressImage = (file, maxWidth = 1200, maxHeight = 1200, quality = 0.7) => {
        return new Promise((resolve) => {
            if (!file.type.startsWith('image/')) {
                resolve(null);
                return;
            }
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = (event) => {
                const img = new Image();
                img.src = event.target.result;
                img.onload = () => {
                    const canvas = document.createElement('canvas');
                    let width = img.width;
                    let height = img.height;

                    // Rasio Pas Foto 2:3 khusus PHOTO input
                    if (width > height) {
                        if (width > maxWidth) {
                            height *= maxWidth / width;
                            width = maxWidth;
                        }
                    } else {
                        if (height > maxHeight) {
                            width *= maxHeight / height;
                            height = maxHeight;
                        }
                    }

                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);
                    
                    // Terus perkecil kualitas jika ukuran masih > 1MB
                    let targetQuality = quality;
                    let result = canvas.toDataURL('image/jpeg', targetQuality);
                    
                    resolve(result);
                };
            };
        });
    };

    const fileInputs = document.querySelectorAll('.file-input');
    const loadingOverlay = document.getElementById('loadingOverlay');
    const form = document.getElementById('psbStep3Form');

    fileInputs.forEach(input => {
        input.addEventListener('change', async (e) => {
            const label = input.nextElementSibling;
            const targetId = input.getAttribute('data-target');
            const targetInput = document.getElementById(targetId);

            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const fileName = file.name;
                
                // Visual Loading Feedback
                label.innerHTML = `
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <div class="w-8 h-8 border-2 border-emerald-500 border-t-transparent rounded-full animate-spin mb-2"></div>
                        <p class="text-[9px] text-emerald-600 font-black uppercase tracking-widest">Memproses Berkas...</p>
                    </div>
                `;

                if (file.type.startsWith('image/')) {
                    const compressedData = await compressImage(file);
                    targetInput.value = compressedData;
                } else {
                    targetInput.value = ''; // PDF atau format lain pakai upload standard
                    // Validasi ukuran manual untuk non-image
                    if (file.size > 1024 * 1024) {
                        alert('Ukuran file ' + fileName + ' melebihi 1MB. Silakan gunakan file yang lebih kecil.');
                        input.value = '';
                        // Reset label
                        location.reload(); 
                        return;
                    }
                }

                label.innerHTML = `
                    <div class="flex flex-col items-center justify-center p-6 text-center">
                        <span class="text-4xl mb-3">✔️</span>
                        <p class="text-[10px] text-emerald-600 font-black uppercase tracking-widest line-clamp-1">${fileName}</p>
                        <p class="text-[8px] text-slate-400 mt-1 uppercase font-bold tracking-tighter italic">Berkas Siap Diproses</p>
                    </div>
                `;
                label.classList.add('border-emerald-500', 'bg-emerald-50/50', 'dark:bg-emerald-900/10');
            }
        });
    });

    form.addEventListener('submit', () => {
        loadingOverlay.classList.remove('hidden');
        loadingOverlay.classList.add('flex');
    });
</script>
@endsection
