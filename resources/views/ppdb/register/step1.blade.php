@extends('layouts.app')

@section('title', 'Biodata Santri - PPDB')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <!-- Progress Stepper (Updated) -->
    <div class="mb-12 flex justify-between items-center relative gap-4">
        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-slate-200 dark:bg-slate-800 -z-10 rounded-full"></div>
        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-[12.5%] h-1 bg-emerald-500 -z-10 rounded-full transition-all duration-1000"></div>
        
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-bold shadow-xl shadow-emerald-500/30 scale-110">1</div>
            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-emerald-600 dark:text-emerald-400">Biodata</span>
        </div>
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 text-slate-400 flex items-center justify-center font-bold">2</div>
            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-slate-400">Orang Tua</span>
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
        <h2 class="text-3xl font-extrabold text-light-text dark:text-white tracking-tight mb-3">Biodata Calon Santri</h2>
        <p class="text-slate-500 dark:text-slate-400 mb-10 text-sm leading-relaxed">Silakan lengkapi data diri calon santri sesuai dengan dokumen resmi (Akta Kelahiran/Kartu Keluarga).</p>

        <form action="{{ route('ppdb.register.store1') }}" method="POST" class="space-y-8">
            @csrf
            <input type="hidden" name="step" value="1">

            <div class="grid grid-cols-1 gap-8">
                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Nama Lengkap</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $registration->full_name ?? '') }}" 
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white placeholder-slate-400" required placeholder="Masukkan nama sesuai Akta Kelahiran">
                    @error('full_name') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-tight">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Tempat Lahir -->
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Tempat Lahir</label>
                        <input type="text" name="birth_place" value="{{ old('birth_place', $registration->birth_place ?? '') }}" 
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" required placeholder="Kota kelahiran">
                    </div>
                    <!-- Tanggal Lahir -->
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Tanggal Lahir</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date', $registration->birth_date ? $registration->birth_date->format('Y-m-d') : '') }}" 
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Jenis Kelamin</label>
                        <select name="gender" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white appearance-none" required>
                            <option value="">Pilih</option>
                            <option value="L" {{ old('gender', $registration->gender ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('gender', $registration->gender ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <!-- Agama -->
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Agama</label>
                        <input type="text" name="religion" value="{{ old('religion', $registration->religion ?? 'Islam') }}" 
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" required>
                    </div>
                </div>

                <!-- Alamat -->
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Alamat Lengkap</label>
                    <textarea name="address" rows="4" 
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white placeholder-slate-400" required placeholder="Jl. Nama Jalan, No, RT/RW, Kec, Kota/Kab">{{ old('address', $registration->address ?? '') }}</textarea>
                </div>
            </div>

            <div class="pt-8">
                <button type="submit" class="w-full py-5 rounded-[20px] bg-emerald-500 text-white font-black uppercase tracking-widest text-sm shadow-2xl shadow-emerald-500/30 hover:bg-emerald-600 hover:-translate-y-1 active:translate-y-0 transition-all duration-300">
                    Lanjut ke Data Orang Tua &rarr;
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
