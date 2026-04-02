<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolProfile;
use Cloudinary\Cloudinary;

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

        // Manually instantiate Cloudinary to bypass Laravel service provider issues on Vercel
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY', env('CLOUDINARY_KEY')),
                'api_secret' => env('CLOUDINARY_API_SECRET', env('CLOUDINARY_SECRET')),
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        $data = $request->except('_token');
        $files = $request->allFiles();
        
        try {
            // Proses upload file dari form (jika ada)
            foreach ($files as $key => $file) {
                if (in_array($key, ['logo', 'hero_image', 'secondary_image']) && $file && $file->isValid()) {
                    try {
                        $response = $cloudinary->uploadApi()->upload($file->getRealPath(), [
                            'folder' => 'school_profiles',
                            'public_id' => $key . '_' . time()
                        ]);
                        
                        $path = $response['secure_url'];
                        if ($path) {
                            SchoolProfile::updateOrCreate(
                                ['key' => $key],
                                ['value' => $path]
                            );
                        }
                    } catch (\Exception $e) {
                         // Fail silently for individual file attempts
                    }
                }
            }

            // Proses upload file dari base64 (Utama untuk Vercel)
            $fileKeys = ['logo', 'hero_image', 'secondary_image'];
            foreach ($fileKeys as $key) {
                if ($request->filled($key . '_base64')) {
                    $base64Data = $request->input($key . '_base64');
                    
                    try {
                        // Decode base64 safely
                        $image_base64 = $base64Data;
                        if (str_contains($base64Data, ';base64,')) {
                            $image_parts = explode(";base64,", $base64Data);
                            $image_base64 = base64_decode($image_parts[1]);
                        } else {
                            $image_base64 = base64_decode($base64Data);
                        }

                        if (!$image_base64) continue;

                        // Save to temp file
                        $tmpFilePath = sys_get_temp_dir() . '/' . uniqid() . '.jpg';
                        file_put_contents($tmpFilePath, $image_base64);

                        // Upload using direct SDK call
                        $response = $cloudinary->uploadApi()->upload($tmpFilePath, [
                            'folder' => 'school_profiles',
                            'public_id' => $key . '_' . time()
                        ]);
                        
                        $path = $response['secure_url'];
                        @unlink($tmpFilePath);

                        if ($path) {
                            SchoolProfile::updateOrCreate(
                                ['key' => $key],
                                ['value' => $path]
                            );
                        }
                    } catch (\Exception $e) {
                         $safeInput = $request->except(['logo_base64', 'hero_image_base64', 'secondary_image_base64']);
                         return back()->withInput($safeInput)->withErrors(['error' => 'Gagal mengupload (' . $key . '). Detail: ' . $e->getMessage()]);
                    }
                }
            }

            // Proses data teks lainnya
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
            return back()->withInput($safeInput)->withErrors(['error' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }
}

