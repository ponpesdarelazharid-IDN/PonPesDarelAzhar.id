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
            'image_file' => 'nullable|image|max:10240',
        ]);

        $data = $request->only(['name', 'description']);
        $data['slug'] = Str::slug($request->name) . '-' . rand(100, 999);
        $data['is_active'] = $request->has('is_active');

        // Handle Base64 Image Upload (Priority for Vercel)
        $base64Data = $request->input('image_file_base64');
        if ($base64Data && str_contains($base64Data, ';base64,')) {
            $parts = explode(";base64,", $base64Data);
            $imageBinary = base64_decode($parts[1]);
            
            if ($imageBinary) {
                $filename = 'sekolah/ekskul/img_' . time() . '.jpg';
                $success = Storage::disk('cloudinary')->put($filename, $imageBinary);
                if ($success) {
                    $data['image'] = Storage::disk('cloudinary')->url($filename);
                }
            }
        } 
        // Fallback for regular file upload
        elseif ($request->hasFile('image_file') && $request->file('image_file')->isValid()) {
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
            'image_file' => 'nullable|image|max:10240',
        ]);

        $data = $request->only(['name', 'description']);
        $data['is_active'] = $request->has('is_active');

        // Handle Base64 Image Upload
        $base64Data = $request->input('image_file_base64');
        if ($base64Data && str_contains($base64Data, ';base64,')) {
            $parts = explode(";base64,", $base64Data);
            $imageBinary = base64_decode($parts[1]);
            
            if ($imageBinary) {
                $filename = 'sekolah/ekskul/img_' . time() . '.jpg';
                $success = Storage::disk('cloudinary')->put($filename, $imageBinary);
                if ($success) {
                    $data['image'] = Storage::disk('cloudinary')->url($filename);
                }
            }
        } 
        // Fallback for regular file upload
        elseif ($request->hasFile('image_file') && $request->file('image_file')->isValid()) {
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
