@extends('layouts.app')

@section('title', 'Verifikasi Pendaftar - ' . $registration->full_name)

@section('content')
<div class="px-4 py-8 max-w-5xl mx-auto">
    <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <a href="{{ route('admin.registrations.index') }}" class="text-sm font-bold uppercase tracking-widest text-slate-400 hover:text-[#1e293b] dark:hover:text-white transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Daftar
            </a>
            <h1 class="text-4xl font-black text-[#1e293b] dark:text-white tracking-tighter mt-4">{{ $registration->full_name }}</h1>
            <p class="text-slate-500 dark:text-gray-400 mt-1">No. Registrasi: <span class="font-black text-[#1e293b] dark:text-white">{{ $registration->registration_number }}</span></p>
        </div>
        
        <div @class([
            'px-6 py-3 rounded-2xl text-sm font-black uppercase tracking-widest shadow-lg',
            'bg-amber-100 text-amber-600' => $registration->status == 'pending',
            'bg-blue-100 text-blue-600' => $registration->status == 'verified',
            'bg-emerald-100 text-emerald-600' => $registration->status == 'accepted',
            'bg-red-100 text-red-600' => $registration->status == 'rejected',
        ])>
            Status: {{ $registration->status }}
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Details -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Section: Biodata -->
            <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl p-8 shadow-xl border border-slate-100 dark:border-gray-900">
                <h3 class="text-xl font-black text-[#1e293b] dark:text-white mb-6 border-b border-slate-50 dark:border-gray-900 pb-4 flex items-center gap-2">
                    <span>👤</span> Biodata Calon Santri
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Tempat, Tanggal Lahir</p>
                        <p class="font-bold text-slate-900 dark:text-white">{{ $registration->birth_place }}, {{ $registration->birth_date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Jenis Kelamin</p>
                        <p class="font-bold text-slate-900 dark:text-white">{{ $registration->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Agama</p>
                        <p class="font-bold text-slate-900 dark:text-white">{{ $registration->religion }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Alamat</p>
                        <p class="font-bold text-slate-900 dark:text-white leading-relaxed">{{ $registration->address }}</p>
                    </div>
                </div>
            </div>

            <!-- Section: Orang Tua & Sekolah -->
            <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl p-8 shadow-xl border border-slate-100 dark:border-gray-900">
                <h3 class="text-xl font-black text-[#1e293b] dark:text-white mb-6 border-b border-slate-50 dark:border-gray-900 pb-4 flex items-center gap-2">
                    <span>👨‍👩‍👧</span> Orang Tua & Asal Sekolah
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Nama Ayah / Ibu</p>
                        <p class="font-bold text-slate-900 dark:text-white">{{ $registration->father_name }} / {{ $registration->mother_name }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">No. WhatsApp Wali</p>
                        <p class="font-bold text-slate-900 dark:text-white">{{ $registration->parent_phone }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Pekerjaan</p>
                        <p class="font-bold text-slate-900 dark:text-white">{{ $registration->parent_job }}</p>
                    </div>
                    <div class="md:col-span-2 border-t border-slate-50 dark:border-gray-900 pt-6"></div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Asal Sekolah</p>
                        <p class="font-bold text-slate-900 dark:text-white">{{ $registration->origin_school }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Tahun Lulus</p>
                        <p class="font-bold text-slate-900 dark:text-white">{{ $registration->graduation_year }}</p>
                    </div>
                </div>
            </div>

            <!-- Section: Berkas Upload -->
            <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl p-8 shadow-xl border border-slate-100 dark:border-gray-900">
                <h3 class="text-xl font-black text-[#1e293b] dark:text-white mb-6 border-b border-slate-50 dark:border-gray-900 pb-4 flex items-center gap-2">
                    <span>📄</span> Berkas Pendaftaran
                </h3>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center text-xs">
                    <div>
                        <p class="font-black uppercase tracking-widest text-[#1e293b] dark:text-white mb-2">Foto 3x4</p>
                        @if($registration->photo_url)
                            <a href="{{ $registration->photo_url }}" target="_blank" class="block w-full h-32 rounded-2xl overflow-hidden shadow-md group border-2 border-slate-100 dark:border-gray-800">
                                <img src="{{ $registration->photo_url }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            </a>
                        @else
                            <div class="w-full h-32 rounded-2xl bg-slate-50 dark:bg-gray-900 flex items-center justify-center text-slate-300">Kosong</div>
                        @endif
                    </div>
                    <div>
                        <p class="font-black uppercase tracking-widest text-[#1e293b] dark:text-white mb-2">Akta Lahir</p>
                        @if($registration->birth_cert_url)
                            <a href="{{ $registration->birth_cert_url }}" target="_blank" class="flex flex-col items-center justify-center w-full h-32 rounded-2xl bg-blue-50 dark:bg-blue-900/10 text-blue-600 hover:bg-blue-100 transition shadow-sm border-2 border-blue-100 dark:border-blue-900/20">
                                <span class="text-3xl mb-1">📜</span>
                                <strong>Lihat Akta</strong>
                            </a>
                        @else
                            <div class="w-full h-32 rounded-2xl bg-slate-50 dark:bg-gray-900 flex items-center justify-center text-slate-300">Kosong</div>
                        @endif
                    </div>
                    <div>
                        <p class="font-black uppercase tracking-widest text-[#1e293b] dark:text-white mb-2">Ijazah</p>
                        @if($registration->ijazah_url)
                            <a href="{{ $registration->ijazah_url }}" target="_blank" class="flex flex-col items-center justify-center w-full h-32 rounded-2xl bg-emerald-50 dark:bg-emerald-900/10 text-emerald-600 hover:bg-emerald-100 transition shadow-sm border-2 border-emerald-100 dark:border-emerald-900/20">
                                <span class="text-3xl mb-1">🎓</span>
                                <strong>Lihat Ijazah</strong>
                            </a>
                        @else
                            <div class="w-full h-32 rounded-2xl bg-slate-50 dark:bg-gray-900 flex items-center justify-center text-slate-300">Kosong</div>
                        @endif
                    </div>
                    <div>
                        <p class="font-black uppercase tracking-widest text-[#1e293b] dark:text-white mb-2">SKHU</p>
                        @if($registration->skhu_url)
                            <a href="{{ $registration->skhu_url }}" target="_blank" class="flex flex-col items-center justify-center w-full h-32 rounded-2xl bg-amber-50 dark:bg-amber-900/10 text-amber-600 hover:bg-amber-100 transition shadow-sm border-2 border-amber-100 dark:border-amber-900/20">
                                <span class="text-3xl mb-1">📝</span>
                                <strong>Lihat SKHU</strong>
                            </a>
                        @else
                            <div class="w-full h-32 rounded-2xl bg-slate-50 dark:bg-gray-900 flex items-center justify-center text-slate-300">Kosong</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Verification Action -->
        <div class="space-y-8">
            <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl p-8 shadow-2xl border-4 border-[#1e293b]/5 dark:border-white/5 sticky top-8">
                <h3 class="text-xl font-black text-[#1e293b] dark:text-white mb-6 flex items-center gap-2">
                    <span>🛡️</span> Verifikasi Admin
                </h3>
                
                <form action="{{ route('admin.registrations.update', $registration) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')
                    
                    <div>
                        <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-3">Ubah Status</label>
                        <select name="status" class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">
                            <option value="pending" {{ $registration->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="verified" {{ $registration->status == 'verified' ? 'selected' : '' }}>Verified (Data Benar)</option>
                            <option value="accepted" {{ $registration->status == 'accepted' ? 'selected' : '' }}>Accepted (Diterima)</option>
                            <option value="rejected" {{ $registration->status == 'rejected' ? 'selected' : '' }}>Rejected (Ditolak)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-widest mb-3">Catatan Admin</label>
                        <textarea name="notes" rows="6" class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm text-sm" placeholder="Berikan alasan penolakan atau instruksi selanjutnya untuk santri...">{{ old('notes', $registration->notes) }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-5 rounded-2xl bg-[#1e293b] dark:bg-white text-white dark:text-black font-extrabold text-lg shadow-xl hover:scale-[1.02] active:scale-95 transition-all duration-300">
                        Simpan Verifikasi ✅
                    </button>
                </form>
                
                <p class="text-[10px] text-center text-slate-400 dark:text-gray-500 mt-6 font-bold uppercase tracking-widest">Aksi ini akan mengubah status pendaftaran di akun santri.</p>
            </div>
        </div>
    </div>
</div>
@endsection
