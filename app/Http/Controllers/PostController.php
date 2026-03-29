<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function berita()
    {
        $posts = Post::where('type', 'berita')->whereNotNull('published_at')->latest()->paginate(9);
        $title = 'Berita Terbaru';
        return view('posts.index', compact('posts', 'title'));
    }

    public function acara()
    {
        $posts = Post::where('type', 'acara')->whereNotNull('published_at')->latest()->paginate(9);
        $title = 'Acara Sekolah';
        return view('posts.index', compact('posts', 'title'));
    }

    public function prestasi()
    {
        $posts = Post::where('type', 'prestasi')->whereNotNull('published_at')->latest()->paginate(9);
        $title = 'Prestasi';
        return view('posts.index', compact('posts', 'title'));
    }

    public function ekstrakurikuler()
    {
        $posts = Post::where('type', 'ekstrakurikuler')->whereNotNull('published_at')->latest()->paginate(9);
        $title = 'Ekstrakurikuler & Kegiatan';
        return view('posts.index', compact('posts', 'title'));
    }

    public function show(Post $post)
    {
        if(!$post->published_at && (!auth()->check() || auth()->user()->role !== 'admin')) {
            abort(404);
        }
        return view('posts.show', compact('post'));
    }
}
