@extends('layouts.app')

@section('title', 'Upload Berkas - PPDB')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <!-- Progress Stepper -->
    <div class="mb-12">
        <div class="flex items-center justify-between relative">
            <div class="absolute top-1/2 left-0 w-full h-0.5 bg-slate-200 dark:bg-gray-800 -translate-y-1/2"></div>
            <!-- Step 1 -->
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold shadow-lg">✓</div>
                <span class="mt-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Biodata</span>
            </div>
            <!-- Step 2 -->
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold shadow-lg">✓</div>
                <span class="mt-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Orang Tua</span>
            </div>
            <!-- Step 3 -->
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-12 h-12 rounded-full bg-[#1e293b] dark:bg-white text-white dark:text-black flex items-center justify-center font-bold shadow-xl border-4 border-white dark:border-[#0a0a0a]">3</div>
                <span class="mt-2 text-xs font-bold text-slate-800 dark:text-white uppercase tracking-wider">Berkas</span>
            </div>
            <!-- Step 4 -->
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-gray-800 text-slate-500 flex items-center justify-center font-bold">4</div>
                <span class="mt-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Review</span>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl p-8 md:p-12 shadow-2xl border border-slate-100 dark:border-gray-900">
        <h2 class="text-3xl font-extrabold text-[#1e293b] dark:text-white tracking-tight mb-2">Upload Berkas Pendukung</h2>
        <p class="text-slate-500 dark:text-gray-400 mb-8">Format file: JPG, PNG, atau PDF. Maksimal 2MB per file.</p>

        <form id="ppdbStep3Form" action="{{ route('ppdb.register.store3') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <input type="hidden" name="step" value="3">
            
            <!-- Hidden inputs for compressed data -->
            <input type="hidden" name="photo_compressed" id="photo_compressed">
            <input type="hidden" name="birth_cert_compressed" id="birth_cert_compressed">
            <input type="hidden" name="ijazah_compressed" id="ijazah_compressed">
            <input type="hidden" name="skhu_compressed" id="skhu_compressed">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Pas Foto -->
                <div class="group">
                    <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-3">Pas Foto (3x4)</label>
                    <div class="relative">
                        <input type="file" name="photo" class="hidden file-input" id="photo_input" accept="image/*" data-target="photo_compressed">
                        <label for="photo_input" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-slate-200 dark:border-gray-800 rounded-3xl cursor-pointer hover:border-[#1e293b] dark:hover:border-white transition-all bg-slate-50 dark:bg-gray-900 overflow-hidden">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                <span class="text-3xl mb-2">📸</span>
                                <p class="text-xs text-slate-500 dark:text-gray-400 font-bold uppercase tracking-widest leading-relaxed">Pilih Foto<br>Wajib Image</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Akta Kelahiran -->
                <div class="group">
                    <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-3">Akta Kelahiran</label>
                    <div class="relative">
                        <input type="file" name="birth_cert" class="hidden file-input" id="birth_cert_input" accept=".pdf,image/*" data-target="birth_cert_compressed">
                        <label for="birth_cert_input" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-slate-200 dark:border-gray-800 rounded-3xl cursor-pointer hover:border-[#1e293b] dark:hover:border-white transition-all bg-slate-50 dark:bg-gray-900 overflow-hidden">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                <span class="text-3xl mb-2">📄</span>
                                <p class="text-xs text-slate-500 dark:text-gray-400 font-bold uppercase tracking-widest">Pilih Berkas<br>PDF / Image</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Ijazah -->
                <div class="group">
                    <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-3">Ijazah Terakhir</label>
                    <div class="relative">
                        <input type="file" name="ijazah" class="hidden file-input" id="ijazah_input" accept=".pdf,image/*" data-target="ijazah_compressed">
                        <label for="ijazah_input" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-slate-200 dark:border-gray-800 rounded-3xl cursor-pointer hover:border-[#1e293b] dark:hover:border-white transition-all bg-slate-50 dark:bg-gray-900 overflow-hidden">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                <span class="text-3xl mb-2">🎓</span>
                                <p class="text-xs text-slate-500 dark:text-gray-400 font-bold uppercase tracking-widest">Pilih Berkas<br>PDF / Image</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- SKHU -->
                <div class="group">
                    <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-3">SKHU / Surat Keterangan</label>
                    <div class="relative">
                        <input type="file" name="skhu" class="hidden file-input" id="skhu_input" accept=".pdf,image/*" data-target="skhu_compressed">
                        <label for="skhu_input" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-slate-200 dark:border-gray-800 rounded-3xl cursor-pointer hover:border-[#1e293b] dark:hover:border-white transition-all bg-slate-50 dark:bg-gray-900 overflow-hidden">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                <span class="text-3xl mb-2">📝</span>
                                <p class="text-xs text-slate-500 dark:text-gray-400 font-bold uppercase tracking-widest">Pilih Berkas<br>PDF / Image</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-10 border-t border-slate-100 dark:border-gray-900 flex flex-col md:flex-row gap-4">
                <a href="{{ route('ppdb.register.step2') }}" class="flex-1 py-5 rounded-2xl bg-slate-100 dark:bg-gray-900 text-[#1e293b] dark:text-white text-center font-bold hover:bg-slate-200 dark:hover:bg-gray-800 transition">
                    Kembali
                </a>
                <button type="submit" id="submitBtn" class="flex-[3] py-5 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xl shadow-xl hover:scale-[1.02] active:scale-95 transition-all duration-300">
                    Selesaikan Pendaftaran 🚀
                </button>
            </div>
            
            <p class="text-center text-xs text-slate-400 mt-6">
                Dengan menekan tombol di atas, saya menyatakan data yang diisi adalah benar dan dapat dipertanggungjawabkan.
            </p>
        </form>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 bg-slate-950/80 backdrop-blur-md z-[9999] hidden flex-col items-center justify-center text-white">
    <div class="w-20 h-20 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin mb-6"></div>
    <h3 class="text-2xl font-black tracking-tighter mb-2">Memproses Berkas...</h3>
    <p class="text-slate-400 animate-pulse font-medium">Mohon tunggu, sedang mengoptimalkan ukuran file.</p>
</div>

<script>
    const compressImage = (file, maxWidth = 1200, maxHeight = 1200, quality = 0.8) => {
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
                    resolve(canvas.toDataURL('image/jpeg', quality));
                };
            };
        });
    };

    const fileInputs = document.querySelectorAll('.file-input');
    const loadingOverlay = document.getElementById('loadingOverlay');
    const form = document.getElementById('ppdbStep3Form');

    fileInputs.forEach(input => {
        input.addEventListener('change', async (e) => {
            const label = input.nextElementSibling;
            const targetId = input.getAttribute('data-target');
            const targetInput = document.getElementById(targetId);

            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const fileName = file.name;
                
                // Visual feedback immediately
                label.innerHTML = `
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <span class="text-3xl mb-2">⏳</span>
                        <p class="text-xs text-amber-600 font-bold uppercase tracking-widest">Memproses...</p>
                    </div>
                `;

                if (file.type.startsWith('image/')) {
                    const compressedData = await compressImage(file);
                    targetInput.value = compressedData;
                } else {
                    targetInput.value = ''; // Not an image, use standard file upload
                }

                label.innerHTML = `
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <span class="text-3xl mb-2">✅</span>
                        <p class="text-xs text-emerald-600 dark:text-emerald-400 font-bold uppercase tracking-widest">${fileName}</p>
                        <p class="text-[10px] text-slate-400">Klik untuk mengganti</p>
                    </div>
                `;
                label.classList.add('border-emerald-500', 'bg-emerald-50', 'dark:bg-emerald-900/10');
            }
        });
    });

    form.addEventListener('submit', () => {
        loadingOverlay.classList.remove('hidden');
        loadingOverlay.classList.add('flex');
    });
</script>
@endsection
