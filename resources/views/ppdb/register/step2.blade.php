@extends('layouts.app')

@section('title', 'Data Orang Tua - PPDB')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <!-- Progress Stepper (Updated) -->
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

    <!-- Form Card (Updated) -->
    <div class="bg-white dark:bg-dark-card rounded-[32px] p-8 md:p-12 shadow-2xl shadow-emerald-900/10 border border-slate-100 dark:border-slate-800">
        <h2 class="text-3xl font-extrabold text-light-text dark:text-white tracking-tight mb-3">Data Orang Tua & Asal Sekolah</h2>
        <p class="text-slate-500 dark:text-slate-400 mb-10 text-sm leading-relaxed">Lengkapi informasi wali dan riwayat pendidikan terakhir santri.</p>

        <form action="{{ route('ppdb.register.store2') }}" method="POST" class="space-y-8">
            @csrf
            <input type="hidden" name="step" value="2">

            <div class="space-y-10">
                <!-- Section: Orang Tua -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Nama Ayah Kandung</label>
                        <input type="text" name="father_name" value="{{ old('father_name', $registration->father_name ?? '') }}" 
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Nama Ibu Kandung</label>
                        <input type="text" name="mother_name" value="{{ old('mother_name', $registration->mother_name ?? '') }}" 
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">No. WhatsApp Wali</label>
                        <input type="text" name="parent_phone" value="{{ old('parent_phone', $registration->parent_phone ?? '') }}" 
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" required placeholder="08xxxxxxxxxx">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Pekerjaan Orang Tua</label>
                        <input type="text" name="parent_job" value="{{ old('parent_job', $registration->parent_job ?? '') }}" 
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" required>
                    </div>
                </div>

                <div class="border-t border-slate-100 dark:border-slate-800 pt-10">
                    <h3 class="text-xs font-black text-emerald-500 uppercase tracking-widest mb-8">Informasi Pendidikan Sebelumnya</h3>
                    
                    <div class="grid grid-cols-1 gap-8">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Nama Asal Sekolah (SD/MI)</label>
                            <input type="text" name="origin_school" value="{{ old('origin_school', $registration->origin_school ?? '') }}" 
                                class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" required placeholder="Nama sekolah asal">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Alamat Asal Sekolah</label>
                            <textarea name="origin_school_address" rows="3" 
                                class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white placeholder-slate-400" required placeholder="Alamat lengkap sekolah asal">{{ old('origin_school_address', $registration->origin_school_address ?? '') }}</textarea>
                        </div>

                        <div class="w-1/2">
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Tahun Lulus</label>
                            <input type="number" name="graduation_year" value="{{ old('graduation_year', $registration->graduation_year ?? date('Y')) }}" 
                                class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" required min="2000" max="{{ date('Y')+1 }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-10 flex flex-col md:flex-row gap-4">
                <a href="{{ route('ppdb.register.step1') }}" class="flex-1 py-5 rounded-[20px] bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-center font-bold hover:bg-slate-200 dark:hover:bg-slate-700 transition duration-300">
                    &larr; Kembali
                </a>
                <button type="submit" class="flex-[2] py-5 rounded-[20px] bg-emerald-500 text-white font-black uppercase tracking-widest text-sm shadow-2xl shadow-emerald-500/30 hover:bg-emerald-600 hover:-translate-y-1 active:translate-y-0 transition-all duration-300">
                    Lanjut ke Upload Berkas &rarr;
                </button>
            </div>
        </form>
    </div>
        </form>
    </div>
</div>
@endsection
