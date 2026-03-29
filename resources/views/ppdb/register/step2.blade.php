@extends('layouts.app')

@section('title', 'Data Orang Tua - PPDB')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <!-- Progress Stepper -->
    <div class="mb-12">
        <div class="flex items-center justify-between relative">
            <div class="absolute top-1/2 left-0 w-full h-0.5 bg-slate-200 dark:bg-gray-800 -translate-y-1/2"></div>
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-gray-800 text-slate-500 flex items-center justify-center font-bold">1</div>
                <span class="mt-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Biodata</span>
            </div>
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-[#1e293b] dark:bg-white text-white dark:text-black flex items-center justify-center font-bold shadow-lg">2</div>
                <span class="mt-2 text-xs font-bold text-slate-800 dark:text-white uppercase tracking-wider">Orang Tua</span>
            </div>
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-gray-800 text-slate-500 flex items-center justify-center font-bold">3</div>
                <span class="mt-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Berkas</span>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl p-8 md:p-12 shadow-2xl border border-slate-100 dark:border-gray-900">
        <h2 class="text-3xl font-extrabold text-[#1e293b] dark:text-white tracking-tight mb-2">Data Orang Tua & Asal Sekolah</h2>
        <p class="text-slate-500 dark:text-gray-400 mb-8">Lengkapi informasi wali dan riwayat pendidikan santri.</p>

        <form action="{{ route('ppdb.register.store2') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="step" value="2">

            <div class="space-y-8">
                <!-- Section: Orang Tua -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-2">Nama Ayah Kandung</label>
                        <input type="text" name="father_name" value="{{ old('father_name', $registration->father_name ?? '') }}" 
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-2">Nama Ibu Kandung</label>
                        <input type="text" name="mother_name" value="{{ old('mother_name', $registration->mother_name ?? '') }}" 
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-2">No. WhatsApp Wali</label>
                        <input type="text" name="parent_phone" value="{{ old('parent_phone', $registration->parent_phone ?? '') }}" 
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm" required placeholder="08xxxxxx">
                    </div>
                    <div>
                        <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-2">Pekerjaan Orang Tua</label>
                        <input type="text" name="parent_job" value="{{ old('parent_job', $registration->parent_job ?? '') }}" 
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm" required>
                    </div>
                </div>

                <hr class="border-slate-100 dark:border-gray-900">

                <!-- Section: Asal Sekolah -->
                <div>
                    <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-2">Nama Asal Sekolah (SD/MI)</label>
                    <input type="text" name="origin_school" value="{{ old('origin_school', $registration->origin_school ?? '') }}" 
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-2">Alamat Asal Sekolah</label>
                        <textarea name="origin_school_address" rows="3" 
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm" required>{{ old('origin_school_address', $registration->origin_school_address ?? '') }}</textarea>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-2">Tahun Lulus</label>
                    <input type="number" name="graduation_year" value="{{ old('graduation_year', $registration->graduation_year ?? date('Y')) }}" 
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm" required min="2000" max="{{ date('Y')+1 }}">
                </div>
            </div>

            <div class="pt-6 flex flex-col md:flex-row gap-4">
                <a href="{{ route('ppdb.register.step1') }}" class="flex-1 py-5 rounded-2xl bg-slate-100 dark:bg-gray-900 text-[#1e293b] dark:text-white text-center font-bold hover:bg-slate-200 dark:hover:bg-gray-800 transition">
                    Kembali
                </a>
                <button type="submit" class="flex-[2] py-5 rounded-2xl bg-[#1e293b] dark:bg-white text-white dark:text-black font-extrabold text-lg shadow-xl hover:scale-[1.02] active:scale-95 transition-all duration-300">
                    Lanjut ke Upload Berkas
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
