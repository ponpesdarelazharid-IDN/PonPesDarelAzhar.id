@extends('layouts.admin')

@section('title', 'Verifikasi Pendaftar - ' . $registration->full_name)

@section('content')
<div class="relative">
    <!-- Header -->
    <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <a href="{{ route('admin.registrations.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-emerald-500 transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Daftar
            </a>
            <h1 class="text-4xl font-extrabold text-[#111c3a] dark:text-white tracking-tight mt-6">{{ $registration->full_name }}</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1 font-medium italic">No. Registrasi: <span class="font-black text-emerald-500">{{ $registration->registration_number }}</span></p>
        </div>
        
        <div @class([
            'px-8 py-4 rounded-[24px] text-xs font-black uppercase tracking-widest shadow-xl transition-all duration-500 border',
            'bg-amber-50 text-amber-600 border-amber-100 dark:bg-amber-900/20 dark:border-amber-800' => $registration->status == 'pending',
            'bg-blue-50 text-blue-600 border-blue-100 dark:bg-blue-900/20 dark:border-blue-800' => $registration->status == 'verified',
            'bg-emerald-50 text-emerald-600 border-emerald-100 dark:bg-emerald-900/30 dark:border-emerald-800' => $registration->status == 'accepted',
            'bg-red-50 text-red-600 border-red-100 dark:bg-red-900/20 dark:border-red-800' => $registration->status == 'rejected',
        ])>
            Status: <span class="ml-1 tracking-[0.2em]">{{ $registration->status }}</span>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Left Column: Details -->
        <div class="lg:col-span-2 space-y-10">
            <!-- Biodata Section -->
            <div class="bg-white dark:bg-dark-card rounded-[40px] p-8 md:p-10 shadow-2xl shadow-slate-900/5 border border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-500 rounded-2xl flex items-center justify-center text-xl">👤</div>
                    <h3 class="text-xl font-extrabold text-[#111c3a] dark:text-white uppercase tracking-tight">Biodata Calon Santri</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                    <div class="space-y-1.5 border-l-2 border-slate-50 dark:border-slate-800 pl-5 hover:border-emerald-500 transition-colors duration-300">
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Tempat, Tanggal Lahir</p>
                        <p class="font-bold text-[#111c3a] dark:text-white">{{ $registration->birth_place }}, {{ $registration->birth_date->format('d M Y') }}</p>
                    </div>
                    <div class="space-y-1.5 border-l-2 border-slate-50 dark:border-slate-800 pl-5 hover:border-emerald-500 transition-colors duration-300">
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Jenis Kelamin</p>
                        <p class="font-bold text-[#111c3a] dark:text-white">{{ $registration->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                    </div>
                    <div class="space-y-1.5 border-l-2 border-slate-50 dark:border-slate-800 pl-5 hover:border-emerald-500 transition-colors duration-300">
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Agama</p>
                        <p class="font-bold text-[#111c3a] dark:text-white">{{ $registration->religion }}</p>
                    </div>
                    <div class="space-y-1.5 border-l-2 border-slate-50 dark:border-slate-800 pl-5 hover:border-emerald-500 transition-colors duration-300">
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Alamat Lengkap</p>
                        <p class="font-bold text-[#111c3a] dark:text-white leading-relaxed">{{ $registration->address }}</p>
                    </div>
                </div>
            </div>

            <!-- Parents & School Section -->
            <div class="bg-white dark:bg-dark-card rounded-[40px] p-8 md:p-10 shadow-2xl shadow-slate-900/5 border border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-amber-50 dark:bg-amber-900/20 text-amber-500 rounded-2xl flex items-center justify-center text-xl">👨‍👩‍👧</div>
                    <h3 class="text-xl font-extrabold text-[#111c3a] dark:text-white uppercase tracking-tight">Orang Tua & Asal Sekolah</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                    <div class="space-y-1.5 border-l-2 border-slate-50 dark:border-slate-800 pl-5 hover:border-amber-500 transition-colors duration-300">
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Nama Ayah / Ibu</p>
                        <p class="font-bold text-[#111c3a] dark:text-white">{{ $registration->father_name }} / {{ $registration->mother_name }}</p>
                    </div>
                    <div class="space-y-1.5 border-l-2 border-slate-50 dark:border-slate-800 pl-5 hover:border-amber-500 transition-colors duration-300">
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">No. WhatsApp Wali</p>
                        <p class="font-bold text-emerald-500 dark:text-emerald-400">{{ $registration->parent_phone }}</p>
                    </div>
                    <div class="space-y-1.5 border-l-2 border-slate-50 dark:border-slate-800 pl-5 hover:border-amber-500 transition-colors duration-300 md:col-span-2">
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Pekerjaan Wali</p>
                        <p class="font-bold text-[#111c3a] dark:text-white">{{ $registration->parent_job }}</p>
                    </div>
                    <div class="md:col-span-2 h-px bg-slate-50 dark:bg-slate-800 my-2"></div>
                    <div class="space-y-1.5 border-l-2 border-slate-50 dark:border-slate-800 pl-5 hover:border-indigo-500 transition-colors duration-300">
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Asal Sekolah</p>
                        <p class="font-bold text-[#111c3a] dark:text-white">{{ $registration->origin_school }}</p>
                    </div>
                    <div class="space-y-1.5 border-l-2 border-slate-50 dark:border-slate-800 pl-5 hover:border-indigo-500 transition-colors duration-300">
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Tahun Lulus</p>
                        <p class="font-bold text-[#111c3a] dark:text-white">{{ $registration->graduation_year }}</p>
                    </div>
                </div>
            </div>

            <!-- Documents Section -->
            <div class="bg-white dark:bg-dark-card rounded-[40px] p-8 md:p-10 shadow-2xl shadow-slate-900/5 border border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-500 rounded-2xl flex items-center justify-center text-xl">📄</div>
                    <h3 class="text-xl font-extrabold text-[#111c3a] dark:text-white uppercase tracking-tight">Dokumen Pendaftaran</h3>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <!-- Photo -->
                    <div class="space-y-3 text-center">
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Foto 3x4</p>
                        @if($registration->photo_url)
                            <a href="{{ $registration->photo_url }}" target="_blank" class="block w-full h-40 rounded-[24px] overflow-hidden shadow-lg group border-2 border-white dark:border-slate-800 relative">
                                <img src="{{ $registration->photo_url }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="text-[8px] bg-white text-black px-2 py-1 rounded-full font-black uppercase">Click Preview</span>
                                </div>
                            </a>
                        @else
                            <div class="w-full h-40 rounded-[24px] bg-slate-50 dark:bg-dark-main flex items-center justify-center text-slate-300 italic text-xs">Kosong</div>
                        @endif
                    </div>
                    <!-- Birth Cert -->
                    <div class="space-y-3 text-center">
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Akta Lahir</p>
                        @if($registration->birth_cert_url)
                            <a href="{{ $registration->birth_cert_url }}" target="_blank" class="flex flex-col items-center justify-center w-full h-40 rounded-[24px] bg-blue-50/50 dark:bg-blue-900/10 text-blue-600 dark:text-blue-400 hover:bg-blue-500 hover:text-white transition-all shadow-sm border border-blue-100 dark:border-blue-800 group">
                                <span class="text-3xl mb-2 group-hover:scale-125 transition-transform duration-500">📜</span>
                                <strong class="text-[10px] uppercase tracking-widest">Lihat File</strong>
                            </a>
                        @else
                            <div class="w-full h-40 rounded-[24px] bg-slate-50 dark:bg-dark-main flex items-center justify-center text-slate-300 italic text-xs">Kosong</div>
                        @endif
                    </div>
                    <!-- Ijazah -->
                    <div class="space-y-3 text-center">
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Ijazah</p>
                        @if($registration->ijazah_url)
                            <a href="{{ $registration->ijazah_url }}" target="_blank" class="flex flex-col items-center justify-center w-full h-40 rounded-[24px] bg-emerald-50/50 dark:bg-emerald-900/10 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-500 hover:text-white transition-all shadow-sm border border-emerald-100 dark:border-emerald-800 group">
                                <span class="text-3xl mb-2 group-hover:scale-125 transition-transform duration-500">🎓</span>
                                <strong class="text-[10px] uppercase tracking-widest">Lihat File</strong>
                            </a>
                        @else
                            <div class="w-full h-40 rounded-[24px] bg-slate-50 dark:bg-dark-main flex items-center justify-center text-slate-300 italic text-xs">Kosong</div>
                        @endif
                    </div>
                    <!-- SKHU -->
                    <div class="space-y-3 text-center">
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">SKHU</p>
                        @if($registration->skhu_url)
                            <a href="{{ $registration->skhu_url }}" target="_blank" class="flex flex-col items-center justify-center w-full h-40 rounded-[24px] bg-amber-50/50 dark:bg-amber-900/10 text-amber-600 dark:text-amber-400 hover:bg-amber-500 hover:text-white transition-all shadow-sm border border-amber-100 dark:border-amber-800 group">
                                <span class="text-3xl mb-2 group-hover:scale-125 transition-transform duration-500">📝</span>
                                <strong class="text-[10px] uppercase tracking-widest">Lihat File</strong>
                            </a>
                        @else
                            <div class="w-full h-40 rounded-[24px] bg-slate-50 dark:bg-dark-main flex items-center justify-center text-slate-300 italic text-xs">Kosong</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Verification Action -->
        <div class="space-y-8">
            <div class="bg-white dark:bg-dark-card rounded-[40px] p-8 md:p-10 shadow-2xl shadow-slate-900/5 border border-slate-100 dark:border-slate-800 sticky top-10">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    </div>
                    <h3 class="text-xl font-extrabold text-[#111c3a] dark:text-white uppercase tracking-tight">Verifikasi Data</h3>
                </div>
                
                <form action="{{ route('admin.registrations.update', $registration) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PATCH')
                    
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-4">Ubah Status</label>
                        <div class="relative">
                            <select name="status" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-bold appearance-none cursor-pointer">
                                <option value="pending" {{ $registration->status == 'pending' ? 'selected' : '' }}>⌛ Pending</option>
                                <option value="verified" {{ $registration->status == 'verified' ? 'selected' : '' }}>🛡️ Verified (Data Benar)</option>
                                <option value="accepted" {{ $registration->status == 'accepted' ? 'selected' : '' }}>✅ Accepted (Diterima)</option>
                                <option value="rejected" {{ $registration->status == 'rejected' ? 'selected' : '' }}>❌ Rejected (Ditolak)</option>
                            </select>
                            <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-4">Catatan Admin</label>
                        <textarea name="notes" rows="6" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-bold placeholder-slate-300 text-sm leading-relaxed" placeholder="Contoh: Berkas tidak lengkap atau jadwal tes wawancara...">{{ old('notes', $registration->notes) }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-5 rounded-[20px] bg-emerald-500 text-white font-black uppercase tracking-widest text-sm shadow-2xl shadow-emerald-500/30 hover:bg-emerald-600 hover:-translate-y-1 active:translate-y-0 transition-all duration-300">
                        Simpan Verifikasi &rarr;
                    </button>
                    
                    <p class="text-[9px] text-center text-slate-400 dark:text-slate-500 font-bold uppercase tracking-[0.1em] px-4">Santri akan menerima notifikasi status terbaru di dashboard mereka.</p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
