@extends('layouts.app')

@section('title', $post->title)

@section('content')
<!-- Header -->
<div class="bg-brand-cream dark:bg-[#0a0a0a] py-16 sm:py-24 border-b border-brand-cream dark:border-gray-900 transition-colors duration-300">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="javascript:history.back()" class="inline-flex items-center text-brand-deep dark:text-gray-400 hover:text-brand-sage dark:hover:text-white font-medium mb-8 transition-colors">
            <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
        
        <div class="flex items-center text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4 transition-colors">
            <span class="text-brand-deep dark:text-gray-300">{{ $post->type }}</span>
            <span class="mx-2">&bull;</span>
            <time datetime="{{ $post->published_at ? $post->published_at->toIso8601String() : '' }}">
                {{ $post->published_at ? $post->published_at->format('d F Y') : 'Draft' }}
            </time>
        </div>
        
        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl md:text-5xl transition-colors duration-300">
            {{ $post->title }}
        </h1>
    </div>
</div>

<!-- Content -->
<article class="py-16 bg-white dark:bg-black transition-colors duration-300 border-b border-gray-100 dark:border-gray-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($post->image_url)
            <figure class="mb-12 rounded-2xl overflow-hidden shadow-lg dark:shadow-white/5 border border-gray-100 dark:border-gray-800">
                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-auto object-cover max-h-96">
            </figure>
        @endif
        
        <div class="prose prose-lg dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 transition-colors duration-300">
            {!! $post->content !!}
        </div>
    </div>
</article>
@endsection
