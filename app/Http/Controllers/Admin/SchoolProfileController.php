<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolProfile;
use Illuminate\Support\Facades\Storage;

class SchoolProfileController extends Controller
{
    public function index()
    {
        try {
            $profiles = SchoolProfile::pluck('value', 'key')->toArray();
            return view('admin.school-profiles.index', compact('profiles'));
        } catch (\Exception $e) {
            return "DATABASE ERROR: " . $e->getMessage();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|max:10240',
            'hero_image' => 'nullable|image|max:10240',
            'secondary_image' => 'nullable|image|max:10240',
        ]);

        $safeInput = $request->except(['logo_base64', 'hero_image_base64', 'secondary_image_base64', '_token']);
        
        try {
            $fileKeys = ['logo', 'hero_image', 'secondary_image'];
            
            // 1. Proses file dari upload biasa (jika ada)
            foreach ($fileKeys as $key) {
                if ($request->hasFile($key) && $request->file($key)->isValid()) {
                    $path = Storage::disk('cloudinary')->putFile('school_profiles', $request->file($key));
                    if ($path) {
                        $url = Storage::disk('cloudinary')->url($path);
                        SchoolProfile::updateOrCreate(['key' => $key], ['value' => $url]);
                    }
                }
            }

            // 2. Proses file dari Base64 (Utama untuk bypass Vercel limit)
            foreach ($fileKeys as $key) {
                $base64Data = $request->input($key . '_base64');
                if ($base64Data && str_contains($base64Data, ';base64,')) {
                    $parts = explode(";base64,", $base64Data);
                    $imageBinary = base64_decode($parts[1]);
                    
                    if ($imageBinary) {
                        $filename = 'school_profiles/' . $key . '_' . time() . '.jpg';
                        $success = Storage::disk('cloudinary')->put($filename, $imageBinary);
                        
                        if ($success) {
                            $url = Storage::disk('cloudinary')->url($filename);
                            SchoolProfile::updateOrCreate(['key' => $key], ['value' => $url]);
                        }
                    }
                }
            }

            // 3. Proses data teks
            foreach ($safeInput as $k => $v) {
                if ($v !== null && !str_ends_with($k, '_base64')) {
                    SchoolProfile::updateOrCreate(['key' => $k], ['value' => $v]);
                }
            }

            return back()->with('success', 'Profil sekolah berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withInput($safeInput)->withErrors(['error' => 'Gagal memperbarui: ' . $e->getMessage()]);
        }
    }
}

