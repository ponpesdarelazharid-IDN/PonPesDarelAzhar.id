@extends('layouts.admin')

@section('header')
<div>
    <h2 class="text-3xl font-black text-slate-800 dark:text-white uppercase tracking-tight">
        {{ __('Pengaturan PPDB') }}
    </h2>
    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">
        Aktifkan gelombang pendaftaran dan atur kuota penerimaan santri baru.
    </p>
</div>
@endsection

@section('content')
<div class="space-y-10">
    <!-- Feedback -->
    @if(session('success'))
        <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl text-emerald-600 dark:text-emerald-400 font-bold text-sm flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Form: Buka Gelombang -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-slate-800 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-700/50 overflow-hidden sticky top-8">
                <div class="px-8 py-6 border-b border-slate-50 dark:border-slate-700/50 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-black text-sm shadow-lg shadow-emerald-500/20">🆕</div>
                    <h3 class="text-lg font-black text-slate-800 dark:text-white uppercase tracking-tight">Gelombang Baru</h3>
                </div>
                <form action="{{ route('admin.ppdb-settings.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Tahun Ajaran</label>
                        <input type="text" name="academic_year" required placeholder="Contoh: 2026/2027"
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Tgl Buka</label>
                            <input type="date" name="open_date" required
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Tgl Tutup</label>
                            <input type="date" name="close_date" required
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Kuota (Siswa)</label>
                        <input type="number" name="quota" placeholder="Opsional"
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Link Ujian Online</label>
                        <input type="url" name="online_test_link" placeholder="https://forms.gle/..."
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Instruksi / Catatan Ujian</label>
                        <textarea name="online_test_note" rows="3" placeholder="Contoh: Kerjakan dengan jujur, waktu 60 menit..."
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-medium focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all leading-relaxed"></textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Syarat & Ketentuan Umum</label>
                        <textarea name="requirements" rows="4" placeholder="Tuliskan persyaratan pendaftaran..."
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl px-5 py-4 text-sm font-medium focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all leading-relaxed"></textarea>
                    </div>

                    <div class="flex items-center gap-4 p-4 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_open" value="1" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-200 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                            <span class="ms-3 text-xs font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">Aktifkan Langsung</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full py-5 bg-emerald-500 hover:bg-emerald-600 text-white font-black uppercase tracking-widest rounded-2xl shadow-lg shadow-emerald-500/20 transition-all transform hover:scale-[1.02] active:scale-95 text-[10px]">
                        Buka Gelombang Baru
                    </button>
                </form>
            </div>
        </div>

        <!-- Riwayat Gelombang -->
        <div class="lg:col-span-2 space-y-6">
            <h3 class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tight mb-6">Riwayat & Status Gelombang</h3>
            
            <div class="space-y-4">
                @forelse($ppdbSettings as $setting)
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-100 dark:border-slate-700/50 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6 group hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center gap-6">
                        <div @class([
                            'w-14 h-14 rounded-2xl flex items-center justify-center text-xl transition-all',
                            'bg-emerald-500 text-white shadow-lg shadow-emerald-500/20' => $setting->is_open,
                            'bg-slate-100 dark:bg-slate-700 text-slate-400 dark:text-slate-500' => !$setting->is_open
                        ])>
                            @if($setting->is_open)
                                <svg class="w-6 h-6 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            @else
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            @endif
                        </div>
                        <div>
                            <div class="flex items-center gap-3">
                                <span class="text-2xl font-black text-slate-800 dark:text-white tracking-tight uppercase">{{ $setting->academic_year }}</span>
                                @if($setting->is_open)
                                    <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 text-[9px] font-black uppercase tracking-widest rounded-full border border-emerald-500/20">LIVE NOW</span>
                                @endif
                            </div>
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-slate-500 dark:text-slate-400 font-medium text-xs mt-1 lowercase">
                                <span class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z" /></svg> {{ optional($setting->open_date)->format('d M Y') ?? '-' }} - {{ optional($setting->close_date)->format('d M Y') ?? '-' }}</span>
                                <span class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg> Kuota: {{ $setting->quota ?? 'Tanpa Batas' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <form action="{{ route('admin.ppdb-settings.update', $setting) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="toggle_status" value="1">
                        <button type="submit" @class([
                            'px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm',
                            'bg-red-50 dark:bg-red-900/10 text-red-500 hover:bg-red-500 hover:text-white' => $setting->is_open,
                            'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 hover:bg-emerald-500 hover:text-white' => !$setting->is_open
                        ])>
                            {{ $setting->is_open ? 'Hentikan Pendaftaran' : 'Aktifkan Kembali' }}
                        </button>
                    </form>
                </div>
                @empty
                <div class="py-20 bg-slate-50 dark:bg-slate-900/50 rounded-3xl border-2 border-dashed border-slate-200 dark:border-slate-800 flex flex-col items-center justify-center">
                    <svg class="w-12 h-12 text-slate-300 dark:text-slate-700 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <p class="text-slate-400 dark:text-slate-600 font-black uppercase tracking-widest text-xs">Belum ada riwayat pendaftaran.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
