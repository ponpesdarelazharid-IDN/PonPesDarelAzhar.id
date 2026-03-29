<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pengaturan PPDB') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold border-b border-gray-200 dark:border-gray-700 pb-2 mb-4 text-indigo-600 dark:text-indigo-400">Buka Gelombang Baru</h3>
                    <form action="{{ route('admin.ppdb-settings.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-input-label for="academic_year" :value="__('Tahun Ajaran')" />
                                <x-text-input id="academic_year" class="block mt-1 w-full" type="text" name="academic_year" placeholder="Contoh: 2024/2025" required />
                            </div>
                            
                            <div>
                                <x-input-label for="quota" :value="__('Kuota Siswa (Opsional)')" />
                                <x-text-input id="quota" class="block mt-1 w-full" type="number" name="quota" min="1" />
                            </div>

                            <div>
                                <x-input-label for="open_date" :value="__('Tanggal Buka')" />
                                <x-text-input id="open_date" class="block mt-1 w-full" type="date" name="open_date" required />
                            </div>

                            <div>
                                <x-input-label for="close_date" :value="__('Tanggal Tutup')" />
                                <x-text-input id="close_date" class="block mt-1 w-full" type="date" name="close_date" required />
                            </div>
                            
                            <div class="md:col-span-2">
                                <x-input-label for="requirements" :value="__('Persyaratan Pendaftaran')" />
                                <textarea id="requirements" name="requirements" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="1. Fotokopi Kartu Keluarga..."></textarea>
                            </div>
                            
                            <div class="md:col-span-2 mt-4">
                                <label for="is_open" class="inline-flex items-center">
                                    <input id="is_open" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="is_open" value="1" checked>
                                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Langsung Aktifkan Gelombang Ini') }}</span>
                                </label>
                                <p class="text-xs text-red-500 mt-1">*Hanya satu gelombang yang bisa aktif bersamaan.</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <x-primary-button>
                                {{ __('Simpan Pengaturan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 font-bold">
                    Riwayat Gelombang PPDB
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Ajaran</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-800">
                            @forelse($ppdbSettings as $setting)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $setting->academic_year }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $setting->open_date ? $setting->open_date->format('d M Y') : '-' }} - 
                                    {{ $setting->close_date ? $setting->close_date->format('d M Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($setting->is_open)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Non-Aktif</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">Belum ada pengaturan PPDB.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
