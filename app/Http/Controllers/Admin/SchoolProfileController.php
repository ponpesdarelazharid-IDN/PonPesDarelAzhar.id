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
        $data = $request->except('_token');
        
        foreach ($data as $key => $value) {
            // Handle file upload if the key is a file
            if ($request->hasFile($key)) {
                $value = $request->file($key)->storeOnCloudinary('school_profiles')->getSecurePath();
            }

            SchoolProfile::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Profil sekolah berhasil diperbarui!');
    }
}
