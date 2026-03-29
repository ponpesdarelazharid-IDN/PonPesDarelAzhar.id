<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:berita,acara,prestasi,ekstrakurikuler',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);

        $post = new Post($validated);
        $post->slug = Str::slug($request->title) . '-' . uniqid();
        $post->user_id = auth()->id();
        
        if ($request->status == 'published') {
            $post->published_at = now();
        }

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Berita/Acara berhasil ditambahkan!');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:berita,acara,prestasi,ekstrakurikuler',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        $post->fill($validated);
        if ($post->isDirty('title')) {
            $post->slug = Str::slug($request->title) . '-' . uniqid();
        }

        if ($request->status == 'published' && !$post->published_at) {
            $post->published_at = now();
        } elseif ($request->status == 'draft') {
            $post->published_at = null;
        }

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Berita/Acara berhasil diperbarui!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Postingan berhasil dihapus!');
    }
}
