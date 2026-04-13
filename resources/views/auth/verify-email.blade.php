<x-guest-layout>
    <x-slot name="title">VERIFIKASI EMAIL PSB</x-slot>

    <div class="mb-6 text-sm font-bold text-slate-500 dark:text-gray-400 leading-relaxed text-center">
        {{ __('Terima kasih telah mendaftar akun PSB! Kami telah mengirimkan email berisi kata sandi Anda beserta Kode OTP 6-Digit. Silakan periksa kotak masuk (atau folder spam) email Anda dan segera masukkan kode OTP tersebut di bawah ini.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-900/10 border border-emerald-100 dark:border-emerald-900/20 text-xs font-black text-emerald-600 uppercase tracking-widest text-center">
            {{ __('Sebuah kode verifikasi OTP baru telah dikirimkan ke alamat email Anda.') }}
        </div>
    @endif

    <div class="mt-8 space-y-6">
        <!-- OTP Form -->
        <form method="POST" action="{{ route('verification.verify-otp') }}">
            @csrf
            
            <div>
                <label for="otp_code" class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-2 text-center">Tuliskan 6 Digit Kode OTP</label>
                <input id="otp_code" type="text" name="otp_code" required autofocus autocomplete="off" maxlength="6"
                    class="w-full px-5 py-4 text-center text-3xl tracking-[0.5em] font-mono rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">
                <x-input-error :messages="$errors->get('otp_code')" class="mt-2 text-center" />
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full py-5 rounded-2xl bg-[#1e293b] dark:bg-emerald-500 text-white dark:text-gray-900 font-extrabold text-sm uppercase tracking-widest shadow-xl hover:scale-[1.02] active:scale-95 transition-all duration-300">
                    Selesaikan Verifikasi
                </button>
            </div>
        </form>

        <!-- Resend OTP -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full py-4 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-bold text-xs uppercase tracking-widest hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                Belum Meringa Email? Kirim Ulang OTP
            </button>
        </form>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="text-center pt-2">
            @csrf
            <button type="submit" class="text-[10px] font-black text-slate-400 dark:text-gray-600 hover:text-[#1e293b] dark:hover:text-white uppercase tracking-widest transition-colors mb-2">
                Batalkan &amp; Keluar (Log Out)
            </button>
        </form>
    </div>
</x-guest-layout>
