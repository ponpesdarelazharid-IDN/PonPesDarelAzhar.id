<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PpdbSetting;

class PpdbSettingController extends Controller
{
    public function index()
    {
        $ppdbSettings = PpdbSetting::latest()->get();
        return view('admin.ppdb-settings.index', compact('ppdbSettings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'academic_year' => 'required|string',
            'open_date' => 'nullable|date',
            'close_date' => 'nullable|date',
            'quota' => 'nullable|integer',
            'requirements' => 'nullable|string',
        ]);

        if ($request->has('is_open')) {
            // Turn off other open settings
            PpdbSetting::where('id', '>', 0)->update(['is_open' => false]);
        }

        PpdbSetting::create([
            'academic_year' => $validated['academic_year'],
            'is_open' => $request->has('is_open'),
            'open_date' => $validated['open_date'],
            'close_date' => $validated['close_date'],
            'quota' => $validated['quota'],
            'requirements' => $validated['requirements'],
        ]);

        return back()->with('success', 'Pengaturan PPDB berhasil disimpan!');
    }
}
