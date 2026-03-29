<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RegistrationRequest;
use App\Models\Registration;
use App\Models\PpdbSetting;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
        
        $files = ['photo', 'birth_cert', 'ijazah', 'skhu'];
        foreach ($files as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $uploadedFileUrl = Cloudinary::upload($request->file($fileKey)->getRealPath())->getSecurePath();
                $dbKey = ($fileKey == 'photo') ? 'photo_url' : ($fileKey == 'birth_cert' ? 'birth_cert_url' : $fileKey . '_url');
                $registration->$dbKey = $uploadedFileUrl;
            }
        }

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
}
