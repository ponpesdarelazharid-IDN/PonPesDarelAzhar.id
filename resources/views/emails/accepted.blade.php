<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Bergabung - PPDB Darel Azhar</title>
    <style>
        body { margin: 0; padding: 20px; font-family: 'Inter', 'Arial', sans-serif; background-color: #020617; color: #f8fafc; }
        .wrapper { max-width: 600px; margin: 0 auto; background-color: #0f172a; border-radius: 24px; overflow: hidden; border: 1px solid #1e293b; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
        .hero { padding: 40px 20px; text-align: center; background: radial-gradient(circle at top, #1e293b 0%, #0f172a 100%); border-bottom: 1px solid #1e293b; }
        .mabruk { font-size: 14px; font-weight: 800; color: #fbbf24; text-transform: uppercase; letter-spacing: 4px; margin-bottom: 10px; display: block; }
        .title { font-size: 32px; font-weight: 900; color: #ffffff; margin: 0; letter-spacing: -0.5px; }
        
        .content { padding: 40px; line-height: 1.7; font-size: 16px; color: #cbd5e1; }
        .greeting { color: #f8fafc; font-weight: 600; margin-bottom: 20px; }
        .highlight { color: #fbbf24; font-weight: 700; }
        .link-text { color: #22d3ee; text-decoration: none; font-weight: 600; border-bottom: 1px solid rgba(34, 211, 238, 0.3); }
        
        .nis-container { margin: 40px 0; padding: 30px; background-color: #020617; border-radius: 16px; border: 1px dashed #1e293b; text-align: center; }
        .nis-label { font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px; display: block; }
        .nis-code { font-size: 24px; font-weight: 900; color: #ffffff; letter-spacing: 4px; text-shadow: 0 0 15px rgba(251, 191, 36, 0.2); }
        
        .cta-area { text-align: center; margin-top: 30px; }
        .btn { display: inline-block; background-color: #ffffff; color: #020617 !important; text-decoration: none; padding: 16px 32px; font-weight: 800; border-radius: 12px; font-size: 16px; transition: all 0.2s; }
        
        .footer { padding: 30px; text-align: center; font-size: 13px; color: #64748b; border-top: 1px solid #1e293b; }
        .footer p { margin: 5px 0; }
        
        @media only screen and (max-width: 600px) {
            .content { padding: 25px; }
            .title { font-size: 26px; }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="hero">
            <span class="mabruk">MABRUK! 🎉</span>
            <h1 class="title">Selamat Bergabung!</h1>
        </div>

        <div class="content">
            <p class="greeting">Assalamu'alaikum {{ $registration->full_name }},</p>
            
            <p>Dengan penuh rasa syukur, kami menginformasikan bahwa Anda telah dinyatakan <span class="highlight">LULUS</span> seleksi dan resmi menjadi bagian dari keluarga besar Pondok Pesantren Modern Darel Azhar.</p>
            
            <p>Sebagai identitas resmi, kami telah menerbitkan <a href="{{ route('ppdb.register.card') }}" class="link-text">Kartu Pelajar Digital</a> Anda. Silakan klik tombol di bawah ini untuk melihat dan mencetak kartu Anda (Ukuran KTP).</p>

            <div class="nis-container">
                <span class="nis-label">NOMOR REGISTRASI / NIS</span>
                <div class="nis-code">{{ $registration->registration_number }}</div>
            </div>

            <div class="cta-area">
                <a href="{{ route('ppdb.register.card') }}" class="btn">LIHAT KARTU PELAJAR</a>
            </div>
            
            <p style="margin-top: 40px; font-style: italic; font-size: 14px;">"Selamat berjuang menuntut ilmu, semoga menjadi santri yang berakhlak mulia dan bermanfaat bagi umat."</p>
        </div>

        <div class="footer">
            <p><strong>Pondok Pesantren Modern Darel Azhar</strong></p>
            <p>{{ $profiles['alamat'] ?? 'Indonesia' }}</p>
            <p>Email ini dikirim secara otomatis oleh sistem PPDB.</p>
        </div>
    </div>
</body>
</html>
