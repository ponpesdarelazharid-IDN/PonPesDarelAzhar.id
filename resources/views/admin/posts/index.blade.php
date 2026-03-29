@extends('layouts.app')

@section('title', 'Kelola Konten Sekolah')

@section('content')
<div class="px-4 py-8 max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-4xl font-black text-[#1e293b] dark:text-white tracking-tighter">Manajemen Konten</h1>
            <p class="text-slate-500 dark:text-gray-400 mt-2">Kelola berita, acara, dan prestasi sekolah dalam satu halaman.</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="px-8 py-4 bg-[#1e293b] dark:bg-white text-white dark:text-black font-extrabold rounded-2xl shadow-xl hover:scale-105 transition-all flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Buat Postingan Baru
        </a>
    </div>

    <!-- Posts Table Card -->
    <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl shadow-2xl overflow-hidden border border-slate-100 dark:border-gray-900">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-gray-900/50">
                        <th class="px-8 py-6 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Informasi Post</th>
                        <th class="px-8 py-6 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Kategori</th>
                        <th class="px-8 py-6 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Status</th>
                        <th class="px-8 py-6 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-gray-900">
                    @forelse($posts as $post)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-gray-900/30 transition">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                @if($post->image_url)
                                    <img src="{{ $post->image_url }}" class="w-14 h-14 rounded-xl object-cover shadow-md">
                                @else
                                    <div class="w-14 h-14 rounded-xl bg-slate-100 dark:bg-gray-800 flex items-center justify-center text-xl">📄</div>
                                @endif
                                <div>
                                    <p class="font-bold text-[#1e293b] dark:text-white line-clamp-1">{{ $post->title }}</p>
                                    <p class="text-xs text-slate-400 dark:text-gray-500 mt-1">Dibuat oleh Admin • {{ $post->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1.5 bg-slate-100 dark:bg-gray-800 text-[10px] font-black text-slate-600 dark:text-gray-400 uppercase tracking-widest rounded-lg">
                                {{ $post->type }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            @if($post->published_at)
                                <div class="flex items-center gap-2 text-emerald-600 dark:text-emerald-400">
                                    <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                                    <span class="text-xs font-black uppercase tracking-widest">Published</span>
                                </div>
                            @else
                                <div class="flex items-center gap-2 text-slate-400">
                                    <div class="w-2 h-2 rounded-full bg-slate-400"></div>
                                    <span class="text-xs font-black uppercase tracking-widest">Draft</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end items-center gap-3">
                                <a href="{{ route('admin.posts.edit', $post) }}" class="p-2.5 rounded-xl bg-slate-100 dark:bg-gray-900 text-slate-600 dark:text-gray-400 hover:bg-[#1e293b] dark:hover:bg-white hover:text-white dark:hover:text-black transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                </a>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Hapus postingan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="p-2.5 rounded-xl bg-red-50 dark:bg-red-900/10 text-red-600 hover:bg-red-600 hover:text-white transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center text-slate-400 dark:text-gray-600">
                            <div class="flex flex-col items-center">
                                <span class="text-5xl mb-4">📭</span>
                                <p class="font-bold">Belum ada postingan yang dibuat.</p>
                                <a href="{{ route('admin.posts.create') }}" class="mt-4 text-[#1e293b] dark:text-white underline">Ayo mulai menulis!</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($posts->hasPages())
        <div class="px-8 py-6 bg-slate-50 dark:bg-gray-900/30 border-t border-slate-100 dark:border-gray-900">
            {{ $posts->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
