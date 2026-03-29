@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="px-4 py-8 max-w-7xl mx-auto">
    <div class="mb-10">
        <h1 class="text-4xl font-black text-[#1e293b] dark:text-white tracking-tighter">Ringkasan Statistik</h1>
        <p class="text-slate-500 dark:text-gray-400 mt-2">Pantau perkembangan sekolah dan pendaftaran santri baru.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-white dark:bg-[#0a0a0a] p-8 rounded-3xl shadow-xl border border-slate-100 dark:border-gray-900 group hover:scale-[1.02] transition-all">
            <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/10 text-blue-600 dark:text-blue-400 rounded-2xl flex items-center justify-center text-xl mb-4 group-hover:rotate-6 transition-transform">👥</div>
            <p class="text-sm font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Total Pendaftar</p>
            <h3 class="text-4xl font-extrabold text-[#1e293b] dark:text-white mt-1">{{ $stats['total_pendaftar'] }}</h3>
        </div>
        <div class="bg-white dark:bg-[#0a0a0a] p-8 rounded-3xl shadow-xl border border-slate-100 dark:border-gray-900 group hover:scale-[1.02] transition-all">
            <div class="w-12 h-12 bg-amber-50 dark:bg-amber-900/10 text-amber-600 dark:text-amber-400 rounded-2xl flex items-center justify-center text-xl mb-4 group-hover:rotate-6 transition-transform">⏳</div>
            <p class="text-sm font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Pending</p>
            <h3 class="text-4xl font-extrabold text-[#1e293b] dark:text-white mt-1">{{ $stats['pending'] }}</h3>
        </div>
        <div class="bg-white dark:bg-[#0a0a0a] p-8 rounded-3xl shadow-xl border border-slate-100 dark:border-gray-900 group hover:scale-[1.02] transition-all">
            <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/10 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center text-xl mb-4 group-hover:rotate-6 transition-transform">✅</div>
            <p class="text-sm font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Diterima</p>
            <h3 class="text-4xl font-extrabold text-[#1e293b] dark:text-white mt-1">{{ $stats['accepted'] }}</h3>
        </div>
        <div class="bg-white dark:bg-[#0a0a0a] p-8 rounded-3xl shadow-xl border border-slate-100 dark:border-gray-900 group hover:scale-[1.02] transition-all">
            <div class="w-12 h-12 bg-purple-50 dark:bg-purple-900/10 text-purple-600 dark:text-purple-400 rounded-2xl flex items-center justify-center text-xl mb-4 group-hover:rotate-6 transition-transform">📝</div>
            <p class="text-sm font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Total Post</p>
            <h3 class="text-4xl font-extrabold text-[#1e293b] dark:text-white mt-1">{{ $stats['total_berita'] + $stats['total_prestasi'] }}</h3>
        </div>
    </div>

    <!-- Desktop Grid: Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <!-- Recent Registrations -->
        <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl shadow-2xl overflow-hidden border border-slate-100 dark:border-gray-900">
            <div class="p-8 border-b border-slate-50 dark:border-gray-900 flex justify-between items-center">
                <h3 class="text-xl font-black text-[#1e293b] dark:text-white">Pendaftar Terbaru</h3>
                <a href="{{ route('admin.registrations.index') }}" class="text-xs font-bold uppercase tracking-widest text-[#1e293b] dark:text-white hover:opacity-70">Lihat Semua</a>
            </div>
            <div class="divide-y divide-slate-50 dark:divide-gray-900">
                @forelse($recent_registrations as $reg)
                <div class="p-6 flex items-center justify-between hover:bg-slate-50 dark:hover:bg-gray-900/50 transition">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-gray-800 flex items-center justify-center font-bold text-[#1e293b] dark:text-white">
                            {{ substr($reg->full_name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-slate-900 dark:text-white">{{ $reg->full_name }}</p>
                            <p class="text-xs text-slate-500 dark:text-gray-500">{{ $reg->registration_number }} • {{ $reg->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <span @class([
                        'px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-full',
                        'bg-amber-100 text-amber-600' => $reg->status == 'pending',
                        'bg-emerald-100 text-emerald-600' => $reg->status == 'accepted',
                        'bg-slate-100 text-slate-600' => !in_array($reg->status, ['pending', 'accepted'])
                    ])>
                        {{ $reg->status }}
                    </span>
                </div>
                @empty
                <p class="p-8 text-center text-slate-400">Belum ada pendaftaran.</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Posts -->
        <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl shadow-2xl overflow-hidden border border-slate-100 dark:border-gray-900">
            <div class="p-8 border-b border-slate-50 dark:border-gray-900 flex justify-between items-center">
                <h3 class="text-xl font-black text-[#1e293b] dark:text-white">Postingan Terbaru</h3>
                <a href="{{ route('admin.posts.index') }}" class="text-xs font-bold uppercase tracking-widest text-[#1e293b] dark:text-white hover:opacity-70">Kelola Content</a>
            </div>
            <div class="divide-y divide-slate-50 dark:divide-gray-900">
                @forelse($recent_posts as $post)
                <div class="p-6 flex items-center justify-between hover:bg-slate-50 dark:hover:bg-gray-900/50 transition">
                    <div class="flex items-center gap-4">
                        @if($post->image_url)
                            <img src="{{ $post->image_url }}" class="w-12 h-12 rounded-xl object-cover">
                        @else
                            <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-gray-800 flex items-center justify-center text-xl">📄</div>
                        @endif
                        <div>
                            <p class="font-bold text-slate-900 dark:text-white line-clamp-1">{{ $post->title }}</p>
                            <p class="text-xs text-slate-500 dark:text-gray-500 capitalize">{{ $post->type }} • {{ $post->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.posts.edit', $post) }}" class="text-slate-400 hover:text-[#1e293b] dark:hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                    </a>
                </div>
                @empty
                <p class="p-8 text-center text-slate-400">Belum ada konten.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
