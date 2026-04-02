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
        
        try {
            foreach ($data as $key => $value) {
                // Handle file upload if the key is a file
                if ($request->hasFile($key)) {
                    $value = $request->file($key)->storeOnCloudinary('school_profiles')->getSecurePath();
                }

                if ($value !== null) {
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
