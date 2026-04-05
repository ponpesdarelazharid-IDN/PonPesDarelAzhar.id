@extends('layouts.admin')

@section('title', 'Kelola Konten Sekolah')

@section('content')
<div class="relative">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-4xl font-extrabold text-[#111c3a] dark:text-white tracking-tight">Manajemen Konten</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Kelola berita, acara, dan prestasi sekolah dalam satu halaman.</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="px-8 py-4 bg-emerald-500 text-white font-black rounded-2xl shadow-xl shadow-emerald-500/20 hover:bg-emerald-600 hover:-translate-y-1 active:translate-y-0 transition-all flex items-center gap-3 uppercase tracking-widest text-xs">
            <svg class="w-5 h-5 font-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
            Buat Postingan Baru
        </a>
    </div>

    <!-- Posts Table Card -->
    <div class="bg-white dark:bg-dark-card rounded-[40px] shadow-2xl shadow-slate-900/5 border border-slate-100 dark:border-slate-800 overflow-hidden">
        <div class="overflow-x-auto text-nowrap">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-dark-main/50">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">Informasi Post</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">Kategori</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">Status</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                    @forelse($posts as $post)
                    <tr class="group hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition duration-300">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-5">
                                <div class="relative">
                                    @if($post->image_url)
                                        <img src="{{ $post->image_url }}" class="w-16 h-16 rounded-[20px] object-cover shadow-lg group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-16 h-16 rounded-[20px] bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-2xl group-hover:scale-105 transition-transform duration-500">📄</div>
                                    @endif
                                </div>
                                <div class="max-w-xs md:max-w-md">
                                    <p class="font-extrabold text-[#111c3a] dark:text-white line-clamp-1 group-hover:text-emerald-500 transition-colors duration-300">{{ $post->title }}</p>
                                    <p class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-widest mt-1.5 flex items-center gap-2">
                                        <span class="w-1 h-1 rounded-full bg-slate-300"></span> 
                                        Dibuat oleh Admin 
                                        <span class="w-1 h-1 rounded-full bg-slate-300"></span> 
                                        {{ $post->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-[10px] font-black text-slate-600 dark:text-slate-400 uppercase tracking-widest rounded-xl">
                                {{ $post->type }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            @if($post->published_at)
                                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-800/50">
                                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                                    <span class="text-[9px] font-black uppercase tracking-widest">Published</span>
                                </div>
                            @else
                                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-50 dark:bg-slate-800 text-slate-400 border border-slate-100 dark:border-slate-700">
                                    <div class="w-1.5 h-1.5 rounded-full bg-slate-400"></div>
                                    <span class="text-[9px] font-black uppercase tracking-widest">Draft</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end items-center gap-4">
                                <a href="{{ route('admin.posts.edit', $post) }}" class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:bg-emerald-500 dark:hover:bg-emerald-500 hover:text-white transition-all duration-300 shadow-sm border border-slate-100 dark:border-slate-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                </a>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Hapus postingan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="p-3 rounded-2xl bg-red-50 dark:bg-red-900/10 text-red-400 hover:bg-red-500 hover:text-white transition-all duration-300 shadow-sm border border-red-100 dark:border-red-900/20">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-24 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-24 h-24 rounded-[32px] bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-5xl mb-6 shadow-inner tracking-widest">📭</div>
                                <h4 class="text-lg font-extrabold text-[#111c3a] dark:text-white uppercase tracking-widest">Belum Ada Postingan</h4>
                                <p class="text-slate-400 dark:text-slate-500 text-sm mt-2 max-w-xs">Mulai isi konten sekolah dengan membuat berita atau pengumuman baru.</p>
                                <a href="{{ route('admin.posts.create') }}" class="mt-8 px-8 py-4 bg-emerald-500 text-white font-black rounded-2xl shadow-xl shadow-emerald-500/20 hover:bg-emerald-600 transition-all uppercase tracking-widest text-[10px]">Mulai Menulis sekarang</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($posts->hasPages())
        <div class="px-8 py-8 bg-slate-50 dark:bg-dark-main/50 border-t border-slate-100 dark:border-slate-800">
            <div class="flex justify-center">
                {{ $posts->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
