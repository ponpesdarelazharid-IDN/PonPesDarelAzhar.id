@extends('layouts.app')

@section('title', 'Kelola Ekskul - Admin')

@section('content')
<div class="py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <h1 class="text-4xl font-black text-[#1e293b] dark:text-white uppercase tracking-tight">Kelola Ekskul</h1>
                <p class="mt-2 text-slate-500 dark:text-gray-400 font-medium">Daftar kegiatan ekstrakurikuler sekolah Anda.</p>
            </div>
            <a href="{{ route('admin.ekstrakurikuler.create') }}" class="inline-flex items-center px-8 py-4 rounded-2xl bg-[#1e293b] dark:bg-white text-white dark:text-black font-black uppercase tracking-widest text-xs hover:scale-105 transition-all shadow-2xl">
                Tambah Ekskul Baru
            </a>
        </div>

        @if(session('success'))
            <div class="mb-8 p-4 bg-green-500/10 border border-green-500/20 rounded-2xl text-green-500 font-bold text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($ekskuls as $ekskul)
                <div class="group bg-white dark:bg-[#0a0a0a] rounded-3xl border border-slate-100 dark:border-gray-800 overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500">
                    <div class="aspect-video w-full bg-slate-100 dark:bg-gray-900 relative">
                        @if($ekskul->image)
                            <img src="{{ $ekskul->image }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700" alt="{{ $ekskul->name }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300 dark:text-gray-700">
                                <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 bg-white/90 dark:bg-black/90 backdrop-blur rounded-full text-[10px] font-black uppercase tracking-widest {{ $ekskul->is_active ? 'text-green-500' : 'text-red-500' }}">
                                {{ $ekskul->is_active ? 'Aktif' : 'Non-Aktif' }}
                            </span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-black text-[#1e293b] dark:text-white uppercase tracking-tight mb-2">{{ $ekskul->name }}</h3>
                        <p class="text-slate-500 dark:text-gray-400 text-sm line-clamp-2 mb-6 font-medium">{{ $ekskul->description }}</p>
                        
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.ekstrakurikuler.edit', $ekskul) }}" class="flex-1 py-3 bg-slate-100 dark:bg-white/5 rounded-xl text-center text-[10px] font-black uppercase tracking-widest text-slate-600 dark:text-white hover:bg-[#1e293b] hover:text-white dark:hover:bg-white dark:hover:text-black transition-all">Edit</a>
                            
                            <form action="{{ route('admin.ekstrakurikuler.destroy', $ekskul) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus ekskul ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full py-3 bg-red-50 dark:bg-red-900/10 rounded-xl text-[10px] font-black uppercase tracking-widest text-red-500 hover:bg-red-500 hover:text-white transition-all">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 bg-slate-50 dark:bg-gray-900 rounded-3xl border-2 border-dashed border-slate-200 dark:border-gray-800 flex flex-col items-center justify-center">
                    <p class="text-slate-400 dark:text-gray-600 font-bold uppercase tracking-widest text-xs">Belum ada data ekskul.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
