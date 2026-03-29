<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Review Pendaftar') }} #{{ str_pad($registration->id, 5, '0', STR_PAD_LEFT) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('admin.registrations.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 flex items-center">
                    &larr; Kembali ke daftar
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Detail Info -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-bold border-b border-gray-200 dark:border-gray-700 pb-2 mb-4 text-indigo-600 dark:text-indigo-400">Biodata Calon Siswa</h3>
                            
                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-4 mb-8">
                                <div class="col-span-2 sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Lengkap</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white font-semibold">{{ $registration->full_name }}</dd>
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tempat, Tanggal Lahir</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white font-semibold">{{ $registration->birth_place }}, {{ $registration->birth_date->format('d M Y') }}</dd>
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Jenis Kelamin</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white font-semibold">{{ $registration->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Agama</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white font-semibold">{{ $registration->religion }}</dd>
                                </div>
                                <div class="col-span-2">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Alamat Lengkap</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white font-semibold">{{ $registration->address }}</dd>
                                </div>
                            </dl>

                            <h3 class="text-lg font-bold border-b border-gray-200 dark:border-gray-700 pb-2 mb-4 text-indigo-600 dark:text-indigo-400">Data Asal Sekolah</h3>
                            
                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-4">
                                <div class="col-span-2">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Sekolah</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white font-semibold">{{ $registration->origin_school }}</dd>
                                </div>
                                <div class="col-span-2">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Alamat Sekolah</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white font-semibold">{{ $registration->origin_school_address }}</dd>
                                </div>
                                <div class="col-span-2">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tahun Lulus</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white font-semibold">{{ $registration->graduation_year }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Update Status Form -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg sticky top-6">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-bold border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">Verifikasi & Status</h3>
                            
                            <form action="{{ route('admin.registrations.update', $registration) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-4">
                                    <x-input-label for="status" :value="__('Status Pendaftaran')" />
                                    <select id="status" name="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                        <option value="draft" {{ $registration->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="pending" {{ $registration->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                                        <option value="verified" {{ $registration->status == 'verified' ? 'selected' : '' }}>Data Terverifikasi (Valid)</option>
                                        <option value="accepted" {{ $registration->status == 'accepted' ? 'selected' : '' }}>Diterima (Lulus)</option>
                                        <option value="rejected" {{ $registration->status == 'rejected' ? 'selected' : '' }}>Ditolak (Gagal)</option>
                                    </select>
                                </div>

                                <div class="mb-6">
                                    <x-input-label for="notes" :value="__('Catatan Panitia')" />
                                    <textarea id="notes" name="notes" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Catatan untuk dilihat peserta (contoh: berkas tidak lengkap)...">{{ $registration->notes }}</textarea>
                                </div>

                                <div class="flex items-center justify-end">
                                    <x-primary-button class="w-full justify-center py-3">
                                        {{ __('Update Status & Catatan') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
