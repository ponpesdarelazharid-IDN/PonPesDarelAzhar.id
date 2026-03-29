<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PpdbSetting;
use App\Models\Registration;

class PpdbController extends Controller
{
    public function landing()
    {
        $ppdb = PpdbSetting::where('is_open', true)
            ->where(function ($query) {
                $query->whereNull('open_date')->orWhere('open_date', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('close_date')->orWhere('close_date', '>=', now());
            })
            ->first();
            
        return view('ppdb.landing', compact('ppdb'));
    }

    public function create()
    {
        $ppdb = PpdbSetting::where('is_open', true)
            ->where(function ($query) {
                $query->whereNull('open_date')->orWhere('open_date', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('close_date')->orWhere('close_date', '>=', now());
            })
            ->firstOrFail();
        
        if (auth()->user()->registration) {
            return redirect()->route('ppdb.status')->with('error', 'Anda sudah mendaftar.');
        }

        return view('ppdb.register', compact('ppdb'));
    }

    public function store(Request $request)
    {
        $ppdb = PpdbSetting::where('is_open', true)
            ->where(function ($query) {
                $query->whereNull('open_date')->orWhere('open_date', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('close_date')->orWhere('close_date', '>=', now());
            })
            ->firstOrFail();

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:L,P',
            'religion' => 'required|string|max:50',
            'address' => 'required|string',
            'origin_school' => 'required|string|max:255',
            'origin_school_address' => 'required|string',
            'graduation_year' => 'required|digits:4',
            'photo' => 'required|image|max:2048',
            'birth_cert' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'ijazah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'skhu' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $registration = new Registration($validated);
        $registration->user_id = auth()->id();
        $registration->ppdb_setting_id = $ppdb->id;
        $registration->status = 'pending';

        // Upload to Cloudinary
        if ($request->hasFile('photo')) {
            $registration->photo_url = $request->file('photo')->storeOnCloudinary('ppdb/photos')->getSecurePath();
        }
        if ($request->hasFile('birth_cert')) {
            $registration->birth_cert_url = $request->file('birth_cert')->storeOnCloudinary('ppdb/documents')->getSecurePath();
        }
        if ($request->hasFile('ijazah')) {
            $registration->ijazah_url = $request->file('ijazah')->storeOnCloudinary('ppdb/documents')->getSecurePath();
        }
        if ($request->hasFile('skhu')) {
            $registration->skhu_url = $request->file('skhu')->storeOnCloudinary('ppdb/documents')->getSecurePath();
        }

        $registration->save();

        return redirect()->route('ppdb.status')->with('success', 'Pendaftaran berhasil disubmit!');
    }

    public function status()
    {
        $registration = auth()->user()->registration;
        return view('ppdb.status', compact('registration'));
    }
}
