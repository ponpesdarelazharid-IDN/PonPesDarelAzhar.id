@extends('layouts.app')

@section('title', 'Konfirmasi Pendaftaran - PPDB')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <!-- Progress Stepper (Updated) -->
    <div class="mb-12 flex justify-between items-center relative gap-4">
        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-slate-200 dark:bg-slate-800 -z-10 rounded-full"></div>
        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-[87.5%] h-1 bg-emerald-500 -z-10 rounded-full transition-all duration-1000"></div>
        
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-bold shadow-lg shadow-emerald-500/20 transition-all duration-500 scale-90 opacity-80">✓</div>
            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-slate-400">Biodata</span>
        </div>
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-bold shadow-lg shadow-emerald-500/20 transition-all duration-500 scale-90 opacity-80">✓</div>
            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-slate-400">Orang Tua</span>
        </div>
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-bold shadow-lg shadow-emerald-500/20 transition-all duration-500 scale-90 opacity-80">✓</div>
            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-slate-400">Berkas</span>
        </div>
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-bold shadow-xl shadow-emerald-500/30 scale-110">4</div>
            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-emerald-600 dark:text-emerald-400">Finalisasi</span>
        </div>
    </div>

    <!-- Review Card (Updated) -->
    <div class="bg-white dark:bg-dark-card rounded-[40px] shadow-2xl shadow-emerald-900/10 border border-slate-100 dark:border-slate-800 overflow-hidden">
        <div class="p-8 md:p-12">
            <div class="flex justify-between items-start mb-10">
                <div>
                    <h2 class="text-4xl font-extrabold text-light-text dark:text-white tracking-tight mb-2">Review Akhir</h2>
                    <p class="text-slate-500 dark:text-slate-400">Pastikan semua data sudah sesuai sebelum pengiriman final.</p>
                </div>
                <div class="hidden md:block">
                    <span class="px-5 py-2 rounded-2xl bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 text-[10px] font-black uppercase tracking-widest border border-amber-100 dark:border-amber-800">Pengecekan Akhir</span>
                </div>
            </div>

            <div class="space-y-12">
                <!-- Section 1: Biodata -->
                <div class="relative">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 rounded-2xl bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-sm">01</div>
                        <h3 class="text-xl font-bold text-light-text dark:text-white uppercase tracking-wider">Biodata Calon Santri</h3>
                        <a href="{{ route('ppdb.register') }}" class="ml-auto text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:gap-2 flex items-center transition-all">Edit <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12 bg-slate-50 dark:bg-dark-main/50 rounded-[32px] p-8 md:p-10 border border-slate-100 dark:border-slate-800">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-2">Nama Lengkap</label>
                            <p class="text-lg font-bold text-light-text dark:text-white">{{ $registration->full_name }}</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-2">Jenis Kelamin</label>
                            <p class="text-lg font-bold text-light-text dark:text-white">{{ $registration->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-2">Tempat, Tanggal Lahir</label>
                            <p class="text-lg font-bold text-light-text dark:text-white">{{ $registration->birth_place }}, {{ $registration->birth_date->format('d M Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-2">Agama</label>
                            <p class="text-lg font-bold text-light-text dark:text-white">{{ $registration->religion }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-2">Alamat Lengkap</label>
                            <p class="text-lg font-bold text-light-text dark:text-white leading-relaxed">{{ $registration->address }}</p>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Orang Tua & Sekolah -->
                <div class="relative">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 rounded-2xl bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-sm">02</div>
                        <h3 class="text-xl font-bold text-light-text dark:text-white uppercase tracking-wider">Orang Tua & Asal Sekolah</h3>
                        <a href="{{ route('ppdb.register.step2') }}" class="ml-auto text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:gap-2 flex items-center transition-all">Edit <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12 bg-slate-50 dark:bg-dark-main/50 rounded-[32px] p-8 md:p-10 border border-slate-100 dark:border-slate-800">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-2">Nama Ayah / Ibu Kandung</label>
                            <p class="text-lg font-bold text-light-text dark:text-white">{{ $registration->father_name ?: '-' }} / {{ $registration->mother_name ?: '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-2">No. WhatsApp Wali</label>
                            <p class="text-lg font-bold text-light-text dark:text-white">{{ $registration->father_phone ?: ($registration->mother_phone ?: ($registration->guardian_phone ?: '-')) }}</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-2">Asal Sekolah</label>
                            <p class="text-lg font-bold text-light-text dark:text-white">{{ $registration->origin_school }} (Lulus {{ $registration->graduation_year }})</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-2">NISN</label>
                            <p class="text-lg font-bold text-light-text dark:text-white">{{ $registration->nisn }}</p>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Berkas -->
                <div class="relative">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 rounded-2xl bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-sm">03</div>
                        <h3 class="text-xl font-bold text-light-text dark:text-white uppercase tracking-wider">Berkas Terlampir</h3>
                        <a href="{{ route('ppdb.register.step3') }}" class="ml-auto text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:gap-2 flex items-center transition-all">Edit <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></a>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        @php
                            $docs = [
                                ['label' => 'Pas Foto', 'url' => $registration->photo_url, 'icon' => '📸'],
                                ['label' => 'KK', 'url' => $registration->family_card_url, 'icon' => '👨‍👩‍👧‍👦'],
                                ['label' => 'Akta', 'url' => $registration->birth_cert_url, 'icon' => '📄'],
                                ['label' => 'Ijazah', 'url' => $registration->ijazah_url, 'icon' => '🎓'],
                                ['label' => 'KTP Wali', 'url' => $registration->ktp_parent_url, 'icon' => '🆔'],
                            ];
                        @endphp
                        @foreach($docs as $doc)
                            <div class="bg-slate-50 dark:bg-dark-main/50 rounded-2xl p-5 text-center border @if($doc['url']) border-emerald-100 dark:border-emerald-800 @else border-red-100 dark:border-red-900/30 @endif">
                                <span class="text-2xl block mb-2">{{ $doc['icon'] }}</span>
                                <p class="text-[9px] font-black uppercase text-slate-400 mb-1 tracking-wider">{{ $doc['label'] }}</p>
                                @if($doc['url'])
                                    <span class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-widest">Tersedia ✓</span>
                                @else
                                    <span class="text-[10px] font-bold text-red-600 dark:text-red-400 uppercase tracking-widest">Kosong ✗</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Final Form -->
            <form action="{{ route('ppdb.register.finalize') }}" method="POST" class="mt-16 pt-12 border-t border-slate-100 dark:border-slate-800">
                @csrf
                <input type="hidden" name="step" value="4">
                
                <!-- Pesan Error Dinamis & Session -->
                @if ($errors->any())
                    <div class="mb-8 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-2xl">
                        <ul class="list-disc list-inside text-xs font-bold text-red-600 dark:text-red-400">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-8 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-2xl text-xs font-bold text-red-600 dark:text-red-400">
                        {{ session('error') }}
                    </div>
                @endif

                
                <div class="mb-12">
                    <label class="flex items-start gap-5 cursor-pointer group">
                        <div class="relative mt-1">
                            <input type="checkbox" name="confirmation" value="1" class="peer sr-only" required>
                            <div class="w-7 h-7 rounded-lg border-2 border-slate-200 dark:border-slate-700 peer-checked:bg-emerald-500 peer-checked:border-emerald-500 transition-all flex items-center justify-center text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </div>
                        <span class="text-sm text-slate-500 dark:text-slate-400 font-medium leading-relaxed group-hover:text-light-text dark:group-hover:text-white transition-colors">
                            Saya menyatakan bahwa seluruh data yang saya masukkan adalah benar dan asli sesuai dengan dokumen yang diunggah. Saya memahami bahwa data ini akan diverifikasi oleh panitia PPDB {{ $profiles['nama_sekolah'] ?? 'PonPes Darel Azhar' }}.
                        </span>
                    </label>
                    @error('confirmation') <p class="mt-3 text-[10px] text-red-500 font-black uppercase tracking-widest">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col md:flex-row gap-5">
                    <a href="{{ route('ppdb.register.step3') }}" class="flex-1 py-5 rounded-[20px] bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-center font-bold hover:bg-slate-200 dark:hover:bg-slate-700 transition duration-300">
                        &larr; Kembali
                    </a>
                    <button type="submit" class="flex-[3] py-5 rounded-[20px] bg-emerald-500 text-white font-black uppercase tracking-widest text-sm shadow-2xl shadow-emerald-500/30 hover:bg-emerald-600 hover:-translate-y-1 active:translate-y-0 transition-all duration-300">
                        Kirim Pendaftaran Final &rarr;
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
