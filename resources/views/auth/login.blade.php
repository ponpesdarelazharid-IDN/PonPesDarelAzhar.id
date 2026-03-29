<x-guest-layout>
    <x-slot name="title">MASUK KE AKUN</x-slot>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-2">Alamat Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-[10px] font-black text-slate-400 dark:text-gray-500 uppercase tracking-widest">Kata Sandi</label>
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-black text-[#1e293b] dark:text-gray-400 hover:underline uppercase tracking-widest" href="{{ route('password.request') }}">
                        Lupa?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-gray-900 border-none focus:ring-2 focus:ring-[#1e293b] dark:focus:ring-white text-slate-900 dark:text-white transition-all shadow-sm font-bold">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="w-5 h-5 rounded-lg border-slate-200 dark:border-gray-800 text-[#1e293b] dark:text-white focus:ring-[#1e293b] dark:bg-gray-900 transition" name="remember">
            <label for="remember_me" class="ms-3 text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest cursor-pointer">Ingat Saya</label>
        </div>

        <div>
            <button type="submit" class="w-full py-5 rounded-2xl bg-[#1e293b] dark:bg-white text-white dark:text-black font-extrabold text-sm uppercase tracking-widest shadow-xl hover:scale-[1.02] active:scale-95 transition-all duration-300">
                Masuk Sekarang
            </button>
        </div>

        <div class="text-center pt-4">
            <p class="text-xs font-bold text-slate-400 dark:text-gray-500 uppercase tracking-widest">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-[#1e293b] dark:text-white hover:underline">Daftar Di Sini</a>
            </p>
        </div>
    </form>
</x-guest-layout>
