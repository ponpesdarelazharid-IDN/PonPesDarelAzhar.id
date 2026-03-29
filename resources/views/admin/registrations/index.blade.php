@extends('layouts.app')

@section('title', 'Data Pendaftar PPDB')

@section('content')
<div class="px-4 py-8 max-w-7xl mx-auto">
    <div class="mb-12">
        <h1 class="text-4xl font-black text-[#1e293b] dark:text-white tracking-tighter">Manajemen Pendaftaran</h1>
        <p class="text-slate-500 dark:text-gray-400 mt-2">Verifikasi berkas dan pantau status pendaftaran calon santri era PPDB 2026.</p>
    </div>

    <!-- Stats Summary for Registrations -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white dark:bg-[#0a0a0a] p-6 rounded-2xl border border-slate-100 dark:border-gray-900 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Baru Masuk</p>
            <h4 class="text-2xl font-extrabold text-[#1e293b] dark:text-white mt-1">
                {{ \App\Models\Registration::where('status', 'pending')->count() }}
            </h4>
        </div>
        <div class="bg-white dark:bg-[#0a0a0a] p-6 rounded-2xl border border-slate-100 dark:border-gray-900 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Terverifikasi</p>
            <h4 class="text-2xl font-extrabold text-blue-600 mt-1">
                {{ \App\Models\Registration::where('status', 'verified')->count() }}
            </h4>
        </div>
        <div class="bg-white dark:bg-[#0a0a0a] p-6 rounded-2xl border border-slate-100 dark:border-gray-900 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Diterima</p>
            <h4 class="text-2xl font-extrabold text-emerald-600 mt-1">
                {{ \App\Models\Registration::where('status', 'accepted')->count() }}
            </h4>
        </div>
        <div class="bg-white dark:bg-[#0a0a0a] p-6 rounded-2xl border border-slate-100 dark:border-gray-900 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Ditolak</p>
            <h4 class="text-2xl font-extrabold text-red-600 mt-1">
                {{ \App\Models\Registration::where('status', 'rejected')->count() }}
            </h4>
        </div>
    </div>

    <!-- Registration Table Card -->
    <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl shadow-2xl overflow-hidden border border-slate-100 dark:border-gray-900">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-gray-900/50">
                        <th class="px-8 py-6 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">No. Registrasi</th>
                        <th class="px-8 py-6 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Nama Calon Santri</th>
                        <th class="px-8 py-6 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Asal Sekolah</th>
                        <th class="px-8 py-6 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Status</th>
                        <th class="px-8 py-6 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-gray-900">
                    @forelse($registrations as $reg)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-gray-900/30 transition">
                        <td class="px-8 py-6 text-sm font-bold text-slate-500 dark:text-gray-400">
                            {{ $reg->registration_number }}
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-[#1e293b] dark:bg-white text-white dark:text-black flex items-center justify-center font-black">
                                    {{ substr($reg->full_name, 0, 1) }}
                                </div>
                                <div class="font-bold text-[#1e293b] dark:text-white uppercase tracking-tight">{{ $reg->full_name }}</div>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-sm text-slate-500 dark:text-gray-500">
                            {{ $reg->origin_school }}
                        </td>
                        <td class="px-8 py-6">
                            @if($reg->status == 'pending')
                                <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-widest rounded-full">Pending</span>
                            @elseif($reg->status == 'verified')
                                <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest rounded-full">Verified</span>
                            @elseif($reg->status == 'accepted')
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-full">Accepted</span>
                            @elseif($reg->status == 'rejected')
                                <span class="px-3 py-1 bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-widest rounded-full">Rejected</span>
                            @else
                                <span class="px-3 py-1 bg-slate-100 dark:bg-gray-800 text-slate-500 text-[10px] font-black uppercase tracking-widest rounded-full">{{ $reg->status }}</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-right">
                            <a href="{{ route('admin.registrations.show', $reg) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-100 dark:bg-gray-900 text-[#1e293b] dark:text-white text-xs font-black uppercase tracking-widest rounded-xl hover:bg-[#1e293b] dark:hover:bg-white hover:text-white dark:hover:text-black transition-all">
                                Detail & Verifikasi
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center text-slate-400 dark:text-gray-600 font-bold uppercase tracking-widest text-xs">
                            Belum ada pendaftaran masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($registrations->hasPages())
        <div class="px-8 py-6 bg-slate-50 dark:bg-gray-900/30 border-t border-slate-100 dark:border-gray-900">
            {{ $registrations->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
