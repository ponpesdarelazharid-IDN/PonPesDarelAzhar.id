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

        $registration = Registration::firstOrCreate(
            ['user_id' => auth()->id()],
            [
                'ppdb_setting_id' => $setting->id,
                'status' => 'draft',
                'full_name' => auth()->user()->name, // Default name from user account
            ]
        );

        // Alur Baru: Jika status masih draft (belum divalidasi pembayarannya), arahkan ke dashboard pembayaran
        if ($registration->status === 'draft') {
            return redirect()->route('ppdb.status');
        }

        // Jika sudah verified (Pembayaran OK), maka boleh isi form Step 1
        return view('ppdb.register.step1', compact('registration'));
    }

    public function storeStep1(RegistrationRequest $request)
    {
        $validated = $request->validated();
        unset($validated['step']);
        
        $registration = Registration::where('user_id', auth()->id())->firstOrFail();

        // Guard: Pastikan sudah bayar (status verified)
        if ($registration->status === 'draft') {
            return redirect()->route('ppdb.status')->with('error', 'Silakan lakukan pembayaran terlebih dahulu.');
        }
        
        $registration->update(array_merge($validated, ['status' => 'verified']));

        return redirect()->route('ppdb.register.step2');
    }

    public function step2()
    {
        $registration = Registration::where('user_id', auth()->id())->firstOrFail();
        if ($registration->status === 'draft') return redirect()->route('ppdb.status');
        return view('ppdb.register.step2', compact('registration'));
    }

    public function storeStep2(RegistrationRequest $request)
    {
        $validated = $request->validated();
        unset($validated['step']);
        
        $registration = Registration::where('user_id', auth()->id())->firstOrFail();
        if ($registration->status === 'draft') return redirect()->route('ppdb.status');
        
        $registration->update($validated);

        return redirect()->route('ppdb.register.step3');
    }

    public function step3()
    {
        $registration = Registration::where('user_id', auth()->id())->firstOrFail();
        if ($registration->status === 'draft') return redirect()->route('ppdb.status');
        return view('ppdb.register.step3', compact('registration'));
    }

    public function storeStep3(RegistrationRequest $request)
    {
        $registration = Registration::where('user_id', auth()->id())->firstOrFail();
        if ($registration->status === 'draft') return redirect()->route('ppdb.status');
        
        $storage = Storage::disk('cloudinary');
        
        $fields = ['photo', 'birth_cert', 'ijazah', 'family_card', 'ktp_parent'];
        foreach ($fields as $field) {
            $compressedKey = $field . '_compressed';
            $dbKey = match ($field) {
                'photo' => 'photo_url',
                'birth_cert' => 'birth_cert_url',
                default => $field . '_url',
            };

            // 1. Check for Compressed Base64 Data First (Preferred for Vercel)
            if ($request->filled($compressedKey)) {
                $base64Data = $request->input($compressedKey);
                if (preg_match('/^data:image\/(\w+);base64,/', $base64Data, $type)) {
                    $imageBinary = base64_decode(substr($base64Data, strpos($base64Data, ',') + 1));
                    $folder = 'ppdb/' . ($field == 'photo' ? 'photos' : 'documents');
                    $tmpPath = sys_get_temp_dir() . '/' . uniqid() . '.jpg';
                    file_put_contents($tmpPath, $imageBinary);
                    
                    try {
                        $fileObj = new \Illuminate\Http\UploadedFile($tmpPath, $field.'.jpg', 'image/jpeg', null, true);
                        $path = $storage->putFile($folder, $fileObj);
                        @unlink($tmpPath);
                        if ($path) {
                            $registration->$dbKey = $storage->url($path);
                        } else {
                            return back()->with('error', 'Gagal menyimpan foto di Cloudinary.');
                        }
                    } catch (\Exception $e) {
                        @unlink($tmpPath);
                        return back()->with('error', 'Koneksi Cloudinary Gagal: ' . $e->getMessage());
                    }
                }
            } 
            // 2. Fallback to Standard File Upload (e.g. for PDFs or if compression failed)
            elseif ($request->hasFile($field) && $request->file($field)->isValid()) {
                $folder = ($field == 'photo' ? 'ppdb/photos' : 'ppdb/documents');
                try {
                    $path = $storage->putFile($folder, $request->file($field));
                    if ($path) {
                        $registration->$dbKey = $storage->url($path);
                    } else {
                        return back()->with('error', 'Dokumen asli gagal diunggah.');
                    }
                } catch (\Exception $e) {
                    return back()->with('error', 'Cloudinary Error: ' . $e->getMessage());
                }
            }
        }

        $registration->save();

        return redirect()->route('ppdb.register.step4');
    }

    public function step4()
    {
        $registration = Registration::where('user_id', auth()->id())->with('ppdbSetting')->firstOrFail();
        if ($registration->status === 'draft') return redirect()->route('ppdb.status');
        
        $profiles = SchoolProfile::pluck('value', 'key')->toArray();

        return view('ppdb.register.step4', compact('registration', 'profiles'));
    }

    public function storeFinal(RegistrationRequest $request)
    {
        $registration = Registration::where('user_id', auth()->id())->firstOrFail();
        
        $registration->status = 'pending'; // Form Selesai -> Menunggu Ujian / Hasil
        $registration->save();

        // Send Welcome Email
        try {
            Mail::to(auth()->user()->email)->send(new WelcomeMail($registration));
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim email PPDB: ' . $e->getMessage());
        }

        return redirect()->route('ppdb.status')->with('pendaftaran_selesai', true);
    }

    public function storePayment(Request $request)
    {
        $request->validate([
            'payment_receipt' => 'required|image|max:2048',
        ]);

        $registration = Registration::where('user_id', auth()->id())->firstOrFail();
        $storage = \Illuminate\Support\Facades\Storage::disk('cloudinary');

        if ($request->hasFile('payment_receipt')) {
            try {
                $path = $storage->putFile('ppdb/payments', $request->file('payment_receipt'));
                if ($path) {
                    $registration->payment_receipt_url = $storage->url($path);
                    $registration->status = 'pending';
                    $registration->save();
                } else {
                    return back()->with('error', 'Gagal mengunggah bukti pembayaran. Silakan periksa koneksi internet Anda.');
                }
            } catch (\Exception $e) {
                return back()->with('error', 'Cloudinary Error: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Bukti pembayaran berhasil diunggah! Mohon tunggu validasi admin.');
    }

    public function storeInstallment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_receipt' => 'required|image|max:2048',
        ]);

        $registration = Registration::where('user_id', auth()->id())->firstOrFail();
        $storage = \Illuminate\Support\Facades\Storage::disk('cloudinary');

        if ($request->hasFile('payment_receipt')) {
            try {
                $path = $storage->putFile('ppdb/installments', $request->file('payment_receipt'));
                if ($path) {
                    $registration->payments()->create([
                        'amount' => $request->amount,
                        'receipt_url' => $storage->url($path),
                        'status' => 'pending'
                    ]);
                } else {
                    return back()->with('error', 'Gagal mengunggah bukti cicilan. Mohon coba file lain.');
                }
            } catch (\Exception $e) {
                return back()->with('error', 'Cloudinary Error: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Bukti cicilan berhasil diunggah! Mohon tunggu konfirmasi admin.');
    }

    public function printCard()
    {
        $registration = Registration::where('user_id', auth()->id())
            ->where('status', 'accepted')
            ->firstOrFail();

        $profiles = SchoolProfile::pluck('value', 'key')->toArray();
        
        return view('ppdb.card', compact('registration', 'profiles'));
    }
}
