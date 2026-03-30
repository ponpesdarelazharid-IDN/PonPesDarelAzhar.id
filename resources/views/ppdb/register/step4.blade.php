@extends('layouts.app')

@section('title', 'Konfirmasi Pendaftaran - PPDB')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <!-- Progress Stepper -->
    <div class="mb-12">
        <div class="flex items-center justify-between relative">
            <div class="absolute top-1/2 left-0 w-full h-0.5 bg-slate-200 dark:bg-gray-800 -translate-y-1/2"></div>
            <!-- Step 1 -->
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold shadow-lg">✓</div>
                <span class="mt-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Biodata</span>
            </div>
            <!-- Step 2 -->
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold shadow-lg">✓</div>
                <span class="mt-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Orang Tua</span>
            </div>
            <!-- Step 3 -->
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold shadow-lg">✓</div>
                <span class="mt-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Berkas</span>
            </div>
            <!-- Step 4 -->
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-12 h-12 rounded-full bg-[#1e293b] dark:bg-white text-white dark:text-black flex items-center justify-center font-bold shadow-xl border-4 border-white dark:border-[#0a0a0a]">4</div>
                <span class="mt-2 text-xs font-bold text-slate-800 dark:text-white uppercase tracking-wider">Review</span>
            </div>
        </div>
    </div>

    <!-- Review Card -->
    <div class="bg-white dark:bg-[#0a0a0a] rounded-[2.5rem] shadow-2xl border border-slate-100 dark:border-gray-900 overflow-hidden">
        <div class="p-8 md:p-12">
            <div class="flex justify-between items-start mb-10">
                <div>
                    <h2 class="text-4xl font-black text-[#1e293b] dark:text-white tracking-tight mb-2">Review Pendaftaran</h2>
                    <p class="text-slate-500 dark:text-gray-400">Periksa kembali data Anda sebelum menekan tombol kirim.</p>
                </div>
                <div class="hidden md:block">
                    <span class="px-5 py-2 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-xs font-black uppercase tracking-widest border border-amber-200 dark:border-amber-800">Draft Mode</span>
                </div>
            </div>

            <div class="space-y-12">
                <!-- Section 1: Biodata -->
                <div class="relative">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-8 h-8 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-sm">01</div>
                        <h3 class="text-xl font-bold text-[#1e293b] dark:text-white uppercase tracking-wider">Data Diri Santri</h3>
                        <a href="{{ route('ppdb.register') }}" class="ml-auto text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">Edit</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12 bg-slate-50 dark:bg-gray-900/50 rounded-3xl p-8">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-1">Nama Lengkap</label>
                            <p class="text-lg font-bold text-slate-800 dark:text-white">{{ $registration->full_name }}</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-1">Jenis Kelamin</label>
                            <p class="text-lg font-bold text-slate-800 dark:text-white">{{ $registration->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-1">Tempat, Tanggal Lahir</label>
                            <p class="text-lg font-bold text-slate-800 dark:text-white">{{ $registration->birth_place }}, {{ $registration->birth_date->format('d M Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-1">Agama</label>
                            <p class="text-lg font-bold text-slate-800 dark:text-white">{{ $registration->religion }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-1">Alamat Lengkap</label>
                            <p class="text-lg font-bold text-slate-800 dark:text-white leading-relaxed">{{ $registration->address }}</p>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Orang Tua & Sekolah -->
                <div class="relative">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-8 h-8 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-sm">02</div>
                        <h3 class="text-xl font-bold text-[#1e293b] dark:text-white uppercase tracking-wider">Orang Tua & Sekolah</h3>
                        <a href="{{ route('ppdb.register.step2') }}" class="ml-auto text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">Edit</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12 bg-slate-50 dark:bg-gray-900/50 rounded-3xl p-8">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-1">Nama Ayah / Ibu</label>
                            <p class="text-lg font-bold text-slate-800 dark:text-white">{{ $registration->father_name }} / {{ $registration->mother_name }}</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-1">No. WhatsApp Wali</label>
                            <p class="text-lg font-bold text-slate-800 dark:text-white">{{ $registration->parent_phone }}</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-1">Asal Sekolah</label>
                            <p class="text-lg font-bold text-slate-800 dark:text-white">{{ $registration->origin_school }} (Lulus {{ $registration->graduation_year }})</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-1">Pekerjaan Orang Tua</label>
                            <p class="text-lg font-bold text-slate-800 dark:text-white">{{ $registration->parent_job }}</p>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Berkas -->
                <div class="relative">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-8 h-8 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-sm">03</div>
                        <h3 class="text-xl font-bold text-[#1e293b] dark:text-white uppercase tracking-wider">Berkas Terlampir</h3>
                        <a href="{{ route('ppdb.register.step3') }}" class="ml-auto text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">Edit</a>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @php
                            $docs = [
                                ['label' => 'Pas Foto', 'url' => $registration->photo_url, 'icon' => '📸'],
                                ['label' => 'Akta Lahir', 'url' => $registration->birth_cert_url, 'icon' => '📄'],
                                ['label' => 'Ijazah', 'url' => $registration->ijazah_url, 'icon' => '🎓'],
                                ['label' => 'SKHU', 'url' => $registration->skhu_url, 'icon' => '📝'],
                            ];
                        @endphp
                        @foreach($docs as $doc)
                            <div class="bg-slate-50 dark:bg-gray-900/50 rounded-2xl p-4 text-center border @if($doc['url']) border-emerald-100 dark:border-emerald-900/30 @else border-red-100 dark:border-red-900/30 @endif">
                                <span class="text-2xl block mb-2">{{ $doc['icon'] }}</span>
                                <p class="text-[10px] font-black uppercase text-slate-400 mb-1">{{ $doc['label'] }}</p>
                                @if($doc['url'])
                                    <span class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-widest">Tersedia ✓</span>
                                @else
                                    <span class="text-[10px] font-bold text-red-600 dark:text-red-400 uppercase tracking-widest">Belum Ada ✗</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Final Form -->
            <form action="{{ route('ppdb.register.finalize') }}" method="POST" class="mt-16 pt-10 border-t border-slate-100 dark:border-gray-900">
                @csrf
                <input type="hidden" name="step" value="4">
                
                <div class="mb-10">
                    <label class="flex items-start gap-4 cursor-pointer group">
                        <div class="relative mt-1">
                            <input type="checkbox" name="confirmation" value="1" class="peer hidden" required>
                            <div class="w-6 h-6 rounded-lg border-2 border-slate-200 dark:border-gray-800 peer-checked:bg-emerald-500 peer-checked:border-emerald-500 transition-all flex items-center justify-center text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </div>
                        <span class="text-sm text-slate-600 dark:text-gray-400 font-medium leading-relaxed group-hover:text-[#1e293b] dark:group-hover:text-white transition-colors">
                            Saya menyatakan bahwa seluruh data yang saya masukkan adalah benar dan asli. Saya memahami bahwa data ini akan diverifikasi oleh panitia PPDB {{ config('app.name') }}.
                        </span>
                    </label>
                    @error('confirmation') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-widest">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col md:flex-row gap-4">
                    <a href="{{ route('ppdb.register.step3') }}" class="flex-1 py-5 rounded-2xl bg-slate-100 dark:bg-gray-900 text-[#1e293b] dark:text-white text-center font-bold hover:bg-slate-200 dark:hover:bg-gray-800 transition">
                        Kembali Ke Upload
                    </a>
                    <button type="submit" class="flex-[3] py-5 rounded-2xl bg-[#1e293b] dark:bg-white text-white dark:text-black font-extrabold text-xl shadow-xl hover:scale-[1.02] active:scale-95 transition-all duration-300">
                        Selesaikan Pendaftaran 🚀
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
