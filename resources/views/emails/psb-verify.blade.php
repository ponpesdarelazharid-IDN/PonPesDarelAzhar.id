<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pendaftaran Santri Baru</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f1f5f9; margin: 0; padding: 40px 20px;">
    
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);">
        
        <!-- Header -->
        <div style="background-color: #1e293b; padding: 40px 30px; text-align: center;">
            <div style="display: inline-block; padding: 15px; background: rgba(16, 185, 129, 0.1); border-radius: 16px; margin-bottom: 20px;">
                <svg style="width: 48px; height: 48px; color: #10b981;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 style="color: #ffffff; margin: 0; font-size: 28px; font-weight: 800; letter-spacing: -0.5px;">Kode Verifikasi PSB</h1>
            <p style="color: #94a3b8; margin: 10px 0 0 0; font-size: 15px;">Pendaftaran Santri Baru - Darel Azhar</p>
        </div>

        <!-- Body -->
        <div style="padding: 40px 30px;">
            <p style="margin: 0 0 20px; color: #334155; font-size: 16px; line-height: 1.6;">
                Halo <strong style="color: #0f172a;">{{ $user->name }}</strong>,
            </p>
            
            <p style="margin: 0 0 30px; color: #475569; font-size: 16px; line-height: 1.6;">
                Terima kasih telah memulai proses pendaftaran akun di sistem kami. Berikut adalah <strong>Kode OTP 6-Digit</strong> Anda untuk melanjutkan proses pengisian formulir PSB.
            </p>

            <div style="text-align: center; margin-bottom: 40px;">
                <div style="display: inline-block; background-color: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 12px; padding: 20px 40px;">
                    <span style="font-size: 36px; font-weight: 900; letter-spacing: 12px; color: #10b981; font-family: monospace;">{{ $user->otp_code }}</span>
                </div>
            </div>

            <!-- Detail Akun -->
            <div style="background-color: #f8fafc; border-radius: 16px; padding: 25px; margin-bottom: 30px; border: 1px solid #e2e8f0;">
                <h3 style="margin: 0 0 20px 0; color: #0f172a; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px;">Detail Akun Anda</h3>
                
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; color: #64748b; font-size: 14px; width: 100px;">Email</td>
                        <td style="padding: 8px 0; color: #0f172a; font-size: 15px; font-weight: 600;">: {{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #64748b; font-size: 14px;">Kata Sandi</td>
                        <td style="padding: 8px 0; color: #0f172a; font-size: 15px; font-weight: 600; font-family: monospace;">: {{ $passwordPlain }}</td>
                    </tr>
                </table>
                <div style="margin-top: 15px; padding: 10px; background-color: #fffbeb; border-left: 4px solid #f59e0b; border-radius: 4px;">
                    <p style="margin: 0; font-size: 12px; color: #b45309;">
                        <strong>Penting!</strong> Jaga kerahasiaan kata sandi Anda. Kami menyertakannya di sini agar Anda tidak lupa saat akan login di kemudian hari.
                    </p>
                </div>
            </div>

            <p style="margin: 0 0 10px; color: #64748b; font-size: 15px; line-height: 1.6; text-align: center;">
                Silakan masukkan kode OTP di atas pada jendela browser tempat Anda mendaftar. Atau kembali ke web kami untuk melengkapi data pendaftaran.
            </p>
        </div>

        <!-- Footer -->
        <div style="background-color: #f8fafc; padding: 30px; text-align: center; border-top: 1px solid #e2e8f0;">
            <p style="margin: 0; color: #94a3b8; font-size: 13px;">
                Jika Anda tidak merasa melakukan pendaftaran ini, silakan abaikan email ini.
                <br><br>
                &copy; {{ date('Y') }} Pondok Pesantren Modern Darel Azhar
            </p>
        </div>
        
    </div>

</body>
</html>
