@extends('layouts.app')

@section('title', 'Biodata Santri - PPDB')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <!-- Progress Stepper -->
    <div class="mb-12">
        <div class="flex items-center justify-between relative">
            <div class="absolute top-1/2 left-0 w-full h-0.5 bg-slate-200 dark:bg-gray-800 -translate-y-1/2"></div>
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-[#1e293b] dark:bg-white text-white dark:text-black flex items-center justify-center font-bold shadow-lg">1</div>
                <span class="mt-2 text-xs font-bold text-slate-800 dark:text-white uppercase tracking-wider">Biodata</span>
            </div>
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-gray-800 text-slate-500 flex items-center justify-center font-bold">2</div>
                <span class="mt-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Orang Tua</span>
            </div>
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-gray-800 text-slate-500 flex items-center justify-center font-bold">3</div>
                <span class="mt-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Berkas</span>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl p-8 md:p-12 shadow-2xl border border-slate-100 dark:border-gray-900">
        <h2 class="text-3xl font-extrabold text-[#1e293b] dark:text-white tracking-tight mb-2">Data Diri Santri</h2>
        <p class="text-slate-500 dark:text-gray-400 mb-8">Lengkapi informasi biodata calon santri di bawah ini.</p>

        <form action="{{ route('ppdb.register.store1') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="step" value="1">

            <div class="grid grid-cols-1 gap-6">
                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-2">Nama Lengkap</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $registration->full_name ?? '') }}" 
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm" required placeholder="Masukkan nama sesuai Akta Kelahiran">
                    @error('full_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tempat Lahir -->
                    <div>
                        <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-2">Tempat Lahir</label>
                        <input type="text" name="birth_place" value="{{ old('birth_place', $registration->birth_place ?? '') }}" 
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm" required>
                    </div>
                    <!-- Tanggal Lahir -->
                    <div>
                        <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-2">Tanggal Lahir</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date', $registration->birth_date ? $registration->birth_date->format('Y-m-d') : '') }}" 
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-2">Jenis Kelamin</label>
                        <select name="gender" class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm" required>
                            <option value="">Pilih</option>
                            <option value="L" {{ old('gender', $registration->gender ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('gender', $registration->gender ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <!-- Agama -->
                    <div>
                        <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-2">Agama</label>
                        <input type="text" name="religion" value="{{ old('religion', $registration->religion ?? 'Islam') }}" 
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm" required>
                    </div>
                </div>

                <!-- Alamat -->
                <div>
                    <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-2">Alamat Lengkap</label>
                    <textarea name="address" rows="4" 
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm" required placeholder="Jl. Nama Jalan, No, RT/RW, Kec, Kota/Kab">{{ old('address', $registration->address ?? '') }}</textarea>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-5 rounded-2xl bg-[#1e293b] dark:bg-white text-white dark:text-black font-extrabold text-lg shadow-xl hover:scale-[1.02] active:scale-95 transition-all duration-300">
                    Lanjut ke Data Orang Tua
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
