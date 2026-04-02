<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Berhasil Dibuat - PPDB {{ $profiles['nama_sekolah'] ?? config('app.name') }}</title>
    <style>
        body { margin: 0; padding: 20px; font-family: 'Inter', 'Arial', sans-serif; background-color: #020617; color: #f8fafc; }
        .wrapper { max-width: 600px; margin: 0 auto; background-color: #0f172a; border-radius: 24px; overflow: hidden; border: 1px solid #1e293b; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
        .header { padding: 40px 20px; text-align: center; background: radial-gradient(circle at top, #1e293b 0%, #0f172a 100%); border-bottom: 1px solid #1e293b; }
        .label { font-size: 12px; font-weight: 800; color: #22d3ee; text-transform: uppercase; letter-spacing: 4px; margin-bottom: 10px; display: block; }
        .title { font-size: 28px; font-weight: 900; color: #ffffff; margin: 0; letter-spacing: -0.5px; }
        
        .content { padding: 40px; line-height: 1.7; font-size: 16px; color: #cbd5e1; }
        .greeting { color: #f8fafc; font-weight: 600; margin-bottom: 20px; font-size: 18px; }
        .highlight { color: #22d3ee; font-weight: 700; }
        
        .info-container { margin: 30px 0; padding: 25px; background-color: #020617; border-radius: 16px; border: 1px solid #1e293b; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 10px; border-bottom: 1px solid #1e293b; padding-bottom: 10px; }
        .info-label { font-size: 13px; color: #64748b; font-weight: 600; text-transform: uppercase; }
        .info-value { font-size: 15px; color: #ffffff; font-weight: 700; }
        
        .cta-area { text-align: center; margin-top: 30px; }
        .btn { display: inline-block; background-color: #ffffff; color: #020617 !important; text-decoration: none; padding: 18px 36px; font-weight: 800; border-radius: 12px; font-size: 16px; transition: all 0.2s; }
        
        .footer { padding: 30px; text-align: center; font-size: 13px; color: #64748b; border-top: 1px solid #1e293b; }
        .footer p { margin: 5px 0; }
        
        @media only screen and (max-width: 600px) {
            .content { padding: 25px; }
            .title { font-size: 24px; }
            .info-row { flex-direction: column; text-align: center; }
            .info-value { margin-top: 4px; }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <span class="label">Pendaftaran Berhasil</span>
            <h1 class="title">Selamat Bergabung!</h1>
        </div>

        <div class="content">
            <p class="greeting">Halo {{ $user->name }},</p>
            
            <p>Akun pendaftaran Anda telah berhasil dibuat. Anda sekarang dapat mengakses dashboard sistem PPDB {{ $profiles['nama_sekolah'] ?? config('app.name') }} untuk melengkapi berkas pendaftaran.</p>
            
            <div class="info-container">
                <div class="info-row">
                    <span class="info-label">Email Log In</span>
                    <span class="info-value">{{ $user->email }}</span>
                </div>
                <div class="info-row" style="border: none; padding: 0;">
                    <span class="info-label">Waktu Pendaftaran</span>
                    <span class="info-value">{{ $registrationDate }}</span>
                </div>
            </div>

            <p>Segera lengkapi data diri dan dokumen pendukung (Foto, Akta Kelahiran, Ijazah, dll) untuk mempermudah proses verifikasi oleh panitia.</p>

            <div class="cta-area">
                <a href="{{ route('dashboard') }}" class="btn">LENGKAPI BERKAS SEKARANG</a>
            </div>
            
            <p style="margin-top: 40px; font-style: italic; font-size: 14px; text-align: center; color: #64748b;">
                "Langkah awal menuju masa depan yang gemilang dimulai dari sini."
            </p>
        </div>

        <div class="footer">
            <p><strong>{{ $profiles['nama_sekolah'] ?? 'Pondok Pesantren Modern Darel Azhar' }}</strong></p>
            <p>{{ $profiles['alamat'] ?? '' }}</p>
            <p>Email ini dikirim secara otomatis oleh sistem pendaftaran.</p>
        </div>
    </div>
</body>
</html>
