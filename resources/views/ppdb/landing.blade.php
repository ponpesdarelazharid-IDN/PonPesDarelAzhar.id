@extends('layouts.app')

@section('title', 'Pendaftaran Peserta Didik Baru')

@section('content')
<!-- Hero -->
<div class="bg-gray-50 dark:bg-[#0a0a0a] py-16 sm:py-24 border-b border-gray-100 dark:border-gray-900 transition-colors duration-300 min-h-[50vh] flex flex-col justify-center">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl lg:text-6xl mb-6 transition-colors duration-300">Informasi PPDB</h1>
        <p class="text-xl text-gray-500 dark:text-gray-400 mb-12 transition-colors duration-300">
            Penerimaan Peserta Didik Baru (PPDB) Tahun Ajaran <span class="font-bold text-gray-900 dark:text-gray-300">{{ $ppdb->academic_year ?? 'Sekarang' }}</span>
        </p>
        
        @if($ppdb && $ppdb->is_open)
            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-2xl p-8 max-w-lg mx-auto shadow-sm transition-colors duration-300">
                <div class="flex items-center justify-center mb-6">
                    <svg class="h-8 w-8 text-green-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-2xl font-bold text-green-800 dark:text-green-400">Pendaftaran Terbuka</h3>
                </div>
                
                <div class="space-y-4 text-left mb-8 text-gray-700 dark:text-gray-300">
                    <div class="flex justify-between border-b border-green-100 dark:border-green-800/50 pb-2">
                        <span class="font-medium">Periode Mendaftar:</span>
                        <span>{{ $ppdb->open_date ? $ppdb->open_date->format('d M Y') : 'Sekarang' }} - {{ $ppdb->close_date ? $ppdb->close_date->format('d M Y') : 'Selesai' }}</span>
                    </div>
                    <div class="flex justify-between border-b border-green-100 dark:border-green-800/50 pb-2">
                        <span class="font-medium">Kuota Penerimaan:</span>
                        <span class="font-bold">{{ $ppdb->quota ?? 'Tidak terbatas' }} Siswa</span>
                    </div>
                </div>
                
                <a href="{{ route('ppdb.register') }}" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-md shadow-sm text-lg font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                    Mulai Pendaftaran Sekarang
                </a>
            </div>
        @else
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-2xl p-8 max-w-lg mx-auto shadow-sm transition-colors duration-300">
                <div class="flex items-center justify-center mb-4">
                    <svg class="h-8 w-8 text-red-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-2xl font-bold text-red-800 dark:text-red-400">Pendaftaran Ditutup</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Saat ini belum ada gelombang pendaftaran yang dibuka untuk umum.</p>
            </div>
        @endif
    </div>
</div>

<!-- Syarat & Ketentuan -->
@if($ppdb && $ppdb->requirements)
<section class="py-16 bg-white dark:bg-black transition-colors duration-300 border-b border-gray-100 dark:border-gray-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white transition-colors duration-300">Syarat & Ketentuan</h2>
        </div>
        
        <div class="bg-gray-50 dark:bg-[#0a0a0a] rounded-2xl p-8 border border-gray-100 dark:border-gray-800 shadow-sm dark:shadow-white/5 transition-colors duration-300">
            <div class="prose prose-lg dark:prose-invert max-w-none text-gray-600 dark:text-gray-300">
                {!! nl2br(e($ppdb->requirements)) !!}
            </div>
        </div>
    </div>
</section>
@endif
@endsection
