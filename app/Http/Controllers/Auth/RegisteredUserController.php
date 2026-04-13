<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $otpCode = sprintf("%06d", mt_rand(1, 999999));

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pendaftar',
            'otp_code' => $otpCode,
        ]);

        // Kirim Email yang memuat OTP dan Plain Password
        try {
            \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\PsbVerificationMail($user, $request->password));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal mengirim email pendaftaran PSB: ' . $e->getMessage());
        }

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
