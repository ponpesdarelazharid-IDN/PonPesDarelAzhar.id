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
            // File validation temporarily mocked or implemented later
        ]);

        $registration = new Registration($validated);
        $registration->user_id = auth()->id();
        $registration->ppdb_setting_id = $ppdb->id;
        $registration->status = 'pending';
        $registration->save();

        return redirect()->route('ppdb.status')->with('success', 'Pendaftaran berhasil disubmit!');
    }

    public function status()
    {
        $registration = auth()->user()->registration;
        return view('ppdb.status', compact('registration'));
    }
}
