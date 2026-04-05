<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Berhasil Dibuat - {{ $profiles['nama_sekolah'] ?? 'Darel Azhar' }}</title>
    <style>
        body { margin: 0; padding: 0; font-family: 'Inter', system-ui, -apple-system, sans-serif; background-color: #F8FAFC; color: #1E293B; }
        .wrapper { max-width: 600px; margin: 40px auto; background-color: #FFFFFF; border-radius: 24px; overflow: hidden; border: 1px solid #E2E8F0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); }
        .hero { padding: 50px 40px; text-align: center; background-color: #0F172A; color: #FFFFFF; }
        .label { font-size: 10px; font-weight: 900; color: #10B981; text-transform: uppercase; letter-spacing: 3px; margin-bottom: 12px; display: block; }
        .title { font-size: 28px; font-weight: 900; color: #FFFFFF; margin: 0; letter-spacing: -1px; }
        .content { padding: 48px; line-height: 1.7; font-size: 15px; color: #475569; }
        .greeting { color: #0F172A; font-weight: 700; font-size: 18px; margin-bottom: 24px; display: block; }
        .info-box { margin: 32px 0; padding: 24px; background-color: #F8FAFC; border-radius: 16px; border: 1px solid #E2E8F0; }
        .info-row { display: flex; justify-content: space-between; border-bottom: 1px solid #E2E8F0; padding: 12px 0; }
        .info-row:last-child { border-bottom: none; }
        .info-label { font-size: 10px; color: #94A3B8; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; }
        .info-value { font-size: 14px; color: #0F172A; font-weight: 700; }
        .btn { display: inline-block; background-color: #10B981; color: #FFFFFF !important; text-decoration: none; padding: 18px 40px; font-weight: 900; border-radius: 14px; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; }
        .footer { padding: 32px; text-align: center; font-size: 12px; color: #94A3B8; background-color: #F8FAFC; border-top: 1px solid #E2E8F0; }
        @media only screen and (max-width: 600px) { .wrapper { margin: 0; border-radius: 0; } .hero, .content { padding: 40px 24px; } .title { font-size: 24px; } .info-row { flex-direction: column; gap: 4px; } }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="hero">
            <span class="label">Pendaftaran Akun Berhasil</span>
            <h1 class="title">Selamat Bergabung!</h1>
        </div>
        <div class="content">
            <span class="greeting">Halo, {{ $user->name }}</span>
            <p>Akun Anda telah berhasil dibuat. Anda dapat mengakses dashboard PPDB {{ $profiles['nama_sekolah'] ?? 'Darel Azhar' }} untuk melengkapi data dan berkas pendaftaran.</p>
            <div class="info-box">
                <div class="info-row">
                    <span class="info-label">Email Log In</span>
                    <span class="info-value">{{ $user->email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Waktu Daftar</span>
                    <span class="info-value">{{ $registrationDate }}</span>
                </div>
            </div>
            <p>Segera lengkapi berkas Anda untuk mempermudah panitia dalam melakukan proses verifikasi.</p>
            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ route('dashboard') }}" class="btn">Lengkapi Berkas Sekarang</a>
            </div>
        </div>
        <div class="footer">
            <p><strong>{{ $profiles['nama_sekolah'] ?? 'Pondok Pesantren Modern Darel Azhar' }}</strong></p>
            <p>{{ $profiles['alamat'] ?? '' }}</p>
        </div>
    </div>
</body>
</html>
