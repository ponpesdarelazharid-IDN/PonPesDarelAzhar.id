<x-guest-layout>
    <x-slot name="title">VERIFIKASI EMAIL</x-slot>

    <div class="mb-6 text-sm font-bold text-slate-500 dark:text-gray-400 leading-relaxed text-center">
        {{ __('Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik link yang baru saja kami kirimkan. Jika Anda tidak menerima email, kami dengan senang hati akan mengirimkan ulang.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-900/10 border border-emerald-100 dark:border-emerald-900/20 text-xs font-black text-emerald-600 uppercase tracking-widest text-center">
            {{ __('Link verifikasi baru telah dikirimkan ke alamat email yang Anda gunakan saat registrasi.') }}
        </div>
    @endif

    <div class="mt-8 space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full py-5 rounded-2xl bg-[#1e293b] dark:bg-white text-white dark:text-black font-extrabold text-sm uppercase tracking-widest shadow-xl hover:scale-[1.02] active:scale-95 transition-all duration-300">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="text-[10px] font-black text-slate-400 dark:text-gray-600 hover:text-[#1e293b] dark:hover:text-white uppercase tracking-widest transition-colors">
                Keluar (Log Out)
            </button>
        </form>
    </div>
</x-guest-layout>
