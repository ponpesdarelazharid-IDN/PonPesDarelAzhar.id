<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RegistrationRequest;
use App\Models\Registration;
use App\Models\PpdbSetting;
use App\Models\SchoolProfile;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    public function index()
    {
        $setting = PpdbSetting::where('is_open', true)->first();
        if (!$setting) {
            return redirect()->route('ppdb.landing')->with('error', 'Pendaftaran PPDB sedang ditutup.');
        }

        $registration = Registration::where('user_id', auth()->id())->first();
        if ($registration && $registration->status !== 'draft') {
            return redirect()->route('ppdb.status');
        }

        return view('ppdb.register.step1', compact('registration'));
    }

    public function storeStep1(RegistrationRequest $request)
    {
        $validated = $request->validated();
        
        $setting = PpdbSetting::where('is_open', true)->first();
        if (!$setting) {
            return back()->with('error', 'Pendaftaran PPDB sedang ditutup.');
        }

        $registration = Registration::updateOrCreate(
            ['user_id' => auth()->id()],
            array_merge($validated, ['ppdb_setting_id' => $setting->id, 'status' => 'draft'])
        );

        return redirect()->route('ppdb.register.step2');
    }

    public function step2()
    {
        $registration = Registration::where('user_id', auth()->id())->firstOrFail();
        return view('ppdb.register.step2', compact('registration'));
    }

    public function storeStep2(RegistrationRequest $request)
    {
        $validated = $request->validated();
        $registration = Registration::where('user_id', auth()->id())->firstOrFail();
        
        $registration->update($validated);

        return redirect()->route('ppdb.register.step3');
    }

    public function step3()
    {
        $registration = Registration::where('user_id', auth()->id())->firstOrFail();
        return view('ppdb.register.step3', compact('registration'));
    }

    public function storeStep3(RegistrationRequest $request)
    {
        $registration = Registration::where('user_id', auth()->id())->firstOrFail();
        $storage = Storage::disk('cloudinary');
        
        $fields = ['photo', 'birth_cert', 'ijazah', 'skhu'];
        foreach ($fields as $field) {
            $compressedKey = $field . '_compressed';
            $dbKey = ($field == 'photo') ? 'photo_url' : ($field == 'birth_cert' ? 'birth_cert_url' : $field . '_url');

            // 1. Check for Compressed Base64 Data First (Preferred for Vercel)
            if ($request->filled($compressedKey)) {
                $base64Data = $request->input($compressedKey);
                if (preg_match('/^data:image\/(\w+);base64,/', $base64Data, $type)) {
                    $imageBinary = base64_decode(substr($base64Data, strpos($base64Data, ',') + 1));
                    $filename = 'ppdb/' . ($field == 'photo' ? 'photos' : 'documents') . '/' . uniqid() . '.jpg';
                    
                    if ($storage->put($filename, $imageBinary)) {
                        $registration->$dbKey = $storage->url($filename);
                    }
                }
            } 
            // 2. Fallback to Standard File Upload (e.g. for PDFs or if compression failed)
            elseif ($request->hasFile($field) && $request->file($field)->isValid()) {
                $folder = ($field == 'photo' ? 'ppdb/photos' : 'ppdb/documents');
                $path = $storage->putFile($folder, $request->file($field));
                if ($path) {
                    $registration->$dbKey = $storage->url($path);
                }
            }
        }

        $registration->save();

        return redirect()->route('ppdb.register.step4');
    }

    public function step4()
    {
        $registration = Registration::where('user_id', auth()->id())->with('ppdbSetting')->firstOrFail();
        return view('ppdb.register.step4', compact('registration'));
    }

    public function storeFinal(RegistrationRequest $request)
    {
        $registration = Registration::where('user_id', auth()->id())->firstOrFail();
        
        $registration->status = 'pending';
        $registration->save();

        // Send Welcome Email
        try {
            Mail::to(auth()->user()->email)->send(new WelcomeMail($registration));
        } catch (\Exception $e) {
            // Log error but continue
            \Log::error('Gagal mengirim email PPDB: ' . $e->getMessage());
        }

        return redirect()->route('ppdb.status')->with('success', 'Pendaftaran berhasil dikirim! Silakan cek email Anda.');
    }

    public function printCard()
    {
        $registration = Registration::where('user_id', auth()->id())
            ->where('status', 'accepted')
            ->firstOrFail();

        $school = SchoolProfile::whereIn('key', ['nama_sekolah', 'alamat', 'email', 'tlp'])->get()->pluck('value', 'key');
        
        return view('ppdb.card', compact('registration', 'school'));
    }
}
