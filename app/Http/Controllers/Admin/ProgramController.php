<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->get();
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|max:10240',
        ]);

        $data = $request->only(['title', 'description']);

        // Handle Base64 Image Upload
        $base64Data = $request->input('icon_base64');
        if ($base64Data && str_contains($base64Data, ';base64,')) {
            $parts = explode(";base64,", $base64Data);
            $imageBinary = base64_decode($parts[1]);
            
            if ($imageBinary) {
                $filename = 'programs/icon_' . time() . '.jpg';
                $success = Storage::disk('cloudinary')->put($filename, $imageBinary);
                if ($success) {
                    $data['icon_path'] = Storage::disk('cloudinary')->url($filename);
                }
            }
        } 
        // Fallback for regular file upload if base64 absent
        elseif ($request->hasFile('icon') && $request->file('icon')->isValid()) {
            $path = Storage::disk('cloudinary')->putFile('programs', $request->file('icon'));
            if ($path) {
                $data['icon_path'] = Storage::disk('cloudinary')->url($path);
            }
        }

        Program::create($data);

        return redirect()->route('admin.programs.index')->with('success', 'Program unggulan berhasil ditambahkan.');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|max:10240',
        ]);

        $data = $request->only(['title', 'description']);

        // Handle Base64 Image Upload
        $base64Data = $request->input('icon_base64');
        if ($base64Data && str_contains($base64Data, ';base64,')) {
            $parts = explode(";base64,", $base64Data);
            $imageBinary = base64_decode($parts[1]);
            
            if ($imageBinary) {
                $filename = 'programs/icon_' . time() . '.jpg';
                $success = Storage::disk('cloudinary')->put($filename, $imageBinary);
                if ($success) {
                    $data['icon_path'] = Storage::disk('cloudinary')->url($filename);
                }
            }
        } 
        // Fallback for regular file upload if base64 absent
        elseif ($request->hasFile('icon') && $request->file('icon')->isValid()) {
            $path = Storage::disk('cloudinary')->putFile('programs', $request->file('icon'));
            if ($path) {
                $data['icon_path'] = Storage::disk('cloudinary')->url($path);
            }
        }

        $program->update($data);

        return redirect()->route('admin.programs.index')->with('success', 'Program unggulan berhasil diperbarui.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Program unggulan berhasil dihapus.');
    }
}
