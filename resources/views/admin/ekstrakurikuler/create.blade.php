@extends('layouts.app')

@section('title', 'Tambah Ekskul Baru - Admin')

@section('content')
<div class="py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="mb-12">
            <a href="{{ route('admin.ekstrakurikuler.index') }}" class="inline-flex items-center gap-2 group text-slate-500 dark:text-gray-400 hover:text-[#1e293b] dark:hover:text-white transition-all font-bold uppercase tracking-widest text-[10px] mb-6">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Daftar
            </a>
            <h1 class="text-4xl font-black text-[#1e293b] dark:text-white uppercase tracking-tight">Tambah Ekskul</h1>
            <p class="mt-2 text-slate-500 dark:text-gray-400 font-medium">Buat kegiatan ekstrakurikuler baru untuk ditampilkan di website.</p>
        </div>

        <form action="{{ route('admin.ekstrakurikuler.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-[#0a0a0a] rounded-3xl border border-slate-100 dark:border-gray-800 p-8 shadow-2xl">
            @csrf
            
            <div class="space-y-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-3 px-1">Nama Ekskul</label>
                    <input type="text" name="name" required placeholder="Contoh: Pramuka, Futsal, Rohis..."
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-3 px-1">Deskripsi Kegiatan</label>
                    <textarea name="description" rows="6" placeholder="Jelaskan secara singkat tentang kegiatan ini..."
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold"></textarea>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-3 px-1">Foto Kegiatan</label>
                    <div class="relative group cursor-pointer">
                        <input type="file" name="image_file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="w-full py-10 rounded-2xl border-2 border-dashed border-slate-200 dark:border-gray-800 bg-slate-50 dark:bg-gray-900 flex flex-col items-center justify-center group-hover:bg-slate-100 dark:group-hover:bg-white/5 transition-all">
                            <svg class="w-8 h-8 text-slate-400 dark:text-gray-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-gray-600">Klik untuk upload foto</p>
                            <p class="text-[10px] text-slate-300 mt-1 uppercase tracking-tighter">Maksimal 2MB (JPG/PNG)</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 p-4 bg-slate-50 dark:bg-gray-900 rounded-2xl border border-slate-100 dark:border-gray-800">
                    <div class="relative inline-block w-12 h-6 rounded-full bg-slate-200 dark:bg-gray-800 transition-colors">
                        <input type="checkbox" name="is_active" checked class="sr-only peer">
                        <div class="absolute inset-0 rounded-full transition-colors peer-checked:bg-green-500"></div>
                        <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-6"></div>
                    </div>
                    <span class="text-xs font-black uppercase tracking-widest text-[#1e293b] dark:text-white">Aktifkan Langsung</span>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full py-5 bg-[#1e293b] dark:bg-white text-white dark:text-black rounded-2xl font-black uppercase tracking-[0.2em] text-xs hover:scale-[1.02] active:scale-95 transition-all shadow-2xl">
                        Simpan Ekskul
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
