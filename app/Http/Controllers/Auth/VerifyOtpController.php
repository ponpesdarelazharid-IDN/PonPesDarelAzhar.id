<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyOtpController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'otp_code' => ['required', 'string', 'size:6'],
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Jika sudah verified melalui mekanisme lain
        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Cek kecocokan OTP
        if ($user->otp_code === $request->otp_code) {
            // Verifikasi Sukses
            $user->markEmailAsVerified();
            
            // Hapus OTP dari DB sebagai pengamanan
            $user->otp_code = null;
            $user->save();

            // Redirect ke halaman PSB tahap awal
            return redirect()->route('ppdb.register')->with('success', 'Email berhasil diverifikasi. Silakan mulai isi formulir pendaftaran PSB.');
        }

        // Gagal
        return back()->withErrors(['otp_code' => 'Kode Verifikasi OTP yang dimasukkan salah. Silakan periksa kembali email Anda.']);
    }
}
