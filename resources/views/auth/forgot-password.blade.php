<x-guest-layout>
    <x-slot name="title">LUPA KATA SANDI</x-slot>

    <div class="mb-6 text-sm font-bold text-slate-500 dark:text-gray-400 leading-relaxed text-center">
        {{ __('Lupa kata sandi? Tidak masalah. Beritahu kami alamat email Anda dan kami akan mengirimkan link reset yang memungkinkan Anda memilih kata sandi baru.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-2">Alamat Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus
                class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <button type="submit" class="w-full py-5 rounded-2xl bg-[#1e293b] dark:bg-white text-white dark:text-black font-extrabold text-sm uppercase tracking-widest shadow-xl hover:scale-[1.02] active:scale-95 transition-all duration-300">
                Kirim Link Reset
            </button>
        </div>
        
        <div class="text-center pt-2">
            <a href="{{ route('login') }}" class="text-[10px] font-black text-slate-400 dark:text-gray-600 hover:text-[#1e293b] dark:hover:text-white uppercase tracking-widest transition-colors">
                Kembali ke Login
            </a>
        </div>
    </form>
</x-guest-layout>
