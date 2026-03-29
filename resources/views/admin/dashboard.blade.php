<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wide mb-2">Total Pendaftar</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['total_pendaftar'] }}</div>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center border-b-4 border-yellow-400">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wide mb-2">Pending</div>
                        <div class="text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $stats['pending'] }}</div>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center border-b-4 border-blue-400">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wide mb-2">Terverifikasi</div>
                        <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['verified'] }}</div>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center border-b-4 border-green-400">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wide mb-2">Diterima</div>
                        <div class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $stats['accepted'] }}</div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center border-b-4 border-indigo-400">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wide mb-2">Total Berita</div>
                        <div class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $stats['total_berita'] }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 font-bold">
                    Pendaftar Terbaru
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama & Asal Sekolah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-800">
                            @forelse($recent_registrations as $reg)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $reg->full_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $reg->origin_school }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $reg->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($reg->status == 'pending')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                    @elseif($reg->status == 'verified')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Verified</span>
                                    @elseif($reg->status == 'accepted')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Accepted</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ ucfirst($reg->status) }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.registrations.show', $reg) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Review</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada pendaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('admin.registrations.index') }}" class="text-indigo-600 dark:text-indigo-400 text-sm font-semibold hover:underline">Lihat Semua Pendaftar &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
