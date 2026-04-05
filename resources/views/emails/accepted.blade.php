<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Bergabung - PPDB Darel Azhar</title>
    <style>
        body { margin: 0; padding: 0; font-family: 'Inter', system-ui, -apple-system, sans-serif; background-color: #F8FAFC; color: #1E293B; }
        .wrapper { max-width: 600px; margin: 40px auto; background-color: #FFFFFF; border-radius: 24px; overflow: hidden; border: 1px solid #E2E8F0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); }
        .hero { padding: 60px 40px; text-align: center; background-color: #0F172A; color: #FFFFFF; background-image: radial-gradient(circle at 10% 20%, rgba(16, 185, 129, 0.1), transparent 40%); }
        .mabruk { font-size: 10px; font-weight: 900; color: #10B981; text-transform: uppercase; letter-spacing: 3px; margin-bottom: 16px; display: block; }
        .title { font-size: 32px; font-weight: 900; color: #FFFFFF; margin: 0; letter-spacing: -1px; line-height: 1.2; }
        .content { padding: 48px; line-height: 1.6; font-size: 15px; color: #475569; }
        .greeting { color: #0F172A; font-weight: 700; font-size: 18px; margin-bottom: 24px; display: block; }
        .highlight { color: #059669; font-weight: 800; }
        .card-box { margin: 32px 0; padding: 24px; background-color: #F8FAFC; border-radius: 20px; border: 2px dashed #E2E8F0; text-align: center; }
        .card-label { font-size: 10px; font-weight: 900; color: #94A3B8; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 4px; display: block; }
        .card-number { font-size: 24px; font-weight: 900; color: #0F172A; letter-spacing: 2px; }
        .btn { display: inline-block; background-color: #10B981; color: #FFFFFF !important; text-decoration: none; padding: 16px 32px; font-weight: 800; border-radius: 12px; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2); transition: all 0.2s; }
        .footer { padding: 32px; text-align: center; font-size: 12px; color: #94A3B8; background-color: #F8FAFC; border-top: 1px solid #E2E8F0; }
        @media only screen and (max-width: 600px) { .wrapper { margin: 0; border-radius: 0; } .hero, .content { padding: 40px 24px; } .title { font-size: 26px; } }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="hero">
            <span class="mabruk">Alf Mabruk! 🎉</span>
            <h1 class="title">Selamat Terpilih!</h1>
        </div>
        <div class="content">
            <span class="greeting">Assalamu'alaikum, {{ $registration->full_name }}</span>
            <p>Alhamdulillah, Anda dinyatakan <span class="highlight">LULUS SELEKSI</span> dan resmi menjadi santri Pondok Pesantren Modern Darel Azhar.</p>
            <p>Selamat bergabung dalam perjalanan menuntut ilmu bersama kami di {{ $profiles['nama_sekolah'] ?? 'PonPes Darel Azhar' }}.</p>
            <div class="card-box">
                <span class="card-label">NOMOR REGISTRASI</span>
                <div class="card-number">{{ $registration->registration_number }}</div>
            </div>
            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ route('ppdb.register.card') }}" class="btn">Lihat Kartu Santri</a>
            </div>
        </div>
        <div class="footer">
            <p><strong>{{ $profiles['nama_sekolah'] ?? 'Pondok Pesantren Modern Darel Azhar' }}</strong></p>
            <p>{{ $profiles['alamat'] ?? 'Indonesia' }}</p>
        </div>
    </div>
</body>
</html>
