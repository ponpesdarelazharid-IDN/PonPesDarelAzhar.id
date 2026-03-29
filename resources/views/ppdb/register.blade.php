<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulir Pendaftaran PPDB') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold mb-1">Pendaftaran Terbuka</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Tahun Ajaran: {{ $ppdb->academic_year }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('ppdb.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <h4 class="font-semibold text-lg border-b border-gray-200 dark:border-gray-700 pb-2 mb-6 text-indigo-600 dark:text-indigo-400">A. Biodata Calon Siswa</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-input-label for="full_name" :value="__('Nama Lengkap')" />
                                <x-text-input id="full_name" class="block mt-1 w-full" type="text" name="full_name" :value="old('full_name', auth()->user()->name)" required autofocus />
                                <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="gender" :value="__('Jenis Kelamin')" />
                                <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="birth_place" :value="__('Tempat Lahir')" />
                                <x-text-input id="birth_place" class="block mt-1 w-full" type="text" name="birth_place" :value="old('birth_place')" required />
                                <x-input-error :messages="$errors->get('birth_place')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="birth_date" :value="__('Tanggal Lahir')" />
                                <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date')" required />
                                <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="religion" :value="__('Agama')" />
                                <select id="religion" name="religion" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih Agama --</option>
                                    <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('religion') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('religion') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('religion') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('religion') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                                <x-input-error :messages="$errors->get('religion')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-8">
                            <x-input-label for="address" :value="__('Alamat Lengkap (Sesuai KK)')" />
                            <textarea id="address" name="address" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('address') }}</textarea>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>


                        <h4 class="font-semibold text-lg border-b border-gray-200 dark:border-gray-700 pb-2 mb-6 mt-10 text-indigo-600 dark:text-indigo-400">B. Data Asal Sekolah</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-input-label for="origin_school" :value="__('Nama Asal Sekolah (SMP/MTs)')" />
                                <x-text-input id="origin_school" class="block mt-1 w-full" type="text" name="origin_school" :value="old('origin_school')" required />
                                <x-input-error :messages="$errors->get('origin_school')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="graduation_year" :value="__('Tahun Lulus')" />
                                <x-text-input id="graduation_year" class="block mt-1 w-full" type="number" name="graduation_year" :value="old('graduation_year', date('Y'))" required min="2000" max="2100" />
                                <x-input-error :messages="$errors->get('graduation_year')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-8">
                            <x-input-label for="origin_school_address" :value="__('Alamat Asal Sekolah')" />
                            <textarea id="origin_school_address" name="origin_school_address" rows="2" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('origin_school_address') }}</textarea>
                            <x-input-error :messages="$errors->get('origin_school_address')" class="mt-2" />
                        </div>

                        <h4 class="font-semibold text-lg border-b border-gray-200 dark:border-gray-700 pb-2 mb-6 mt-10 text-indigo-600 dark:text-indigo-400">C. Unggah Dokumen (Cloudinary)</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-input-label for="photo" :value="__('Pas Foto (3x4)')" />
                                <input id="photo" name="photo" type="file" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*" required />
                                <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="birth_cert" :value="__('Akta Kelahiran')" />
                                <input id="birth_cert" name="birth_cert" type="file" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*,application/pdf" required />
                                <x-input-error :messages="$errors->get('birth_cert')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="ijazah" :value="__('Ijazah Terakhir')" />
                                <input id="ijazah" name="ijazah" type="file" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*,application/pdf" required />
                                <x-input-error :messages="$errors->get('ijazah')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="skhu" :value="__('SKHU / Surat Keterangan Lulus')" />
                                <input id="skhu" name="skhu" type="file" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*,application/pdf" required />
                                <x-input-error :messages="$errors->get('skhu')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <a href="{{ route('ppdb.landing') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-4">
                                Batal
                            </a>
                            <x-primary-button class="py-3 px-6">
                                {{ __('Kirim Pendaftaran') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
