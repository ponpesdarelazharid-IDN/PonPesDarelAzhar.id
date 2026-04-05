<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Akun - PPDB Darel Azhar</title>
    <style>
        body { margin: 0; padding: 0; font-family: 'Inter', system-ui, -apple-system, sans-serif; background-color: #F8FAFC; color: #1E293B; }
        .wrapper { max-width: 600px; margin: 40px auto; background-color: #FFFFFF; border-radius: 24px; overflow: hidden; border: 1px solid #E2E8F0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); }
        .hero { padding: 50px 40px; text-align: center; background-color: #0F172A; color: #FFFFFF; }
        .label { font-size: 10px; font-weight: 900; color: #10B981; text-transform: uppercase; letter-spacing: 3px; margin-bottom: 12px; display: block; }
        .title { font-size: 28px; font-weight: 900; color: #FFFFFF; margin: 0; letter-spacing: -1px; }
        .content { padding: 48px; line-height: 1.7; font-size: 15px; color: #475569; text-align: center; }
        .greeting { color: #0F172A; font-weight: 700; font-size: 18px; margin-bottom: 24px; display: block; text-align: left; }
        .cta-box { margin: 40px 0; text-align: center; }
        .btn { display: inline-block; background-color: #10B981; color: #FFFFFF !important; text-decoration: none; padding: 18px 40px; font-weight: 900; border-radius: 14px; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.2); }
        .footer { padding: 32px; text-align: center; font-size: 12px; color: #94A3B8; background-color: #F8FAFC; border-top: 1px solid #E2E8F0; }
        @media only screen and (max-width: 600px) { .wrapper { margin: 0; border-radius: 0; } .hero, .content { padding: 40px 24px; } .title { font-size: 24px; } }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="hero">
            <span class="label">Verifikasi Keamanan</span>
            <h1 class="title">Aktivasi Akun Portal</h1>
        </div>
        <div class="content">
            <span class="greeting">Assalamu'alaikum Calon Santri,</span>
            <p>Terima kasih telah mendaftar di Portal PPDB Pondok Pesantren Modern Darel Azhar. Untuk mengamankan akun dan mengaktifkan akses pendaftaran Anda, mohon lakukan verifikasi email melalui tombol di bawah ini:</p>
            <div class="cta-box">
                <a href="{{ $url }}" class="btn">Verifikasi Email Sekarang</a>
            </div>
            <p style="font-size: 12px; color: #94A3B8; margin-top: 40px;">Jika tombol tidak berfungsi, silakan salin dan tempel link berikut di browser Anda:<br><span style="word-break: break-all; color: #10B981;">{{ $url }}</span></p>
        </div>
        <div class="footer">
            <p><strong>Pondok Pesantren Modern Darel Azhar</strong></p>
            <p>Sistem Informasi PPDB v1.0</p>
        </div>
    </div>
</body>
</html>
