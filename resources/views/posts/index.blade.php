@extends('layouts.app')

@section('title', $title)

@section('content')
<!-- Header -->
<div class="bg-gray-50 dark:bg-[#0a0a0a] py-16 sm:py-24 border-b border-gray-100 dark:border-gray-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl lg:text-6xl transition-colors duration-300">{{ $title }}</h1>
        <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500 dark:text-gray-400 transition-colors duration-300">Informasi terkini dari sekolah kami.</p>
    </div>
</div>

<!-- Grid -->
<section class="py-16 bg-white dark:bg-black min-h-[50vh] transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            @forelse($posts as $post)
            <a href="{{ route('posts.show', $post) }}" class="group block bg-gray-50 dark:bg-[#0a0a0a] rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-800 hover:shadow-lg dark:hover:shadow-white/10 transition duration-300">
                @if($post->image_url)
                    <div class="aspect-w-16 aspect-h-9 w-full bg-gray-200 dark:bg-gray-800">
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="object-cover w-full h-48 group-hover:scale-105 transition duration-500">
                    </div>
                @else
                    <div class="aspect-w-16 aspect-h-9 w-full bg-gray-200 dark:bg-gray-800 flex items-center justify-center h-48">
                        <span class="text-4xl opacity-50">📰</span>
                    </div>
                @endif
                <div class="p-6">
                    <div class="text-sm text-blue-600 dark:text-gray-400 font-semibold mb-2 transition-colors">{{ $post->published_at->format('d M Y') }}</div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-gray-300 transition-colors">{{ $post->title }}</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm transition-colors">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 80) }}</p>
                </div>
            </a>
            @empty
            <div class="col-span-1 md:col-span-3 text-center py-12">
                <p class="text-gray-500 dark:text-gray-400 transition-colors">Belum ada postingan terbaru.</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-12 flex justify-center">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    </div>
</section>
@endsection
