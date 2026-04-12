@extends('layouts.admin')

@section('title', 'Program Unggulan')

@section('breadcrumb')
<span class="text-slate-400">Program Unggulan</span>
@endsection

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h2 class="text-3xl font-black text-slate-800 dark:text-white uppercase tracking-tight">
            {{ __('Program Unggulan') }}
        </h2>
        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">
            Kelola program unggulan yang ditampilkan di halaman depan.
        </p>
    </div>
    <a href="{{ route('admin.programs.create') }}" 
       class="inline-flex items-center px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-black uppercase tracking-widest text-[10px] rounded-2xl shadow-lg shadow-emerald-500/20 transition-all transform hover:scale-[1.02] active:scale-95">
        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
        Tambah Program
    </a>
</div>
@endsection

@section('content')
<div class="space-y-8">
    <!-- Success Feedback -->
    @if(session('success'))
        <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl text-emerald-600 dark:text-emerald-400 font-bold text-sm flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Programs Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($programs as $program)
            <div class="group bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700/50 overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500">
                <div class="aspect-video w-full bg-slate-100 dark:bg-slate-900 relative overflow-hidden">
                    @if($program->icon_path)
                        <img src="{{ $program->icon_path }}" class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110" alt="{{ $program->title }}">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300 dark:text-gray-700">
                            <svg class="w-12 h-12 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                    @endif
                </div>
                
                <div class="p-6">
                    <h3 class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tight mb-2">{{ $program->title }}</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-2 mb-6 font-medium leading-relaxed">{{ $program->description }}</p>
                    
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.programs.edit', $program) }}" 
                           class="flex-1 py-3 bg-slate-50 dark:bg-slate-700 text-center text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-300 rounded-xl hover:bg-emerald-500 hover:text-white dark:hover:bg-emerald-500 transition-all">
                            Edit
                        </a>
                        
                        <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus program unggulan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full py-3 bg-red-50 dark:bg-red-400/10 text-red-500 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-red-500 hover:text-white transition-all">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 bg-slate-50 dark:bg-slate-900/50 rounded-3xl border-2 border-dashed border-slate-200 dark:border-slate-800 flex flex-col items-center justify-center">
                <svg class="w-12 h-12 text-slate-300 dark:text-slate-700 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                <p class="text-slate-400 dark:text-slate-600 font-black uppercase tracking-widest text-xs">Belum ada program unggulan.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
