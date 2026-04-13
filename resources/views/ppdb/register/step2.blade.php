@extends('layouts.app')

@section('title', 'Data Orang Tua/Wali - PSB')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <!-- Progress Stepper -->
    <div class="mb-12 flex justify-between items-center relative gap-4">
        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-slate-200 dark:bg-slate-800 -z-10 rounded-full"></div>
        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-[37.5%] h-1 bg-emerald-500 -z-10 rounded-full transition-all duration-1000"></div>
        
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-bold shadow-lg shadow-emerald-500/20 transition-all duration-500 scale-90 opacity-80">✓</div>
            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-slate-400">Biodata</span>
        </div>
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-bold shadow-xl shadow-emerald-500/30 scale-110">2</div>
            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-emerald-600 dark:text-emerald-400">Orang Tua</span>
        </div>
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 text-slate-400 flex items-center justify-center font-bold">3</div>
            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-slate-400">Berkas</span>
        </div>
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 text-slate-400 flex items-center justify-center font-bold">4</div>
            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-slate-400">Finalisasi</span>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-dark-card rounded-[32px] p-8 md:p-12 shadow-2xl shadow-emerald-900/10 border border-slate-100 dark:border-slate-800">
        <h2 class="text-3xl font-extrabold text-light-text dark:text-white tracking-tight mb-3">Data Orang Tua / Wali Murid</h2>
        <p class="text-slate-500 dark:text-slate-400 mb-10 text-sm leading-relaxed">Silakan lengkapi kontak orang tua atau wali untuk memudahkan koordinasi panitia PSB.</p>

        <form action="{{ route('ppdb.register.store2') }}" method="POST" class="space-y-8">
            @csrf
            <input type="hidden" name="step" value="2">

            <div class="space-y-12">
                <!-- Bagian: Data Ayah -->
                <div class="bg-slate-50 dark:bg-slate-800/30 p-8 rounded-3xl border border-slate-100 dark:border-slate-800">
                    <h3 class="text-sm font-black text-slate-800 dark:text-slate-200 uppercase tracking-widest mb-6 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-[10px]">1</span> Data Ayah Kandung
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Nama Lengkap Ayah</label>
                            <input type="text" name="father_name" value="{{ old('father_name', $registration->father_name ?? '') }}" 
                                class="w-full px-6 py-4 rounded-2xl bg-white dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" placeholder="Nama Ayah">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">No. Telepon Bapak (Wajib WA Aktif)</label>
                            <input type="text" name="father_phone" value="{{ old('father_phone', $registration->father_phone ?? '') }}" 
                                class="w-full px-6 py-4 rounded-2xl bg-white dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-mono" placeholder="08xxxxxxxxxx">
                        </div>
                    </div>
                </div>

                <!-- Bagian: Data Ibu -->
                <div class="bg-slate-50 dark:bg-slate-800/30 p-8 rounded-3xl border border-slate-100 dark:border-slate-800">
                    <h3 class="text-sm font-black text-slate-800 dark:text-slate-200 uppercase tracking-widest mb-6 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center text-[10px]">2</span> Data Ibu Kandung
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Nama Lengkap Ibu</label>
                            <input type="text" name="mother_name" value="{{ old('mother_name', $registration->mother_name ?? '') }}" 
                                class="w-full px-6 py-4 rounded-2xl bg-white dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" placeholder="Nama Ibu">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">No. Telepon Ibu (Wajib WA Aktif)</label>
                            <input type="text" name="mother_phone" value="{{ old('mother_phone', $registration->mother_phone ?? '') }}" 
                                class="w-full px-6 py-4 rounded-2xl bg-white dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-mono" placeholder="08xxxxxxxxxx">
                        </div>
                    </div>
                </div>

                <!-- Bagian: Data Wali -->
                <div class="bg-emerald-50/50 dark:bg-emerald-900/10 p-8 rounded-3xl border border-emerald-100/50 dark:border-emerald-800/30">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-sm font-black text-emerald-800 dark:text-emerald-200 uppercase tracking-widest flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-emerald-200 dark:bg-emerald-800 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-[10px]">3</span> Data Wali Murid
                        </h3>
                        <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/50 text-[10px] font-black text-emerald-600 uppercase tracking-widest rounded-full">Khusus Yatim/Piatu</span>
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-8 leading-relaxed">Wajib diisi apabila calon santri berstatus Yatim/Piatu atau tinggal bersama Wali.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Nama Lengkap Wali</label>
                            <input type="text" name="guardian_name" value="{{ old('guardian_name', $registration->guardian_name ?? '') }}" 
                                class="w-full px-6 py-4 rounded-2xl bg-white dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" placeholder="Nama Wali">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">No. Telepon Wali (Wajib WA Aktif)</label>
                            <input type="text" name="guardian_phone" value="{{ old('guardian_phone', $registration->guardian_phone ?? '') }}" 
                                class="w-full px-6 py-4 rounded-2xl bg-white dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-mono" placeholder="08xxxxxxxxxx">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pesan Error Dinamis -->
            @if ($errors->any())
                <div class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-2xl">
                    <ul class="list-disc list-inside text-xs font-bold text-red-600 dark:text-red-400">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="pt-10 flex flex-col md:flex-row gap-4">
                <a href="{{ route('ppdb.register.step1') }}" class="flex-1 py-5 rounded-[20px] bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-center font-bold hover:bg-slate-200 dark:hover:bg-slate-700 transition duration-300">
                    &larr; Kembali (Biodata)
                </a>
                <button type="submit" class="flex-[2] py-5 rounded-[20px] bg-emerald-500 text-white font-black uppercase tracking-widest text-sm shadow-2xl shadow-emerald-500/30 hover:bg-emerald-600 hover:-translate-y-1 active:translate-y-0 transition-all duration-300">
                    Simpan & Lanjut ke Berkas &rarr;
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
