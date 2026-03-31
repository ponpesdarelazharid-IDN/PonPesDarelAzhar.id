<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Akun - PPDB Darel Azhar</title>
    <style>
        body { margin: 0; padding: 20px; font-family: 'Inter', 'Arial', sans-serif; background-color: #020617; color: #f8fafc; }
        .wrapper { max-width: 600px; margin: 0 auto; background-color: #0f172a; border-radius: 24px; overflow: hidden; border: 1px solid #1e293b; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
        .hero { padding: 40px 20px; text-align: center; background: radial-gradient(circle at top, #1e293b 0%, #0f172a 100%); border-bottom: 1px solid #1e293b; }
        .label { font-size: 14px; font-weight: 800; color: #22d3ee; text-transform: uppercase; letter-spacing: 4px; margin-bottom: 10px; display: block; }
        .title { font-size: 28px; font-weight: 900; color: #ffffff; margin: 0; letter-spacing: -0.5px; }
        
        .content { padding: 40px; line-height: 1.7; font-size: 16px; color: #cbd5e1; text-align: center; }
        .greeting { color: #f8fafc; font-weight: 600; margin-bottom: 20px; text-align: left; }
        
        .cta-area { text-align: center; margin: 40px 0; }
        .btn { display: inline-block; background-color: #fbbf24; color: #020617 !important; text-decoration: none; padding: 18px 40px; font-weight: 900; border-radius: 12px; font-size: 16px; border: none; cursor: pointer; }
        
        .footer { padding: 30px; text-align: center; font-size: 13px; color: #64748b; border-top: 1px solid #1e293b; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="hero">
            <span class="label">SECURITY VERIFICATION</span>
            <h1 class="title">Verifikasi Akun PPDB</h1>
        </div>

        <div class="content">
            <p class="greeting">Assalamu'alaikum Calon Santri,</p>
            
            <p>Terima kasih telah melakukan pendaftaran di portal PPDB Pondok Pesantren Modern Darel Azhar. Untuk mengaktifkan akun Anda, mohon lakukan konfirmasi alamat email dengan menekan tombol di bawah ini:</p>

            <div class="cta-area">
                <a href="{{ $url }}" class="btn">VERIFIKASI EMAIL SEKARANG</a>
            </div>
            
            <p style="font-size: 14px; color: #64748b;">Jika tombol tidak berfungsi, salin link berikut:<br> {{ $url }}</p>
        </div>

        <div class="footer">
            <p><strong>Pondok Pesantren Modern Darel Azhar</strong></p>
            <p>PPDB System v1.0</p>
        </div>
    </div>
</body>
</html>
