<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolProfile;

class SchoolProfileController extends Controller
{
    public function index()
    {
        $profiles = SchoolProfile::pluck('value', 'key')->toArray();
        return view('admin.school-profiles.index', compact('profiles'));
    }

    public function store(Request $request)
    {
        // Validation to prevent huge files from even being attempted
        $request->validate([
            'logo' => 'nullable|image|max:10240',
            'hero_image' => 'nullable|image|max:10240',
            'secondary_image' => 'nullable|image|max:10240',
        ]);

        $data = $request->except('_token');
        $files = $request->allFiles();
        
        try {
            // Proses upload file terlebih dahulu
            foreach ($files as $key => $file) {
                if (in_array($key, ['logo', 'hero_image', 'secondary_image']) && $file) {
                    $path = $file->storeOnCloudinary('school_profiles')->getSecurePath();
                    if ($path) {
                        SchoolProfile::updateOrCreate(
                            ['key' => $key],
                            ['value' => $path]
                        );
                    }
                }
            }

            // Proses upload file dari base64
            $fileKeys = ['logo', 'hero_image', 'secondary_image'];
            foreach ($fileKeys as $key) {
                if ($request->filled($key . '_base64')) {
                    $base64Data = $request->input($key . '_base64');
                    try {
                        $path = cloudinary()->upload($base64Data, ['folder' => 'school_profiles'])->getSecurePath();
                        if ($path) {
                            SchoolProfile::updateOrCreate(
                                ['key' => $key],
                                ['value' => $path]
                            );
                        }
                    } catch (\Exception $e) {
                         return back()->withInput()->withErrors(['error' => 'Gagal compress/upload image.']);
                    }
                }
            }

            // Proses data teks yang lain
            foreach ($data as $key => $value) {
                 if (!array_key_exists($key, $files) && $value !== null) {
                    SchoolProfile::updateOrCreate(
                        ['key' => $key],
                        ['value' => $value]
                    );
                }
            }
            return back()->with('success', 'Profil sekolah berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal memperbarui profil. Silakan coba lagi. ' . $e->getMessage()]);
        }
    }
}
