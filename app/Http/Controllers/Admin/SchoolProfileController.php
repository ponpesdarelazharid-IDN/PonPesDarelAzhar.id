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
                        // Hilangkan header data URI ("data:image/jpeg;base64,")
                        $image_parts = explode(";base64,", $base64Data);
                        $image_base64 = base64_decode($image_parts[1]);
                        
                        // Simpan ke temporary file
                        $tmpFilePath = sys_get_temp_dir() . '/' . uniqid() . '.jpg';
                        file_put_contents($tmpFilePath, $image_base64);

                        // Upload physical file ke Cloudinary
                        $path = cloudinary()->upload($tmpFilePath, ['folder' => 'school_profiles'])->getSecurePath();
                        
                        // Hapus file temporary
                        @unlink($tmpFilePath);

                        if ($path) {
                            SchoolProfile::updateOrCreate(
                                ['key' => $key],
                                ['value' => $path]
                            );
                        }
                    } catch (\Exception $e) {
                         // PREVENT Header Overflow by removing base64 strings from input flash
                         $safeInput = $request->except(['logo_base64', 'hero_image_base64', 'secondary_image_base64']);
                         return back()->withInput($safeInput)->withErrors(['error' => 'Gagal mengupload gambar (' . $key . '). Detail: ' . $e->getMessage()]);
                    }
                }
            }

            // Proses data teks yang lain
            foreach ($data as $key => $value) {
                 if (!array_key_exists($key, $files) && $value !== null && !str_ends_with($key, '_base64')) {
                    SchoolProfile::updateOrCreate(
                        ['key' => $key],
                        ['value' => $value]
                    );
                }
            }
            return back()->with('success', 'Profil sekolah berhasil diperbarui!');
        } catch (\Exception $e) {
            $safeInput = $request->except(['logo_base64', 'hero_image_base64', 'secondary_image_base64']);
            return back()->withInput($safeInput)->withErrors(['error' => 'Terjadi kesalahan sistem. Silakan coba lagi.']);
        }
    }
}
