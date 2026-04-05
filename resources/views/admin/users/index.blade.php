@extends('layouts.admin')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-3xl font-black text-slate-800 dark:text-white uppercase tracking-tight">
            {{ __('Manajemen Pengguna') }}
        </h2>
        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">
            Kelola akses admin dan pendaftar santri.
        </p>
    </div>
</div>
@endsection

@section('content')
<div class="space-y-8">
    <!-- Feedback Section -->
    @if(session('success'))
        <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl text-emerald-600 dark:text-emerald-400 font-bold text-sm flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 bg-red-500/10 border border-red-500/20 rounded-2xl text-red-600 dark:text-red-400 font-bold text-sm flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Add User Form -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-700/50 sticky top-8">
                <h3 class="text-lg font-black text-slate-800 dark:text-white uppercase tracking-tight mb-6">Tambah Pengguna</h3>
                
                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all">
                        @error('name') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all">
                        @error('email') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Password</label>
                        <input type="password" name="password" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all">
                        @error('password') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Role / Akses</label>
                        <select name="role" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 dark:text-white transition-all">
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Pendaftar (User)</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                        </select>
                        @error('role') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" 
                        class="w-full py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-black uppercase tracking-widest text-[10px] rounded-xl shadow-lg shadow-emerald-500/20 transition-all transform hover:scale-[1.02] active:scale-95">
                        Simpan Pengguna
                    </button>
                </form>
            </div>
        </div>

        <!-- User List Table -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700/50 overflow-hidden">
                <div class="p-6 border-b border-slate-50 dark:border-slate-700/50 flex items-center justify-between">
                    <h3 class="text-lg font-black text-slate-800 dark:text-white uppercase tracking-tight">Daftar Pengguna</h3>
                    <span class="px-3 py-1 bg-slate-100 dark:bg-slate-700 rounded-full text-[10px] font-black text-slate-500 dark:text-slate-300 uppercase tracking-widest">
                        Total: {{ $users->total() }}
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-slate-900/30">
                                <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Pengguna</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Role & Akses</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Terdaftar</th>
                                <th class="px-6 py-4 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-700/50">
                            @foreach($users as $user)
                            <tr class="group hover:bg-slate-50/50 dark:hover:bg-slate-700/20 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-emerald-500/10 flex items-center justify-center text-emerald-500 font-black text-sm uppercase">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-black text-slate-800 dark:text-white tracking-tight">{{ $user->name }}</div>
                                            <div class="text-[11px] text-slate-400 font-medium">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        @if($user->role == 'admin')
                                            <span class="px-2 py-0.5 bg-indigo-500/10 text-indigo-500 text-[9px] font-black uppercase tracking-widest rounded-md border border-indigo-500/20">Admin</span>
                                        @else
                                            <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 text-[9px] font-black uppercase tracking-widest rounded-md border border-slate-200 dark:border-slate-600">User</span>
                                        @endif
                                        
                                        @if($user->email_verified_at)
                                            <span class="px-2 py-0.5 bg-emerald-500/10 text-emerald-500 text-[9px] font-black uppercase tracking-widest rounded-md border border-emerald-500/20">Verified</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-[11px] text-slate-500 dark:text-slate-400 font-bold uppercase tracking-tight">
                                        {{ $user->created_at->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" 
                                            onsubmit="return confirm('Hapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                class="p-2 text-slate-300 hover:text-red-500 transition-colors">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest">Self Account</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($users->hasPages())
                <div class="p-6 border-t border-slate-50 dark:border-slate-700/50">
                    {{ $users->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
