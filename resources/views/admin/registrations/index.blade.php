@extends('layouts.admin')

@section('title', 'Data Pendaftar PPDB')

@section('content')
<div class="relative">
    <div class="mb-12">
        <h1 class="text-4xl font-extrabold text-[#111c3a] dark:text-white tracking-tight">Manajemen Pendaftaran</h1>
        <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Verifikasi berkas dan pantau status pendaftaran calon santri baru.</p>
    </div>

    <!-- Stats Summary for Registrations (Modernized) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-white dark:bg-dark-card p-6 rounded-[32px] border border-slate-100 dark:border-slate-800 shadow-xl shadow-slate-900/5 group hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-amber-50 dark:bg-amber-900/20 text-amber-500 rounded-2xl flex items-center justify-center text-xl">⏳</div>
                <span class="text-[10px] font-black text-amber-500 bg-amber-50 dark:bg-amber-900/30 px-3 py-1 rounded-full uppercase tracking-widest">Baru</span>
            </div>
            <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">Pending</p>
            <h4 class="text-3xl font-black text-[#111c3a] dark:text-white mt-1">
                {{ \App\Models\Registration::where('status', 'pending')->count() }}
            </h4>
        </div>
        <div class="bg-white dark:bg-dark-card p-6 rounded-[32px] border border-slate-100 dark:border-slate-800 shadow-xl shadow-slate-900/5 group hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-blue-50 dark:bg-blue-900/20 text-blue-500 rounded-2xl flex items-center justify-center text-xl">🛡️</div>
                <span class="text-[10px] font-black text-blue-500 bg-blue-50 dark:bg-blue-900/30 px-3 py-1 rounded-full uppercase tracking-widest">Check</span>
            </div>
            <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">Terverifikasi</p>
            <h4 class="text-3xl font-black text-[#111c3a] dark:text-white mt-1">
                {{ \App\Models\Registration::where('status', 'verified')->count() }}
            </h4>
        </div>
        <div class="bg-white dark:bg-dark-card p-6 rounded-[32px] border border-slate-100 dark:border-slate-800 shadow-xl shadow-emerald-900/5 group hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-500 rounded-2xl flex items-center justify-center text-xl">🏆</div>
                <span class="text-[10px] font-black text-emerald-500 bg-emerald-50 dark:bg-emerald-900/30 px-3 py-1 rounded-full uppercase tracking-widest">Lolos</span>
            </div>
            <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">Diterima</p>
            <h4 class="text-3xl font-black text-[#111c3a] dark:text-white mt-1">
                {{ \App\Models\Registration::where('status', 'accepted')->count() }}
            </h4>
        </div>
        <div class="bg-white dark:bg-dark-card p-6 rounded-[32px] border border-slate-100 dark:border-slate-800 shadow-xl shadow-red-900/5 group hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-red-50 dark:bg-red-900/20 text-red-500 rounded-2xl flex items-center justify-center text-xl">🚫</div>
                <span class="text-[10px] font-black text-red-500 bg-red-50 dark:bg-red-900/30 px-3 py-1 rounded-full uppercase tracking-widest">Gagal</span>
            </div>
            <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">Ditolak</p>
            <h4 class="text-3xl font-black text-[#111c3a] dark:text-white mt-1">
                {{ \App\Models\Registration::where('status', 'rejected')->count() }}
            </h4>
        </div>
    </div>

    <!-- Registration Filters -->
    <div class="bg-white dark:bg-dark-card p-6 rounded-[32px] border border-slate-100 dark:border-slate-800 shadow-xl shadow-slate-900/5 mb-8">
        <form action="{{ route('admin.registrations.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1 w-full">
                <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2 ml-1">Cari Pendaftar</label>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama, No. Registrasi, atau Sekolah..." 
                        class="w-full pl-12 pr-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border-none focus:ring-2 focus:ring-emerald-500 text-sm font-bold text-slate-600 dark:text-white transition-all">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">🔍</div>
                </div>
            </div>
            <div class="w-full md:w-64">
                <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2 ml-1">Filter Status</label>
                <select name="status" onchange="this.form.submit()" 
                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border-none focus:ring-2 focus:ring-emerald-500 text-sm font-bold text-slate-600 dark:text-white appearance-none transition-all cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                    <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>🛡️ Verified</option>
                    <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>🏆 Accepted</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>🚫 Rejected</option>
                </select>
            </div>
            <div class="flex gap-2 w-full md:w-auto">
                <button type="submit" class="flex-1 md:flex-none px-8 py-4 bg-emerald-500 text-white text-xs font-black uppercase tracking-widest rounded-2xl hover:bg-emerald-600 transition shadow-lg shadow-emerald-500/20">Filter</button>
                @if(request()->anyFilled(['search', 'status']))
                    <a href="{{ route('admin.registrations.index') }}" class="px-6 py-4 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-xs font-black uppercase tracking-widest rounded-2xl hover:bg-slate-200 transition">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Registration Table Card -->
    <div class="bg-white dark:bg-dark-card rounded-[40px] shadow-2xl shadow-slate-900/5 border border-slate-100 dark:border-slate-800 overflow-hidden">
        <div class="overflow-x-auto text-nowrap">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-dark-main/50">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">No. Registrasi</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">Nama Calon Santri</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">Keterangan</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">Status</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                    @forelse($registrations as $reg)
                    <tr class="group hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition duration-300">
                        <td class="px-8 py-6">
                            <span class="text-xs font-black text-slate-400 dark:text-slate-500 bg-slate-100 dark:bg-slate-800 px-3 py-1 rounded-lg">{{ $reg->registration_number }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-[18px] bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-black text-lg group-hover:scale-110 transition-transform duration-500">
                                    {{ substr($reg->full_name, 0, 1) }}
                                </div>
                                <div class="max-w-[200px]">
                                    <p class="font-extrabold text-[#111c3a] dark:text-white uppercase tracking-tight group-hover:text-emerald-500 transition-colors duration-300 truncate">{{ $reg->full_name }}</p>
                                    <p class="text-[9px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-widest mt-1">{{ $reg->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-xs font-bold text-slate-500 dark:text-slate-400">{{ $reg->origin_school }}</p>
                            <p @class([
                                'text-[9px] font-bold uppercase tracking-widest mt-0.5',
                                'text-blue-500' => $reg->gender == 'L',
                                'text-pink-500' => $reg->gender == 'P'
                            ])>{{ $reg->gender == 'L' ? 'Laki-laki' : 'Perempuan' }} • Lulus {{ $reg->graduation_year }}</p>
                        </td>
                        <td class="px-8 py-6">
                            @if($reg->status == 'pending')
                                <span class="px-4 py-1.5 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-500 text-[9px] font-black uppercase tracking-widest rounded-xl border border-amber-100 dark:border-amber-800/50 shadow-sm">Pending</span>
                            @elseif($reg->status == 'verified')
                                <span class="px-4 py-1.5 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-500 text-[9px] font-black uppercase tracking-widest rounded-xl border border-blue-100 dark:border-blue-800/50 shadow-sm">Verified</span>
                            @elseif($reg->status == 'accepted')
                                <span class="px-4 py-1.5 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 text-[9px] font-black uppercase tracking-widest rounded-xl border border-emerald-100 dark:border-emerald-800 shadow-sm">Accepted</span>
                            @elseif($reg->status == 'rejected')
                                <span class="px-4 py-1.5 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-500 text-[9px] font-black uppercase tracking-widest rounded-xl border border-red-100 dark:border-red-900/50 shadow-sm">Rejected</span>
                            @else
                                <span class="px-4 py-1.5 bg-slate-50 dark:bg-dark-main text-slate-400 text-[9px] font-black uppercase tracking-widest rounded-xl border border-slate-100 dark:border-slate-800">{{ $reg->status }}</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-right">
                            <a href="{{ route('admin.registrations.show', $reg) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-500 text-white text-[10px] font-black uppercase tracking-[0.1em] rounded-2xl hover:bg-emerald-600 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 shadow-lg shadow-emerald-500/20">
                                Verify Data &rarr;
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-24 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-24 h-24 rounded-[32px] bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-5xl mb-6 shadow-inner">📭</div>
                                <h4 class="text-lg font-extrabold text-[#111c3a] dark:text-white uppercase tracking-widest">Data Tidak Ditemukan</h4>
                                <p class="text-slate-400 dark:text-slate-500 text-sm mt-2">Gunakan kata kunci atau filter lain untuk menemukan data yang Anda cari.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($registrations->hasPages())
        <div class="px-8 py-8 bg-slate-50 dark:bg-dark-main/50 border-t border-slate-100 dark:border-slate-800">
            <div class="flex justify-center">
                {{ $registrations->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
