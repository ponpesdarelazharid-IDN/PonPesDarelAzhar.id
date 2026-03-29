@extends('layouts.public')

@section('title', $title)

@section('content')
<div class="hero" style="min-height: 40vh; align-items: flex-end; padding-bottom: 4rem;">
    <div class="container">
        <h1 class="text-gradient" style="font-size: 3rem; margin-bottom: 0;">{{ $title }}</h1>
        <p style="color: var(--gray); font-size: 1.25rem;">Informasi terkini dari sekolah kami.</p>
    </div>
</div>

<section class="section section-alt" style="min-height: 50vh;">
    <div class="container">
        <div class="grid-3">
            @forelse($posts as $post)
            <div class="news-card">
                @if($post->image_url)
                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="news-img">
                @else
                    <div class="news-img" style="display:flex;align-items:center;justify-content:center;color:var(--gray);font-size:3rem;">📰</div>
                @endif
                <div class="news-content">
                    <div class="news-meta">{{ $post->published_at->format('d M Y') }}</div>
                    <a href="{{ route('posts.show', $post) }}" style="text-decoration:none;color:inherit;">
                        <h3 style="font-size: 1.25rem;">{{ $post->title }}</h3>
                        <p style="color: var(--gray); font-size: 0.95rem;">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 80) }}</p>
                    </a>
                </div>
            </div>
            @empty
            <p style="color:var(--gray);text-align:center;grid-column:1/-1;">Belum ada postingan terbaru.</p>
            @endforelse
        </div>
        
        <div style="margin-top: 3rem; display: flex; justify-content: center;">
            {{ $posts->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>
@endsection
