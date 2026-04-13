@extends('layouts.admin')

@section('title', 'Verifikasi Pendaftar - ' . $registration->full_name)

@section('content')
<div class="relative max-w-7xl mx-auto">
    <!-- Action Header -->
    <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <a href="{{ route('admin.registrations.index') }}" class="group inline-flex items-center gap-3 px-5 py-2.5 rounded-2xl bg-white dark:bg-slate-800 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-emerald-500 transition-all duration-300 shadow-sm border border-slate-100 dark:border-slate-700">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Daftar
            </a>
            <h1 class="text-4xl font-extrabold text-[#111c3a] dark:text-white tracking-tight mt-6">Verifikasi Berkas</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1 font-medium">Peninjauan detail calon santri & validasi dokumen persyaratan.</p>
        </div>
        
        <div class="flex gap-3">
             <button onclick="window.print()" class="px-6 py-3 bg-white dark:bg-slate-800 text-[10px] font-black uppercase tracking-widest text-slate-600 dark:text-slate-400 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm hover:bg-slate-50 transition-all">
                🖨️ Cetak PDF
            </button>
            <div @class([
                'px-8 py-3.5 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] shadow-xl transition-all duration-500 border',
                'bg-amber-50 text-amber-600 border-amber-100 dark:bg-amber-900/20 dark:border-amber-800' => $registration->status == 'pending',
                'bg-blue-50 text-blue-600 border-blue-100 dark:bg-blue-900/20 dark:border-blue-800' => $registration->status == 'verified',
                'bg-emerald-50 text-emerald-600 border-emerald-100 dark:bg-emerald-900/30 dark:border-emerald-800' => $registration->status == 'accepted',
                'bg-red-50 text-red-600 border-red-100 dark:bg-red-900/20 dark:border-red-800' => $registration->status == 'rejected',
            ])>
                {{ $registration->status }}
            </div>
        </div>
    </div>

    <!-- Main Container: Document Folder Style -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <!-- Left Sidebar: Profile & Nav -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white dark:bg-dark-card rounded-[32px] p-6 shadow-2xl shadow-slate-900/5 border border-slate-100 dark:border-slate-800 text-center overflow-hidden relative">
                @if($registration->status == 'accepted')
                    <div class="absolute -right-8 top-8 rotate-45 bg-emerald-500 text-white text-[8px] font-black px-10 py-1 uppercase tracking-widest shadow-lg">Diterima</div>
                @endif
                
                <div class="w-32 h-32 mx-auto rounded-[32px] overflow-hidden border-4 border-slate-50 dark:border-slate-800 shadow-inner mb-6 relative group">
                    <img src="{{ $registration->photo_url }}" class="w-full h-full object-cover">
                    <a href="{{ $registration->photo_url }}" target="_blank" class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-[8px] font-bold uppercase">Zoom</a>
                </div>
                
                <h3 class="text-xl font-black text-[#111c3a] dark:text-white leading-tight uppercase tracking-tight">{{ $registration->full_name }}</h3>
                <p class="text-[10px] font-black text-emerald-500 mt-2 tracking-widest">{{ $registration->registration_number }}</p>
                
                <div class="mt-8 grid grid-cols-2 gap-2">
                    <div class="p-3 bg-slate-50 dark:bg-dark-main rounded-2xl">
                        <p class="text-[8px] font-black text-slate-400 uppercase">Gender</p>
                        <p class="text-[10px] font-bold text-[#111c3a] dark:text-white">{{ $registration->gender == 'L' ? 'Laki-Laki' : 'Perempuan' }}</p>
                    </div>
                    <div class="p-3 bg-slate-50 dark:bg-dark-main rounded-2xl">
                        <p class="text-[8px] font-black text-slate-400 uppercase">Lulusan</p>
                        <p class="text-[10px] font-bold text-[#111c3a] dark:text-white">{{ $registration->graduation_year }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Info -->
            <div class="bg-[#111c3a] rounded-[32px] p-6 text-white shadow-xl shadow-slate-900/20">
                <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4">Kontak Wali</h4>
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">📱</div>
                    <div>
                        <p class="text-[9px] text-slate-400 uppercase font-bold">WhatsApp</p>
                        <p class="text-xs font-bold">{{ $registration->parent_phone }}</p>
                    </div>
                </div>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $registration->parent_phone) }}" target="_blank" class="block w-full py-3 bg-emerald-500 hover:bg-emerald-600 rounded-xl text-center text-[10px] font-black uppercase tracking-widest transition-colors">
                    Hubungi via WA
                </a>
            </div>
        </div>

        <!-- Right Content: The Folder -->
        <div class="lg:col-span-3 space-y-8">
            
            <!-- Document Section: Identity -->
            <div class="bg-white dark:bg-dark-card rounded-[40px] shadow-2xl shadow-slate-900/5 border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="px-8 py-6 bg-slate-50 dark:bg-dark-main/50 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <h4 class="text-sm font-black text-[#111c3a] dark:text-white uppercase tracking-widest">I. Identitas Diri</h4>
                    <span class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 flex items-center justify-center text-xs">01</span>
                </div>
                <div class="p-8 md:p-10 grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                    <div class="space-y-1">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Tempat, Tanggal Lahir</p>
                        <p class="font-bold text-[#111c3a] dark:text-white uppercase">{{ $registration->birth_place ?? '-' }}, {{ $registration->birth_date ? $registration->birth_date->format('d F Y') : '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Agama</p>
                        <p class="font-bold text-[#111c3a] dark:text-white uppercase">{{ $registration->religion ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2 space-y-1">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Alamat Domisili</p>
                        <p class="font-bold text-[#111c3a] dark:text-white leading-relaxed uppercase">{{ $registration->address ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Document Section: Origin -->
            <div class="bg-white dark:bg-dark-card rounded-[40px] shadow-2xl shadow-slate-900/5 border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="px-8 py-6 bg-slate-50 dark:bg-dark-main/50 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <h4 class="text-sm font-black text-[#111c3a] dark:text-white uppercase tracking-widest">II. Riwayat Pendidikan & Orang Tua</h4>
                    <span class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 flex items-center justify-center text-xs">02</span>
                </div>
                <div class="p-8 md:p-10 space-y-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        <div class="space-y-1">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Asal Sekolah</p>
                            <p class="font-bold text-[#111c3a] dark:text-white uppercase">{{ $registration->origin_school ?? '-' }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Alamat Sekolah Asal</p>
                            <p class="font-bold text-[#111c3a] dark:text-white uppercase">{{ $registration->origin_school_address ?? '-' }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Nama Ayah / Ibu</p>
                            <p class="font-bold text-[#111c3a] dark:text-white uppercase">{{ $registration->father_name ?? '-' }} / {{ $registration->mother_name ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Document Section: Requirements -->
            <div class="bg-white dark:bg-dark-card rounded-[40px] shadow-2xl shadow-slate-900/5 border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="px-8 py-6 bg-slate-50 dark:bg-dark-main/50 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <h4 class="text-sm font-black text-[#111c3a] dark:text-white uppercase tracking-widest">III. Berkas Syarat Administratif</h4>
                    <span class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 flex items-center justify-center text-xs">03</span>
                </div>
                <div class="p-8 md:p-10">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <!-- Bukti Bayar -->
                        <div class="group relative">
                            <p class="text-[8px] font-black text-emerald-500 uppercase tracking-widest mb-3 ml-1">Bukti Transfer (PSB)</p>
                            @if($registration->payment_receipt_url)
                            <a href="{{ $registration->payment_receipt_url }}" target="_blank" class="block p-6 rounded-3xl bg-emerald-50 dark:bg-emerald-900/10 border-2 border-dashed border-emerald-200 dark:border-emerald-800 hover:border-emerald-500 transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="text-2xl">💰</div>
                                    <div class="flex-1">
                                        <p class="text-[10px] font-black text-emerald-700 dark:text-emerald-400 uppercase">Sudah Bayar</p>
                                        <p class="text-[8px] text-slate-400 uppercase mt-0.5">Klik untuk Verifikasi</p>
                                    </div>
                                </div>
                            </a>
                            @else
                            <div class="p-6 rounded-3xl bg-red-50/30 border border-dashed border-red-100 flex items-center gap-4 text-red-300 italic text-[10px] font-bold uppercase tracking-widest">
                                <span>❌</span> Belum Bayar
                            </div>
                            @endif
                        </div>

                        <!-- Ijazah -->
                        <div class="group relative">
                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Ijazah / SKL</p>
                            @if($registration->ijazah_url)
                            <a href="{{ $registration->ijazah_url }}" target="_blank" class="block p-6 rounded-3xl bg-slate-50 dark:bg-dark-main border border-dashed border-slate-200 dark:border-slate-700 hover:border-emerald-500 hover:bg-emerald-50 dark:hover:bg-emerald-900/10 transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="text-2xl">🎓</div>
                                    <div class="flex-1">
                                        <p class="text-[10px] font-black text-[#111c3a] dark:text-white uppercase">Tersedia</p>
                                        <p class="text-[8px] text-slate-400 uppercase mt-0.5">Lihat Berkas</p>
                                    </div>
                                </div>
                            </a>
                            @else
                            <div class="p-6 rounded-3xl bg-slate-50/50 border border-dotted border-slate-200 flex items-center gap-4 text-slate-300 italic text-[10px] font-bold uppercase tracking-widest">
                                <span>-</span> Kosong
                            </div>
                            @endif
                        </div>

                        <!-- KK -->
                        <div class="group relative">
                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Kartu Keluarga (KK)</p>
                            @if($registration->family_card_url)
                            <a href="{{ $registration->family_card_url }}" target="_blank" class="block p-6 rounded-3xl bg-slate-50 dark:bg-dark-main border border-dashed border-slate-200 dark:border-slate-700 hover:border-emerald-500 hover:bg-emerald-50 dark:hover:bg-emerald-900/10 transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="text-2xl">👨‍👩‍👧</div>
                                    <div class="flex-1">
                                        <p class="text-[10px] font-black text-[#111c3a] dark:text-white uppercase">Tersedia</p>
                                        <p class="text-[8px] text-slate-400 uppercase mt-0.5">Lihat Berkas</p>
                                    </div>
                                </div>
                            </a>
                            @else
                            <div class="p-6 rounded-3xl bg-slate-50/50 border border-dotted border-slate-200 flex items-center gap-4 text-slate-300 italic text-[10px] font-bold uppercase tracking-widest">
                                <span>-</span> Kosong
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- NEW SECTION: BIAYA MASUK & CICILAN -->
            <div class="bg-white dark:bg-dark-card rounded-[40px] shadow-2xl shadow-slate-900/5 border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="px-8 py-6 bg-slate-50 dark:bg-dark-main/50 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <h4 class="text-sm font-black text-[#111c3a] dark:text-white uppercase tracking-widest">IV. Administrasi Biaya Masuk</h4>
                    <span class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 flex items-center justify-center text-xs">04</span>
                </div>
                <div class="p-8 md:p-10">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                        <div class="p-6 rounded-3xl bg-slate-50 dark:bg-dark-main border border-slate-100 dark:border-slate-800">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Tagihan (Rp)</p>
                            <p class="text-xl font-black text-[#111c3a] dark:text-white">{{ number_format($registration->total_required, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-6 rounded-3xl bg-emerald-50 dark:bg-emerald-900/10 border border-emerald-100 dark:border-emerald-800">
                            <p class="text-[9px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-widest mb-1">Total Terbayar (Rp)</p>
                            <p class="text-xl font-black text-emerald-600 dark:text-emerald-400 font-black">{{ number_format($registration->total_paid, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-6 rounded-3xl @if($registration->payment_remaining > 0) bg-red-50 dark:bg-red-900/10 border-red-100 dark:border-red-800 @else bg-emerald-50 dark:bg-emerald-900/10 border-emerald-100 dark:border-emerald-800 @endif">
                            <p class="text-[9px] font-black @if($registration->payment_remaining > 0) text-red-600 @else text-emerald-600 @endif uppercase tracking-widest mb-1">Sisa Tagihan (Rp)</p>
                            <p class="text-xl font-black @if($registration->payment_remaining > 0) text-red-600 @else text-emerald-600 @endif">{{ number_format($registration->payment_remaining, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <h5 class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-6">Daftar Bukti Cicilan</h5>
                    <div class="space-y-4">
                        @forelse($registration->payments as $payment)
                        <div class="flex flex-col md:flex-row items-center gap-6 p-6 rounded-3xl border border-slate-100 dark:border-slate-800 bg-white dark:bg-dark-main/50 group transition-all hover:border-emerald-500/30">
                            <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-inner flex-shrink-0">
                                <a href="{{ $payment->receipt_url }}" target="_blank">
                                    <img src="{{ $payment->receipt_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                </a>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-black text-[#111c3a] dark:text-white">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                                <p class="text-[9px] font-bold text-slate-400 uppercase">{{ $payment->created_at->format('d M Y, H:i') }}</p>
                                @if($payment->notes)
                                    <p class="mt-2 text-[9px] bg-red-50 text-red-600 p-2 rounded-lg italic">Catatan: {{ $payment->notes }}</p>
                                @endif
                            </div>
                            <div class="flex gap-2">
                                @if($payment->status === 'pending')
                                    <form action="{{ route('admin.installments.verify', $payment) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-[9px] font-black uppercase tracking-widest rounded-xl transition-all">Verifikasi ✅</button>
                                    </form>
                                    <button onclick="document.getElementById('reject-modal-{{ $payment->id }}').classList.remove('hidden')" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-[9px] font-black uppercase tracking-widest rounded-xl transition-all">Tolak 🚫</button>
                                    
                                    <!-- Simple Reject Modal -->
                                    <div id="reject-modal-{{ $payment->id }}" class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
                                        <div class="bg-white dark:bg-slate-900 rounded-[32px] p-8 max-w-sm w-full shadow-2xl">
                                            <h3 class="text-lg font-black text-slate-800 dark:text-white mb-4">Alasan Penolakan</h3>
                                            <form action="{{ route('admin.installments.reject', $payment) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <textarea name="notes" required placeholder="Misal: Bukti tidak terbaca / Nominal tidak sesuai..." class="w-full rounded-2xl bg-slate-50 dark:bg-slate-800 border-none px-5 py-4 text-xs font-bold mb-6 focus:ring-2 focus:ring-red-500 transition-all"></textarea>
                                                <div class="flex gap-3">
                                                    <button type="button" onclick="document.getElementById('reject-modal-{{ $payment->id }}').classList.add('hidden')" class="flex-1 py-4 bg-slate-100 dark:bg-slate-800 text-slate-600 text-[10px] font-black uppercase tracking-widest rounded-xl">Batal</button>
                                                    <button type="submit" class="flex-1 py-4 bg-red-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-lg shadow-red-500/30">Kirim Penolakan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <span @class([
                                        'px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest',
                                        'bg-emerald-50 text-emerald-600' => $payment->status === 'verified',
                                        'bg-red-50 text-red-600' => $payment->status === 'rejected',
                                    ])>
                                        {{ $payment->status === 'verified' ? 'TERVERIFIKASI' : 'DITOLAK' }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="py-10 text-center text-slate-400 italic font-bold text-[10px] uppercase border-2 border-dashed border-slate-100 dark:border-slate-800 rounded-3xl">
                            Belum ada riwayat cicilan Biaya Masuk.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Verification Action Box -->
            <div class="bg-[#111c3a] dark:bg-slate-900 rounded-[40px] shadow-2xl p-8 md:p-12 text-white overflow-hidden relative border border-slate-700">
                <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/10 blur-[100px] rounded-full"></div>
                
                <div class="relative flex flex-col md:flex-row gap-10 items-start">
                    <div class="flex-1 space-y-6">
                        <div>
                            <h4 class="text-2xl font-black uppercase tracking-tight">Keputusan Verifikasi Final</h4>
                            <p class="text-slate-400 text-xs mt-2 uppercase tracking-widest font-bold">Pastikan pendaftar telah menyelesaikan seluruh administrasi.</p>
                        </div>
                        
                        <form action="{{ route('admin.registrations.update', $registration) }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PATCH')
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Update Status</label>
                                    <select name="status" class="w-full bg-white/10 border-none rounded-2xl px-6 py-4 text-white font-bold text-sm focus:ring-2 focus:ring-emerald-500 appearance-none cursor-pointer transition-all">
                                        <option value="pending" class="text-slate-800" {{ $registration->status == 'pending' ? 'selected' : '' }}>⌛ Pending (Menunggu Hasil)</option>
                                        <option value="verified" class="text-slate-800" {{ $registration->status == 'verified' ? 'selected' : '' }}>🛡️ Verified (Validasi Dokumen)</option>
                                        <option value="accepted" class="text-slate-800" {{ $registration->status == 'accepted' ? 'selected' : '' }}>🏆 Accepted (Lulus & Lunas)</option>
                                        <option value="rejected" class="text-slate-800" {{ $registration->status == 'rejected' ? 'selected' : '' }}>🚫 Rejected (Ditolak)</option>
                                    </select>
                                    @if($registration->payment_remaining > 0)
                                        <p class="mt-3 text-[9px] text-amber-400 font-bold uppercase tracking-widest italic animate-pulse">⚠️ Peringatan: Mahasiswa ini belum melunasi biaya masuk (Sisa: Rp {{ number_format($registration->payment_remaining, 0, ',', '.') }}). Anda tidak dapat mengubah status menjadi Lulus (Accepted).</p>
                                    @endif
                                </div>
                                <div class="relative">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Catatan Verifikator</label>
                                    <textarea name="notes" rows="3" class="w-full bg-white/10 border-none rounded-2xl px-6 py-4 text-white font-bold text-sm focus:ring-2 focus:ring-emerald-500 placeholder-slate-500 transition-all" placeholder="Alasan penerimaan/penolakan...">{{ old('notes', $registration->notes) }}</textarea>
                                </div>
                            </div>
                            
                            <div class="flex justify-end pt-4">
                                <button type="submit" class="px-12 py-5 bg-emerald-500 hover:bg-emerald-600 text-white font-black uppercase tracking-widest text-sm rounded-[24px] shadow-xl shadow-emerald-500/30 transition-all hover:-translate-y-1 active:translate-y-0">
                                    Simpan Keputusan Akhir &rarr;
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
