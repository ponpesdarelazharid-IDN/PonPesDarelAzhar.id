<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Status Pendaftaran PPDB') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if(!$registration)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center text-gray-900 dark:text-gray-100">
                        <div class="mb-4">
                            <span class="text-4xl">📄</span>
                        </div>
                        <h3 class="text-lg font-medium">Belum Ada Pendaftaran</h3>
                        <p class="text-gray-500 mt-1 mb-6">Anda belum mengisi formulir pendaftaran PPDB.</p>
                        
                        <a href="{{ route('ppdb.register') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Isi Formulir Pendaftaran
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-4 mb-6">
                            <div>
                                <h3 class="text-xl font-bold">Data Pendaftaran Siswa</h3>
                                <p class="text-gray-500 text-sm">Nomor Pendaftaran: #{{ str_pad($registration->id, 5, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            
                            <div class="mt-4 md:mt-0">
                                @if($registration->status == 'pending')
                                    <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 border-yellow-200">
                                        Menunggu Verifikasi
                                    </span>
                                @elseif($registration->status == 'verified')
                                    <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 border-blue-200">
                                        Data Terverifikasi
                                    </span>
                                @elseif($registration->status == 'accepted')
                                    <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800 border-green-200">
                                        Diterima
                                    </span>
                                @elseif($registration->status == 'rejected')
                                    <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800 border-red-200">
                                        Ditolak
                                    </span>
                                @else
                                    <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 border-gray-200">
                                        Draft
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <h4 class="font-semibold text-indigo-600 dark:text-indigo-400 mb-4 tracking-wide uppercase text-sm">Informasi Siswa</h4>
                                <dl class="space-y-3 text-sm">
                                    <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 pb-2">
                                        <dt class="text-gray-500 dark:text-gray-400">Nama Lengkap</dt>
                                        <dd class="font-medium text-right">{{ $registration->full_name }}</dd>
                                    </div>
                                    <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 pb-2">
                                        <dt class="text-gray-500 dark:text-gray-400">TTL</dt>
                                        <dd class="font-medium text-right">{{ $registration->birth_place }}, {{ $registration->birth_date->format('d M Y') }}</dd>
                                    </div>
                                    <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 pb-2">
                                        <dt class="text-gray-500 dark:text-gray-400">Jenis Kelamin</dt>
                                        <dd class="font-medium text-right">{{ $registration->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
                                    </div>
                                    <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 pb-2">
                                        <dt class="text-gray-500 dark:text-gray-400">Agama</dt>
                                        <dd class="font-medium text-right">{{ $registration->religion }}</dd>
                                    </div>
                                    <div class="flex flex-col border-b border-gray-100 dark:border-gray-700 pb-2">
                                        <dt class="text-gray-500 dark:text-gray-400 mb-1">Alamat</dt>
                                        <dd class="font-medium">{{ $registration->address }}</dd>
                                    </div>
                                </dl>
                            </div>

                            <div>
                                <h4 class="font-semibold text-indigo-600 dark:text-indigo-400 mb-4 tracking-wide uppercase text-sm">Informasi Asal Sekolah</h4>
                                <dl class="space-y-3 text-sm">
                                    <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 pb-2">
                                        <dt class="text-gray-500 dark:text-gray-400">Nama Sekolah</dt>
                                        <dd class="font-medium text-right">{{ $registration->origin_school }}</dd>
                                    </div>
                                    <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 pb-2">
                                        <dt class="text-gray-500 dark:text-gray-400">Tahun Lulus</dt>
                                        <dd class="font-medium text-right">{{ $registration->graduation_year }}</dd>
                                    </div>
                                    <div class="flex flex-col border-b border-gray-100 dark:border-gray-700 pb-2">
                                        <dt class="text-gray-500 dark:text-gray-400 mb-1">Alamat Sekolah</dt>
                                        <dd class="font-medium">{{ $registration->origin_school_address }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                        
                        @if($registration->notes)
                        <div class="mt-8 bg-blue-50 dark:bg-blue-900/30 border-l-4 border-blue-500 p-4 rounded-r-md">
                            <h4 class="font-semibold text-blue-800 dark:text-blue-300 flex items-center mb-2">
                                Catatan Panitia PPDB
                            </h4>
                            <p class="text-blue-700 dark:text-blue-200 text-sm">{!! nl2br(e($registration->notes)) !!}</p>
                        </div>
                        @else
                        <div class="mt-8 bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 p-4 rounded-md text-center text-sm text-gray-500 dark:text-gray-400">
                            Pendaftaran Anda sudah tersimpan di sistem kami. Harap menunggu proses verifikasi oleh panitia.
                        </div>
                        @endif

                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
