<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EkstrakurikulerController extends Controller
{
    public function index()
    {
        $ekskuls = Ekstrakurikuler::latest()->get();
        return view('admin.ekstrakurikuler.index', compact('ekskuls'));
    }

    public function create()
    {
        return view('admin.ekstrakurikuler.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_file' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'description']);
        $data['slug'] = Str::slug($request->name) . '-' . rand(100, 999);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image_file') && $request->file('image_file')->isValid()) {
            $path = Storage::disk('cloudinary')->putFile('sekolah/ekskul', $request->file('image_file'));
            if ($path) {
                $data['image'] = Storage::disk('cloudinary')->url($path);
            }
        }

        Ekstrakurikuler::create($data);

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Ekskul berhasil ditambahkan.');
    }

    public function edit(Ekstrakurikuler $ekstrakurikuler)
    {
        return view('admin.ekstrakurikuler.edit', compact('ekstrakurikuler'));
    }

    public function update(Request $request, Ekstrakurikuler $ekstrakurikuler)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_file' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'description']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image_file') && $request->file('image_file')->isValid()) {
            $path = Storage::disk('cloudinary')->putFile('sekolah/ekskul', $request->file('image_file'));
            if ($path) {
                $data['image'] = Storage::disk('cloudinary')->url($path);
            }
        }

        $ekstrakurikuler->update($data);

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Ekskul berhasil diperbarui.');
    }

    public function destroy(Ekstrakurikuler $ekstrakurikuler)
    {
        $ekstrakurikuler->delete();
        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Ekskul berhasil dihapus.');
    }
}
