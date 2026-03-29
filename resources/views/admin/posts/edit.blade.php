<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Berita/Acara') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('admin.posts.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 flex items-center">
                    &larr; Kembali
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-2">
                                <div class="mb-4">
                                    <x-input-label for="title" :value="__('Judul Postingan')" />
                                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $post->title)" required autofocus />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="excerpt" :value="__('Ringkasan Singkat (Opsional)')" />
                                    <textarea id="excerpt" name="excerpt" rows="2" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('excerpt', $post->excerpt) }}</textarea>
                                    <x-input-error :messages="$errors->get('excerpt')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="content" :value="__('Konten')" />
                                    <textarea id="content" name="content" rows="15" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('content', $post->content) }}</textarea>
                                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                </div>
                            </div>
                            
                            <div class="md:col-span-1 border-l border-gray-200 dark:border-gray-700 md:pl-6 space-y-6">
                                <div>
                                    <x-input-label for="type" :value="__('Kategori')" />
                                    <select id="type" name="type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                        <option value="berita" {{ old('type', $post->type) == 'berita' ? 'selected' : '' }}>Berita</option>
                                        <option value="acara" {{ old('type', $post->type) == 'acara' ? 'selected' : '' }}>Agenda / Acara</option>
                                        <option value="prestasi" {{ old('type', $post->type) == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                                        <option value="ekstrakurikuler" {{ old('type', $post->type) == 'ekstrakurikuler' ? 'selected' : '' }}>Ekstrakurikuler / Kegiatan</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="status" :value="__('Status Publikasi')" />
                                    <select id="status" name="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                        <option value="draft" {{ old('status', $post->published_at ? 'published' : 'draft') == 'draft' ? 'selected' : '' }}>Draft (Simpan sementara)</option>
                                        <option value="published" {{ old('status', $post->published_at ? 'published' : 'draft') == 'published' ? 'selected' : '' }}>Published (Terbitkan!)</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </div>
                                
                                <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                                    <x-primary-button class="w-full justify-center py-3">
                                        {{ __('Simpan Perubahan') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
