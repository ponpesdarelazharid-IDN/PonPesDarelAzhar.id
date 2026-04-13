<x-app-layout>
    <div class="py-12 bg-slate-50 dark:bg-[#060606] min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Success Banner (Only after form submission) -->
            @if(session('pendaftaran_selesai'))
                <div class="mb-10 p-8 rounded-[2.5rem] bg-emerald-600 dark:bg-emerald-500 shadow-2xl shadow-emerald-500/20 text-white relative overflow-hidden group">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-5 mb-4">
                            <span class="text-4xl">🎉</span>
                            <h2 class="text-3xl font-black tracking-tighter">Formulir Terkirim!</h2>
                        </div>
                        <p class="text-emerald-50 font-medium leading-relaxed max-w-2xl">
                            Terima kasih telah melengkapi data pendaftaran. Panitia akan meninjau kelengkapan berkas Anda. Silakan lanjutkan ke tahap Ujian Seleksi Online di bawah ini.
                        </p>
                    </div>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-8 p-6 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 flex items-center gap-4 text-xs font-black uppercase tracking-widest">
                    <span class="text-2xl">✅</span>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-8 p-6 rounded-2xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-300 flex items-center gap-4 text-xs font-black uppercase tracking-widest">
                    <span class="text-2xl">❌</span>
                    {{ session('error') }}
                </div>
            @endif

            @php
                $status = $registration->status;
                $hasPaid = (bool) $registration->payment_receipt_url;
            @endphp

            <div class="space-y-8">
                <!-- Status Header Card -->
                <div class="bg-white dark:bg-dark-card rounded-[2.5rem] shadow-2xl border border-slate-100 dark:border-slate-800 p-8 md:p-12 relative overflow-hidden">
                    <div class="absolute right-0 top-0 mt-8 mr-8">
                        @if($status == 'draft' && !$hasPaid)
                            <span class="px-5 py-2 rounded-xl bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-[10px] font-black uppercase tracking-[0.2em] border border-red-100 dark:border-red-800">Menunggu Pembayaran</span>
                        @elseif($status == 'draft' && $hasPaid)
                            <span class="px-5 py-2 rounded-xl bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 text-[10px] font-black uppercase tracking-[0.2em] border border-amber-100 dark:border-amber-800">Verifikasi Pembayaran</span>
                        @elseif($status == 'verified')
                            <span class="px-5 py-2 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-[10px] font-black uppercase tracking-[0.2em] border border-indigo-100 dark:border-indigo-800">Lengkapi Formulir</span>
                        @elseif($status == 'pending')
                            <span class="px-5 py-2 rounded-xl bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-[10px] font-black uppercase tracking-[0.2em] border border-blue-100 dark:border-blue-800">Menunggu Hasil</span>
                        @elseif($status == 'accepted')
                             <span class="px-5 py-2 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 text-[10px] font-black uppercase tracking-[0.2em] border border-emerald-100 dark:border-emerald-800">Diterima</span>
                        @endif
                    </div>

                    <div class="flex flex-col md:flex-row gap-8 items-start md:items-center">
                        <div class="w-24 h-24 rounded-[32px] bg-slate-50 dark:bg-slate-800/50 flex items-center justify-center text-4xl shadow-inner">
                            @if($status == 'accepted') 🧑‍🎓 @elseif($status == 'rejected') ❌ @elseif($status == 'verified') 📄 @else ⏳ @endif
                        </div>
                        <div>
                            <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tighter mb-1">Status Pendaftaran</h2>
                            <p class="text-slate-400 font-bold uppercase tracking-[0.3em] text-[10px]">No. Reg: {{ $registration->registration_number }}</p>
                        </div>
                    </div>

                    <!-- Progress Section -->
                    <div class="mt-12">
                        @if($status == 'draft')
                            <!-- PHASE 1: PAYMENT -->
                            @if(!$hasPaid)
                                <div class="p-8 md:p-10 rounded-[2.5rem] bg-slate-900 text-white border border-slate-800 shadow-2xl relative overflow-hidden">
                                    <div class="absolute top-0 right-0 p-10 opacity-10"><i class="fa-solid fa-money-bill-transfer text-[120px]"></i></div>
                                    <div class="relative z-10">
                                        <h3 class="text-2xl font-black mb-6 flex items-center gap-3 italic">
                                            <span class="text-emerald-400 underline">Langkah 1: Pembayaran Biaya Pendaftaran</span>
                                        </h3>
                                        <p class="text-slate-400 text-sm mb-8 leading-relaxed">Selamat data di portal PSB Darel Azhar. Untuk melanjutkan ke tahap pengisian formulir, silakan lakukan pembayaran biaya pendaftaran sebesar <strong>Rp 205.000</strong>.</p>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                                            <div class="bg-white/5 p-6 rounded-3xl border border-white/10">
                                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Tujuan Transfer (BNI)</p>
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-[9px] text-slate-400 uppercase font-bold">Virtual Account BNI</p>
                                                        <p class="text-xl font-black text-emerald-400 tracking-wider">9881601421135525</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-[9px] text-slate-400 uppercase font-bold">Rekening BNI</p>
                                                        <p class="text-lg font-bold">1889-106-973</p>
                                                        <p class="text-[10px] font-medium opacity-70">a/n PSB PONPES MODERN DAREL AZHAR</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bg-emerald-500/10 p-6 rounded-3xl border border-emerald-500/20">
                                                <p class="text-[10px] font-black text-emerald-400 uppercase tracking-widest mb-3">Kontak Panitia</p>
                                                <div class="space-y-3">
                                                    <a href="https://wa.me/6287739975051" class="flex items-center gap-3 group">
                                                        <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition-all text-xs font-bold">1</div>
                                                        <span class="text-xs font-bold">Usth Risna: 0877 3997 5051</span>
                                                    </a>
                                                    <a href="https://wa.me/6287840810796" class="flex items-center gap-3 group">
                                                        <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition-all text-xs font-bold">2</div>
                                                        <span class="text-xs font-bold">Usth Milda: 0878 4081 0796</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bg-white rounded-[2rem] p-8 text-slate-900 shadow-xl">
                                            <h4 class="text-lg font-black uppercase mb-6 flex items-center gap-3">
                                                <span class="w-8 h-8 bg-slate-900 text-white rounded-full flex items-center justify-center text-xs">🚀</span>
                                                Upload Bukti Transfer
                                            </h4>
                                            <form action="{{ route('ppdb.payment.store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-6">
                                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Pilih Gambar/Foto Bukti</label>
                                                    <input type="file" name="payment_receipt" required class="w-full px-5 py-4 border-2 border-dashed border-slate-200 rounded-2xl text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-emerald-500 file:text-white hover:border-emerald-500 transition-colors">
                                                </div>
                                                <button type="submit" class="w-full py-5 bg-slate-900 text-white font-black uppercase tracking-[0.2em] text-xs rounded-2xl hover:bg-slate-800 transition shadow-lg">Kirim Bukti Pembayaran Sekarang &rarr;</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- WAITING PAYMENT VERIFICATION -->
                                <div class="p-10 rounded-[2.5rem] bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-100 dark:border-indigo-800 text-center">
                                    <div class="w-24 h-24 bg-white dark:bg-indigo-800 rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl shadow-indigo-500/10">
                                        <span class="text-4xl animate-pulse">🔎</span>
                                    </div>
                                    <h3 class="text-2xl font-black text-indigo-900 dark:text-indigo-400 mb-2">Sedang Diverifikasi</h3>
                                    <p class="text-slate-500 dark:text-slate-400 max-w-sm mx-auto leading-relaxed">Terima kasih! Bukti pembayaran Anda telah kami terima. Panitia sedang melakukan pengecekan. Mohon bersabar.</p>
                                </div>
                            @endif
                        @elseif($status == 'verified')
                            <!-- PHASE 2: FILLING FORM -->
                            <div class="p-10 rounded-[2.5rem] bg-emerald-600 text-white shadow-2xl shadow-emerald-500/20 text-center relative overflow-hidden group">
                                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                                <div class="relative z-10">
                                    <div class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center mx-auto mb-6"><span class="text-4xl">✅</span></div>
                                    <h3 class="text-2xl font-black mb-4 uppercase tracking-tight">Pembayaran Diverifikasi!</h3>
                                    <p class="text-emerald-50 mb-8 max-w-sm mx-auto leading-relaxed font-medium">Pembayaran Anda telah divalidasi oleh panitia. Silakan lanjutkan untuk mengisi formulir pendaftaran santri baru dengan lengkap.</p>
                                    <a href="{{ route('ppdb.register') }}" class="inline-flex items-center px-12 py-6 bg-white text-emerald-600 font-extrabold uppercase tracking-[0.2em] rounded-2xl shadow-xl hover:scale-105 transition-all text-xs">Ayo Isi Formulir Pendaftaran &rarr;</a>
                                </div>
                            </div>
                        @elseif($status == 'pending')
                            <!-- PHASE 3: VIDEO CALL INTERVIEW / WAITING REVIEW -->
                            <div class="p-10 rounded-[2.5rem] bg-indigo-600 dark:bg-indigo-500 text-white shadow-2xl shadow-indigo-500/20 text-center relative overflow-hidden group">
                                 <div class="relative z-10">
                                    <div class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center mx-auto mb-6"><span class="text-4xl">📞</span></div>
                                    <h3 class="text-2xl font-black mb-3 italic tracking-tight">Wawancara Video Call (WA)</h3>
                                    <p class="text-indigo-50 mb-8 max-w-sm mx-auto leading-relaxed font-medium">Tes seleksi dilakukan melalui <strong>Video Call WhatsApp</strong>. Pastikan nomor pendaftar/orang tua aktif WhatsApp. Silakan konfirmasi kesiapan Anda ke panitia.</p>
                                    
                                    <a href="https://wa.me/6287739975051?text=Halo%20Panitia%20PSB%20Darel%20Azhar,%20saya%20sudah%20melengkapi%20formulir%20dan%20siap%20untuk%20jadwal%20Wawancara%20Video%20Call.%20(No%20Reg:%20{{ $registration->registration_number }})" target="_blank" class="inline-flex items-center px-10 py-5 bg-white text-emerald-600 font-black uppercase tracking-widest rounded-2xl shadow-xl hover:scale-105 active:scale-95 transition-all gap-3">
                                        <i class="fa-brands fa-whatsapp text-xl"></i> Konfirmasi Jadwal Sekarang
                                    </a>
                                    
                                    <p class="mt-6 text-[10px] text-indigo-200 font-bold uppercase tracking-widest">Panitia akan menghubungi nomor Anda segera.</p>
                                 </div>
                            </div>
                        @elseif($status == 'accepted')
                            <!-- PHASE 4: ACCEPTED -->
                            <div class="p-10 rounded-[2.5rem] bg-emerald-500 text-white shadow-2xl shadow-emerald-500/20 text-center relative overflow-hidden group">
                                <div class="relative z-10">
                                    <h3 class="text-3xl font-black mb-4 flex items-center justify-center gap-4"><span class="text-4xl animate-bounce">🎊</span> Selamat, Anda Diterima!</h3>
                                    <p class="text-emerald-50 mb-8 max-w-lg mx-auto leading-relaxed font-medium">Selamat bergabung di keluarga besar Pondok Pesantren Modern Darel Azhar. Silakan cetak kartu pelajar digital Anda sebagai bukti resmi.</p>
                                    <a href="{{ route('ppdb.register.card') }}" target="_blank" class="px-10 py-5 bg-white text-emerald-600 font-black uppercase tracking-widest rounded-2xl shadow-xl hover:scale-105 transition-all flex items-center gap-3"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg> Cetak Kartu Pelajar 🖨️</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Only show summary if form has been started/submitted -->
                @if($status != 'draft')
                    <div class="space-y-8 animate-in transition-all">
                        
                        <!-- NEW SECTION: BILLING & INSTALLMENTS -->
                        @if($status == 'pending' || $status == 'accepted' || $status == 'verified')
                        <div class="bg-white dark:bg-dark-card rounded-[2.5rem] shadow-2xl border border-slate-100 dark:border-slate-800 p-8 md:p-12 overflow-hidden relative">
                            <div class="absolute right-0 top-0 mt-8 mr-8">
                                <span @class([
                                    'px-5 py-2 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] border',
                                    'bg-red-50 text-red-600 border-red-100 dark:bg-red-900/30' => $registration->payment_remaining > 0,
                                    'bg-emerald-50 text-emerald-600 border-emerald-100 dark:bg-emerald-900/30' => $registration->payment_remaining <= 0,
                                ])>
                                    {{ $registration->payment_remaining > 0 ? 'Belum Lunas' : 'Sudah Lunas' }}
                                </span>
                            </div>

                            <div class="mb-10">
                                <h3 class="text-3xl font-black text-slate-800 dark:text-white tracking-tighter mb-2">Biaya Masuk (Uang Pangkal)</h3>
                                <p class="text-slate-400 font-bold uppercase tracking-[0.3em] text-[10px]">Tingkat {{ $registration->education_level }} ({{ $registration->gender == 'L' ? 'Putra' : 'Putri' }})</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                                <div class="bg-slate-50 dark:bg-slate-800/50 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-700/50">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Total Tagihan</p>
                                    <p class="text-2xl font-black text-slate-800 dark:text-white">Rp {{ number_format($registration->total_required, 0, ',', '.') }}</p>
                                </div>
                                <div class="bg-emerald-50 dark:bg-emerald-900/10 p-6 rounded-[2rem] border border-emerald-100 dark:border-emerald-800/50">
                                    <p class="text-[9px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-widest mb-2">Terbayar (Verified)</p>
                                    <p class="text-2xl font-black text-emerald-600 dark:text-emerald-400">Rp {{ number_format($registration->total_paid, 0, ',', '.') }}</p>
                                </div>
                                <div class="bg-red-50 dark:bg-red-900/10 p-6 rounded-[2rem] border border-red-100 dark:border-red-800/50">
                                    <p class="text-[9px] font-black text-red-600 dark:text-red-400 uppercase tracking-widest mb-2">Sisa Tagihan</p>
                                    <p class="text-2xl font-black text-red-600 dark:text-red-400">Rp {{ number_format($registration->payment_remaining, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div class="mb-12">
                                <div class="flex justify-between items-end mb-4">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Progress Pembayaran</p>
                                    <p class="text-sm font-black text-emerald-500">{{ $registration->payment_progress }}%</p>
                                </div>
                                <div class="h-4 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden flex">
                                    <div class="h-full bg-emerald-500 rounded-full shadow-[0_0_20px_rgba(16,185,129,0.5)] transition-all duration-1000" style="width: {{ $registration->payment_progress }}%"></div>
                                </div>
                                <p class="mt-4 text-[10px] text-slate-500 dark:text-slate-400 italic">Harap melunasi seluruh biaya masuk sebelum batas akhir pendaftaran untuk mendapatkan akses Cetak Kartu Pelajar.</p>
                            </div>

                            <!-- Payment Form & Tabs -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                                <!-- LEFT: INSTALLMENT HISTORY -->
                                <div>
                                    <h4 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                                        <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Cicilan
                                    </h4>
                                    <div class="space-y-4 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                                        @forelse($registration->payments()->latest()->get() as $p)
                                        <div class="p-4 rounded-2xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 flex items-center justify-between group hover:border-emerald-500/50 transition-all">
                                            <div class="flex items-center gap-4">
                                                <a href="{{ $p->receipt_url }}" target="_blank" class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-lg hover:bg-emerald-500 hover:text-white transition-colors">📸</a>
                                                <div>
                                                    <p class="text-sm font-black text-slate-800 dark:text-white">{{ $p->amount_formatted }}</p>
                                                    <p class="text-[8px] font-bold text-slate-400 uppercase">{{ $p->created_at->format('d M Y, H:i') }}</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                @if($p->status == 'pending')
                                                    <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[8px] font-black uppercase rounded-lg">⏳ Pending</span>
                                                @elseif($p->status == 'verified')
                                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[8px] font-black uppercase rounded-lg">✅ Verified</span>
                                                @else
                                                    <span class="px-3 py-1 bg-red-50 text-red-600 text-[8px] font-black uppercase rounded-lg">❌ Ditolak</span>
                                                @endif
                                            </div>
                                        </div>
                                        @empty
                                        <div class="py-12 text-center text-slate-400 italic text-[10px] uppercase font-bold tracking-widest border-2 border-dashed border-slate-100 dark:border-slate-800 rounded-3xl">
                                            Belum ada cicilan
                                        </div>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- RIGHT: UPLOAD NEW -->
                                @if($registration->payment_remaining > 0)
                                <div class="bg-slate-900 rounded-[2rem] p-8 text-white">
                                    <h4 class="text-lg font-black uppercase mb-6 flex items-center gap-3">
                                        <span class="w-8 h-8 bg-emerald-500 text-white rounded-full flex items-center justify-center text-xs">💰</span>
                                        Bayar Cicilan Baru
                                    </h4>
                                    <form action="{{ route('ppdb.installment.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="space-y-6">
                                            <div>
                                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Nominal Transfer (Rp)</label>
                                                <input type="number" name="amount" required min="1" placeholder="Contoh: 1000000" class="w-full bg-white/5 border-white/10 rounded-2xl px-6 py-4 text-white font-bold text-sm focus:ring-emerald-500 placeholder:text-slate-600">
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Bukti Transfer (Gambar)</label>
                                                <input type="file" name="payment_receipt" required class="w-full px-5 py-4 border-2 border-dashed border-white/10 rounded-2xl text-xs file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-emerald-500 file:text-white hover:border-emerald-500 transition-colors">
                                            </div>
                                            <button type="submit" class="w-full py-5 bg-emerald-500 text-white font-black uppercase tracking-[0.2em] text-xs rounded-2xl hover:bg-emerald-600 transition shadow-xl shadow-emerald-500/20">Unggah & Verifikasi Cicilan &rarr;</button>
                                        </div>
                                    </form>
                                    <div class="mt-6 p-4 bg-white/5 rounded-2xl border border-white/10">
                                        <p class="text-[8px] text-slate-400 leading-relaxed font-medium">Bisa cicil berapapun sesuai kemampuan Anda via BNI/Transfer Bank, yang terpenting sisa tagihan harus <strong>NOL</strong> sebelum keputusan kelulusan dikeluarkan.</p>
                                    </div>
                                </div>
                                @else
                                <div class="bg-emerald-500/10 rounded-[2rem] p-10 border border-emerald-500/20 text-center">
                                    <div class="text-5xl mb-6 text-emerald-500">🏆</div>
                                    <h4 class="text-2xl font-black text-emerald-600 dark:text-emerald-400 mb-2">Tagihan Lunas!</h4>
                                    <p class="text-slate-500 font-medium">Seluruh biaya masuk telah terpenuhi. Anda tinggal menunggu hasil ujian/seleksi.</p>
                                </div>
                                @endif
                            </div>

                            <!-- BOTTOM: DETAILED BREAKDOWN (ACCORDION STYLE) -->
                            <div class="mt-12 pt-8 border-t border-slate-100 dark:border-slate-800">
                                <details class="group">
                                    <summary class="flex justify-between items-center cursor-pointer list-none py-4 px-6 rounded-2xl bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 transition-colors">
                                        <span class="text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-widest flex items-center gap-3">
                                            <i class="fa-solid fa-list-check"></i> Lihat Rincian Unit Biaya Masuk
                                        </span>
                                        <span class="group-open:rotate-180 transition-transform">▼</span>
                                    </summary>
                                    <div class="mt-4 px-6 py-8 bg-white dark:bg-slate-800/20 rounded-3xl border border-slate-100 dark:border-slate-800">
                                        <table class="w-full">
                                            <thead class="border-b border-slate-100 dark:border-slate-800">
                                                <tr>
                                                    <th class="text-left py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Kategori Biaya</th>
                                                    <th class="text-right py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Nominal</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-slate-50 dark:divide-slate-800/50">
                                                @foreach($registration->fee_breakdown as $item)
                                                <tr>
                                                    <td class="py-4 text-xs font-bold text-slate-600 dark:text-slate-400">{{ $item['name'] }}</td>
                                                    <td class="py-4 text-xs font-black text-slate-800 dark:text-white text-right">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="border-t-2 border-slate-900 dark:border-emerald-500/50">
                                                    <td class="py-6 text-sm font-black text-slate-900 dark:text-white uppercase tracking-widest">Total Keseluruhan</td>
                                                    <td class="py-6 text-sm font-black text-emerald-600 dark:text-emerald-400 text-right">Rp {{ number_format($registration->total_required, 0, ',', '.') }}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </details>
                            </div>
                        </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="bg-white dark:bg-dark-card rounded-[2rem] shadow-xl border border-slate-100 dark:border-slate-800 p-8">
                                <h3 class="text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-6 flex items-center gap-3">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Detail Santri
                                </h3>
                                <dl class="space-y-4">
                                    <div class="flex justify-between items-center border-b border-slate-50 dark:border-slate-800/50 pb-3 h-10">
                                        <dt class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Nama Lengkap</dt>
                                        <dd class="text-sm font-bold text-slate-800 dark:text-white truncate max-w-[150px]">{{ $registration->full_name }}</dd>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-slate-50 dark:border-slate-800/50 pb-3 h-10">
                                        <dt class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Tempat, Tgl Lahir</dt>
                                        <dd class="text-sm font-bold text-slate-800 dark:text-white">{{ $registration->birth_place ?? '-' }}, {{ $registration->birth_date ? $registration->birth_date->format('d M Y') : '-' }}</dd>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-slate-50 dark:border-slate-800/50 pb-3 h-10">
                                        <dt class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Asal Sekolah</dt>
                                        <dd class="text-sm font-bold text-slate-800 dark:text-white">{{ $registration->origin_school ?? '-' }}</dd>
                                    </div>
                                </dl>
                            </div>

                            <div class="bg-white dark:bg-dark-card rounded-[2rem] shadow-xl border border-slate-100 dark:border-slate-800 p-8">
                                <h3 class="text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-6 flex items-center gap-3">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Dokumen Terlampir
                                </h3>
                                <div class="grid grid-cols-4 gap-2">
                                    @php
                                        $checkDocs = [
                                            ['icon' => '📸', 'url' => $registration->photo_url],
                                            ['icon' => '🎓', 'url' => $registration->ijazah_url],
                                            ['icon' => '👨‍👩‍👧', 'url' => $registration->family_card_url],
                                            ['icon' => '📄', 'url' => $registration->birth_cert_url],
                                        ];
                                    @endphp
                                    @foreach($checkDocs as $doc)
                                        <div class="aspect-square rounded-xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-xl relative {{ $doc['url'] ? 'border border-emerald-500/20' : 'opacity-20' }}">
                                            {{ $doc['icon'] }}
                                            @if($doc['url'])
                                                <div class="absolute -right-1 -top-1 w-4 h-4 bg-emerald-500 rounded-full flex items-center justify-center text-[8px] text-white">✓</div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <p class="mt-6 text-[10px] text-slate-500 dark:text-slate-400 font-medium italic">Seluruh berkas fisik wajib dibawa saat daftar ulang.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
            </div>
        </div>
    </div>
</x-app-layout>
