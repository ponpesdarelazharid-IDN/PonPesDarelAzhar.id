<x-app-layout>
    <div class="py-12 bg-slate-50 dark:bg-[#0a0a0a] min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-8 p-5 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 flex items-center gap-4 animate-bounce">
                    <span class="text-2xl">🎉</span>
                    <p class="font-bold tracking-tight">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-8 p-5 rounded-2xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-300 flex items-center gap-4">
                    <span class="text-2xl">⚠️</span>
                    <p class="font-bold tracking-tight">{{ session('error') }}</p>
                </div>
            @endif

            @if(!$registration)
                <!-- State: No Registration -->
                <div class="bg-white dark:bg-[#111] rounded-[2.5rem] shadow-2xl border border-slate-100 dark:border-gray-900 overflow-hidden">
                    <div class="p-12 text-center">
                        <div class="w-24 h-24 bg-indigo-50 dark:bg-indigo-900/20 rounded-full flex items-center justify-center mx-auto mb-8">
                            <span class="text-5xl">📄</span>
                        </div>
                        <h2 class="text-3xl font-black text-[#1e293b] dark:text-white mb-4">Mari Mulai Pendaftaran</h2>
                        <p class="text-slate-500 dark:text-gray-400 mb-10 max-w-sm mx-auto leading-relaxed">
                            Formulir pendaftaran PPDB sudah dibuka. Silakan lengkapi biodata dan berkas Anda sekarang.
                        </p>
                        <a href="{{ route('ppdb.register') }}" class="inline-flex items-center px-10 py-5 bg-[#1e293b] dark:bg-white text-white dark:text-black font-black uppercase tracking-widest rounded-2xl hover:scale-105 active:scale-95 transition-all shadow-xl">
                            Isi Formulir 🚀
                        </a>
                    </div>
                </div>
            @else
                <!-- State: Registration Exists -->
                <div class="space-y-8">
                    <!-- Status Header Card -->
                    <div class="bg-white dark:bg-[#111] rounded-[2.5rem] shadow-2xl border border-slate-100 dark:border-gray-900 p-8 md:p-12">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                            <div class="flex items-center gap-6">
                                <div class="w-20 h-20 rounded-3xl bg-indigo-50 dark:bg-indigo-900/20 flex items-center justify-center text-3xl">
                                    {{ $registration->status == 'accepted' ? '🎊' : ($registration->status == 'rejected' ? '😔' : '⏳') }}
                                </div>
                                <div>
                                    <h2 class="text-3xl font-black text-[#1e293b] dark:text-white tracking-tight">Status Pendaftaran</h2>
                                    <p class="text-slate-500 dark:text-gray-400 font-bold uppercase tracking-[0.2em] text-xs">ID: #{{ $registration->registration_number ?? str_pad($registration->id, 5, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                            
                            <div class="text-center md:text-right">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 border-amber-200 dark:border-amber-800',
                                        'verified' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 border-blue-200 dark:border-blue-800',
                                        'accepted' => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 border-emerald-200 dark:border-emerald-800',
                                        'rejected' => 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 border-red-200 dark:border-red-800',
                                        'draft' => 'bg-slate-100 dark:bg-gray-800 text-slate-600 dark:text-gray-400 border-slate-200 dark:border-gray-700',
                                    ];
                                    $statusText = [
                                        'pending' => 'Menunggu Verifikasi',
                                        'verified' => 'Terverifikasi',
                                        'accepted' => 'Diterima',
                                        'rejected' => 'Ditolak',
                                        'draft' => 'Draf (Belum Dikirim)',
                                    ];
                                @endphp
                                <span class="px-8 py-4 inline-flex text-sm leading-5 font-black rounded-2xl border {{ $statusClasses[$registration->status] ?? $statusClasses['draft'] }} uppercase tracking-widest shadow-sm">
                                    {{ $statusText[$registration->status] ?? 'Unknown' }}
                                </span>
                            </div>
                        </div>

                        <!-- Progress Step Message -->
                        <div class="mt-12 p-8 rounded-[2rem] bg-slate-50 dark:bg-gray-900/50 border border-slate-100 dark:border-gray-800/50">
                            @if($registration->status == 'pending')
                                <h4 class="text-xl font-bold text-[#1e293b] dark:text-white mb-2">Terima kasih, {{ explode(' ', $registration->full_name)[0] }}!</h4>
                                <p class="text-slate-500 dark:text-gray-400 leading-relaxed">Data Anda telah kami terima dan sedang dalam proses peninjauan oleh tim panitia PPDB. Kami akan mengabari Anda melalui email segera setelah ada perkembangan.</p>
                            @elseif($registration->status == 'draft')
                                <h4 class="text-xl font-bold text-[#1e293b] dark:text-white mb-2">Pendaftaran Belum Lengkap!</h4>
                                <p class="text-slate-500 dark:text-gray-400 mb-6 leading-relaxed">Anda belum menyelesaikan seluruh tahapan pendaftaran. Silakan lanjutkan pengisian formulir.</p>
                                <a href="{{ route('ppdb.register') }}" class="inline-flex items-center text-sm font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-widest hover:underline">Lanjutkan Sekarang →</a>
                            @elseif($registration->status == 'accepted')
                                <h4 class="text-xl font-bold text-emerald-600 dark:text-emerald-400 mb-2">Selamat! Anda Diterima</h4>
                                <p class="text-slate-500 dark:text-gray-400 mb-6 leading-relaxed">Selamat bergabung di keluarga besar {{ config('app.name') }}. Silakan periksa email Anda atau hubungi panitia untuk proses daftar ulang.</p>
                                <a href="{{ route('ppdb.register.card') }}" target="_blank" class="inline-flex items-center px-8 py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-black uppercase tracking-widest rounded-2xl transition-all shadow-lg shadow-emerald-500/25 gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                    Cetak Kartu Pelajar 🖨️
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Details Accordion / Summary Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Card: Biodata -->
                        <div class="bg-white dark:bg-[#111] rounded-[2rem] shadow-xl border border-slate-100 dark:border-gray-900 p-8">
                            <h3 class="text-lg font-black text-[#1e293b] dark:text-white uppercase tracking-widest mb-6 flex items-center gap-3">
                                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                                Informasi Santri
                            </h3>
                            <dl class="space-y-4">
                                <div class="flex justify-between items-center border-b border-slate-50 dark:border-gray-800 pb-3">
                                    <dt class="text-xs font-bold text-slate-400 dark:text-gray-500 uppercase tracking-widest">Nama Lengkap</dt>
                                    <dd class="text-sm font-bold text-slate-800 dark:text-white text-right">{{ $registration->full_name }}</dd>
                                </div>
                                <div class="flex justify-between items-center border-b border-slate-50 dark:border-gray-800 pb-3">
                                    <dt class="text-xs font-bold text-slate-400 dark:text-gray-500 uppercase tracking-widest">Tempat, Tgl Lahir</dt>
                                    <dd class="text-sm font-bold text-slate-800 dark:text-white text-right">{{ $registration->birth_place }}, {{ $registration->birth_date->format('d M Y') }}</dd>
                                </div>
                                <div class="flex justify-between items-center border-b border-slate-50 dark:border-gray-800 pb-3">
                                    <dt class="text-xs font-bold text-slate-400 dark:text-gray-500 uppercase tracking-widest">Jenis Kelamin</dt>
                                    <dd class="text-sm font-bold text-slate-800 dark:text-white text-right">{{ $registration->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
                                </div>
                                <div class="flex flex-col border-b border-slate-50 dark:border-gray-800 pb-3">
                                    <dt class="text-xs font-bold text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-1">Alamat</dt>
                                    <dd class="text-sm font-bold text-slate-800 dark:text-white leading-relaxed">{{ $registration->address }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Card: Education -->
                        <div class="bg-white dark:bg-[#111] rounded-[2rem] shadow-xl border border-slate-100 dark:border-gray-900 p-8">
                            <h3 class="text-lg font-black text-[#1e293b] dark:text-white uppercase tracking-widest mb-6 flex items-center gap-3">
                                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                                Informasi Sekolah
                            </h3>
                            <dl class="space-y-4">
                                <div class="flex justify-between items-center border-b border-slate-50 dark:border-gray-800 pb-3">
                                    <dt class="text-xs font-bold text-slate-400 dark:text-gray-500 uppercase tracking-widest">Asal Sekolah</dt>
                                    <dd class="text-sm font-bold text-slate-800 dark:text-white text-right">{{ $registration->origin_school }}</dd>
                                </div>
                                <div class="flex justify-between items-center border-b border-slate-50 dark:border-gray-800 pb-3">
                                    <dt class="text-xs font-bold text-slate-400 dark:text-gray-500 uppercase tracking-widest">Tahun Lulus</dt>
                                    <dd class="text-sm font-bold text-slate-800 dark:text-white text-right">{{ $registration->graduation_year }}</dd>
                                </div>
                                <div class="flex justify-between items-center border-b border-slate-50 dark:border-gray-800 pb-3">
                                    <dt class="text-xs font-bold text-slate-400 dark:text-gray-500 uppercase tracking-widest">Orang Tua/Wali</dt>
                                    <dd class="text-sm font-bold text-slate-800 dark:text-white text-right">{{ $registration->father_name }}</dd>
                                </div>
                                <div class="flex flex-col border-b border-slate-50 dark:border-gray-800 pb-3">
                                    <dt class="text-xs font-bold text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-1">Alamat Sekolah</dt>
                                    <dd class="text-sm font-bold text-slate-800 dark:text-white leading-relaxed">{{ $registration->origin_school_address }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Panel Notes -->
                    @if($registration->notes)
                        <div class="mt-8 bg-indigo-600 rounded-[2rem] p-8 md:p-12 text-white shadow-2xl relative overflow-hidden group">
                            <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-3xl transition-transform group-hover:scale-150 duration-700"></div>
                            <div class="relative z-10">
                                <h3 class="text-2xl font-black mb-4 flex items-center gap-3">
                                    <span class="text-3xl">💡</span>
                                    Catatan Panitia
                                </h3>
                                <div class="text-indigo-100 text-lg leading-relaxed font-bold">
                                    {!! nl2br(e($registration->notes)) !!}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
