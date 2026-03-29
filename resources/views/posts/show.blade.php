@extends('layouts.public')

@section('title', $post->title)

@section('content')
<div class="hero" style="min-height: 40vh; align-items: flex-end; padding-bottom: 4rem;">
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        <a href="javascript:history.back()" style="color: var(--primary); text-decoration: none; display: inline-block; margin-bottom: 2rem; font-weight: 600;">&larr; Kembali</a>
        
        <div class="news-meta" style="font-size: 1rem; margin-bottom: 1rem;">
            {{ $post->published_at ? $post->published_at->format('d F Y') : 'Draft' }} 
            &bull; <span style="text-transform: uppercase; letter-spacing: 1px;">{{ $post->type }}</span>
        </div>
        
        <h1 style="font-size: 3rem; margin-bottom: 2rem; color: white;">{{ $post->title }}</h1>
    </div>
</div>

<section class="section section-alt" style="padding-top: 2rem;">
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        @if($post->image_url)
            <img src="{{ $post->image_url }}" alt="{{ $post->title }}" style="width: 100%; border-radius: 16px; margin-bottom: 3rem; border: 1px solid var(--glass-border); box-shadow: 0 20px 40px rgba(0,0,0,0.3);">
        @endif
        
        <div style="font-size: 1.125rem; line-height: 1.8; color: var(--gray-light);">
            {!! $post->content !!}
        </div>
    </div>
</section>
@endsection
