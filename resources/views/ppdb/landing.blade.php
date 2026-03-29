@extends('layouts.public')

@section('title', 'Pendaftaran Peserta Didik Baru')

@section('content')
<div class="hero" style="min-height: 50vh;">
    <div class="container" style="text-align: center; max-width: 800px; margin: 0 auto;">
        <h1 class="text-gradient" style="font-size: 3.5rem; margin-bottom: 1.5rem;">Informasi PPDB</h1>
        <p style="color: var(--gray); font-size: 1.25rem; margin-bottom: 2.5rem;">Penerimaan Peserta Didik Baru (PPDB) Tahun Ajaran {{ $ppdb->academic_year ?? 'Sekarang' }}</p>
        
        @if($ppdb)
            <div class="glass-card" style="display: inline-block; text-align: left; background: rgba(16, 185, 129, 0.1); border-color: rgba(16, 185, 129, 0.3);">
                <h3 style="color: var(--secondary); margin-bottom: 1rem;">&#10004; Pendaftaran Terbuka</h3>
                <p><strong>Periode:</strong> {{ $ppdb->open_date ? $ppdb->open_date->format('d M Y') : 'Sekarang' }} - {{ $ppdb->close_date ? $ppdb->close_date->format('d M Y') : 'Selesai' }}</p>
                <p><strong>Kuota:</strong> {{ $ppdb->quota ?? 'Tidak terbatas' }} Siswa</p>
                
                <div style="margin-top: 2rem;">
                    <a href="{{ route('ppdb.register') }}" class="btn btn-primary" style="width: 100%;">Daftar Sekarang</a>
                </div>
            </div>
        @else
            <div class="glass-card" style="display: inline-block; text-align: center; border-color: rgba(239, 68, 68, 0.3); background: rgba(239, 68, 68, 0.1);">
                <h3 style="color: #ef4444; margin-bottom: 1rem;">&#10006; Pendaftaran Ditutup</h3>
                <p style="color: var(--gray);">Saat ini belum ada gelombang pendaftaran yang dibuka.</p>
            </div>
        @endif
    </div>
</div>

@if($ppdb && $ppdb->requirements)
<section class="section section-alt">
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        <div class="section-header">
            <h2>Syarat & <span class="text-gradient">Ketentuan</span></h2>
        </div>
        <div class="glass-card">
            <div style="line-height: 1.8; color: var(--gray-light);">
                {!! nl2br(e($ppdb->requirements)) !!}
            </div>
        </div>
    </div>
</section>
@endif
@endsection
