<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
            'image' => 'nullable|image|max:2048',
            'event_date' => 'nullable|date',
            'achievement_by' => 'nullable|in:sekolah,guru,murid',
        ]);

        $post = new Post($validated);
        $post->slug = Str::slug($request->title) . '-' . uniqid();
        $post->user_id = auth()->id();
        
        if ($request->hasFile('image')) {
            $post->image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        }

        if ($request->status == 'published') {
            $post->published_at = now();
        }

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Postingan berhasil ditambahkan!');
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
            'image' => 'nullable|image|max:2048',
            'event_date' => 'nullable|date',
            'achievement_by' => 'nullable|in:sekolah,guru,murid',
        ]);

        $post->fill($validated);
        if ($post->isDirty('title')) {
            $post->slug = Str::slug($request->title) . '-' . uniqid();
        }

        if ($request->hasFile('image')) {
            $post->image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        }

        if ($request->status == 'published' && !$post->published_at) {
            $post->published_at = now();
        } elseif ($request->status == 'draft') {
            $post->published_at = null;
        }

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Postingan berhasil diperbarui!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Postingan berhasil dihapus!');
    }
}
