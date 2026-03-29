<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Profil Sekolah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.school-profiles.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-input-label for="nama_sekolah" :value="__('Nama Sekolah')" />
                                <x-text-input id="nama_sekolah" class="block mt-1 w-full" type="text" name="nama_sekolah" :value="$profiles['nama_sekolah'] ?? ''" required />
                            </div>
                            
                            <div>
                                <x-input-label for="tlp" :value="__('Nomor Telepon')" />
                                <x-text-input id="tlp" class="block mt-1 w-full" type="text" name="tlp" :value="$profiles['tlp'] ?? ''" required />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email Kontak')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$profiles['email'] ?? ''" required />
                            </div>
                            
                            <div class="md:col-span-2">
                                <x-input-label for="alamat" :value="__('Alamat Sekolah')" />
                                <textarea id="alamat" name="alamat" rows="2" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ $profiles['alamat'] ?? '' }}</textarea>
                            </div>
                        </div>

                        <div class="mb-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h3 class="text-lg font-bold pb-2 mb-4 text-indigo-600 dark:text-indigo-400">Visi & Misi</h3>
                            
                            <div class="mb-4">
                                <x-input-label for="visi" :value="__('Visi Sekolah')" />
                                <textarea id="visi" name="visi" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ $profiles['visi'] ?? '' }}</textarea>
                            </div>

                            <div class="mb-4">
                                <x-input-label for="misi_singkat" :value="__('Misi Singkat (Untuk Footer)')" />
                                <x-text-input id="misi_singkat" class="block mt-1 w-full" type="text" name="misi_singkat" :value="$profiles['misi_singkat'] ?? ''" />
                            </div>
                        </div>

                        <div class="mb-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h3 class="text-lg font-bold pb-2 mb-4 text-indigo-600 dark:text-indigo-400">Sejarah & Tujuan</h3>
                            
                            <div class="mb-4">
                                <x-input-label for="sejarah" :value="__('Sejarah Singkat')" />
                                <textarea id="sejarah" name="sejarah" rows="5" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ $profiles['sejarah'] ?? '' }}</textarea>
                            </div>

                            <div class="mb-4">
                                <x-input-label for="tujuan" :value="__('Tujuan Sekolah')" />
                                <textarea id="tujuan" name="tujuan" rows="5" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ $profiles['tujuan'] ?? '' }}</textarea>
                            </div>
                        </div>

                        <div class="mb-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h3 class="text-lg font-bold pb-2 mb-4 text-indigo-600 dark:text-indigo-400">Lokasi & Google Maps</h3>
                            
                            <div class="mb-4">
                                <x-input-label for="google_maps_url" :value="__('Link Google Maps (Share Link)')" />
                                <x-text-input id="google_maps_url" class="block mt-1 w-full" type="text" name="google_maps_url" :value="$profiles['google_maps_url'] ?? ''" placeholder="https://www.google.com/maps/place/..." />
                                <p class="text-sm text-gray-500 mt-1">Gunakan link ini untuk tombol 'Buka di Maps'.</p>
                            </div>

                            <div class="mb-4">
                                <x-input-label for="google_maps_embed" :value="__('Maps Embed URL (src iframe)')" />
                                <textarea id="google_maps_embed" name="google_maps_embed" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="https://www.google.com/maps/embed?pb=...">{{ $profiles['google_maps_embed'] ?? '' }}</textarea>
                                <p class="text-sm text-gray-500 mt-1">Hanya masukkan bagian <code>src="..."</code> dari kode embed Google Maps.</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <x-primary-button class="ml-4 py-3 px-6">
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
