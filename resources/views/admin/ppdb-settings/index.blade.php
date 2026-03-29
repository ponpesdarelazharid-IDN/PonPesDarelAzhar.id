@extends('layouts.app')

@section('title', 'Pengaturan PPDB')

@section('content')
<div class="px-4 py-8 max-w-5xl mx-auto space-y-10">
    <div class="mb-10 flex justify-between items-end">
        <div>
            <h1 class="text-4xl font-black text-[#1e293b] dark:text-white tracking-tighter uppercase">Pengaturan PPDB</h1>
            <p class="text-slate-500 dark:text-gray-400 mt-2 font-medium">Aktifkan gelombang pendaftaran dan atur kuota penerimaan.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="p-5 rounded-2xl bg-emerald-50 dark:bg-emerald-900/10 border border-emerald-100 dark:border-emerald-900/20 flex items-center gap-4 animate-in fade-in slide-in-from-top-4 duration-500">
            <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center shadow-lg">✓</div>
            <p class="text-emerald-800 dark:text-emerald-400 font-bold tracking-tight">{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Form: Buka Gelombang -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl shadow-2xl border border-slate-100 dark:border-gray-900 overflow-hidden sticky top-8">
                <div class="p-8 border-b border-slate-50 dark:border-gray-900 bg-slate-50/50 dark:bg-white/5">
                    <h3 class="text-xl font-black text-[#1e293b] dark:text-white flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-[#1e293b] dark:bg-white text-white dark:text-black flex items-center justify-center text-sm">🆕</span>
                        Gelombang Baru
                    </h3>
                </div>
                <form action="{{ route('admin.ppdb-settings.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-2">Tahun Ajaran</label>
                        <input type="text" name="academic_year" required placeholder="Contoh: 2026/2027"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-2">Tgl Buka</label>
                            <input type="date" name="open_date" required
                                class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-2">Tgl Tutup</label>
                            <input type="date" name="close_date" required
                                class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-2">Kuota (Siswa)</label>
                        <input type="number" name="quota" placeholder="Opsional"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-2">Syarat & Ketentuan</label>
                        <textarea name="requirements" rows="4" placeholder="Tuliskan persyaratan pendaftaran..."
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold"></textarea>
                    </div>

                    <div class="flex items-center gap-3 py-2">
                        <input type="checkbox" name="is_open" value="1" id="is_open" checked class="rounded-lg border-slate-200 dark:border-gray-800 text-[#1e293b] focus:ring-[#1e293b]">
                        <label for="is_open" class="text-xs font-bold text-slate-600 dark:text-gray-400">Aktifkan Sekarang</label>
                    </div>

                    <button type="submit" class="w-full py-5 rounded-2xl bg-[#1e293b] dark:bg-white text-white dark:text-black font-extrabold text-sm uppercase tracking-widest shadow-2xl hover:scale-[1.02] active:scale-95 transition-all duration-300">
                        Buka Gelombang
                    </button>
                </form>
            </div>
        </div>

        <!-- Riwayat Gelombang -->
        <div class="lg:col-span-2 space-y-6">
            <h3 class="text-xl font-black text-[#1e293b] dark:text-white uppercase tracking-tighter">Riwayat Gelombang</h3>
            
            @forelse($ppdbSettings as $setting)
            <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl p-8 border border-slate-100 dark:border-gray-900 shadow-xl flex items-center justify-between group">
                <div class="flex items-center gap-6">
                    <div @class([
                        'w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shadow-inner',
                        'bg-emerald-500/10 text-emerald-600' => $setting->is_open,
                        'bg-slate-100 text-slate-400' => !$setting->is_open
                    ])>
                        {{ $setting->is_open ? '🟢' : '⚪' }}
                    </div>
                    <div>
                        <div class="flex items-center gap-3">
                            <span class="text-2xl font-black text-[#1e293b] dark:text-white tracking-tighter">{{ $setting->academic_year }}</span>
                            @if($setting->is_open)
                                <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-600 text-[10px] font-black uppercase tracking-widest">Aktif</span>
                            @endif
                        </div>
                        <p class="text-sm font-medium text-slate-500 dark:text-gray-500 mt-1">
                            {{ $setting->open_date->format('d M Y') }} - {{ $setting->close_date->format('d M Y') }} &bull; Kuota: {{ $setting->quota ?? '∞' }}
                        </p>
                    </div>
                </div>
                
                <form action="{{ route('admin.ppdb-settings.update', $setting) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="toggle_status" value="1">
                    <button type="submit" @class([
                        'px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all',
                        'bg-red-50 text-red-600 hover:bg-red-100' => $setting->is_open,
                        'bg-[#1e293b] text-white hover:bg-black dark:bg-white dark:text-black dark:hover:bg-gray-200' => !$setting->is_open
                    ])>
                        {{ $setting->is_open ? 'Hentikan' : 'Aktifkan' }}
                    </button>
                </form>
            </div>
            @empty
            <div class="text-center py-20 bg-slate-50 dark:bg-white/5 rounded-3xl border border-dashed border-slate-200 dark:border-gray-800">
                <p class="text-slate-400 font-bold">Belum ada data gelombang.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
