<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanda Terima Registrasi - PPDB Darel Azhar</title>
    <style>
        body { margin: 0; padding: 20px; font-family: 'Inter', 'Arial', sans-serif; background-color: #020617; color: #f8fafc; }
        .wrapper { max-width: 600px; margin: 0 auto; background-color: #0f172a; border-radius: 24px; overflow: hidden; border: 1px solid #1e293b; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
        .hero { padding: 40px 20px; text-align: center; background: radial-gradient(circle at top, #1e293b 0%, #0f172a 100%); border-bottom: 1px solid #1e293b; }
        .label { font-size: 14px; font-weight: 800; color: #fbbf24; text-transform: uppercase; letter-spacing: 4px; margin-bottom: 10px; display: block; }
        .title { font-size: 28px; font-weight: 900; color: #ffffff; margin: 0; letter-spacing: -0.5px; }
        
        .content { padding: 40px; line-height: 1.7; font-size: 16px; color: #cbd5e1; }
        .greeting { color: #f8fafc; font-weight: 600; margin-bottom: 20px; }
        
        .nis-container { margin: 30px 0; padding: 25px; background-color: #020617; border-radius: 16px; border: 1px dashed #1e293b; text-align: center; }
        .nis-label { font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px; display: block; }
        .nis-code { font-size: 24px; font-weight: 900; color: #ffffff; letter-spacing: 4px; }
        
        .footer { padding: 30px; text-align: center; font-size: 13px; color: #64748b; border-top: 1px solid #1e293b; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="hero">
            <span class="label">REGISTRATION RECEIVED</span>
            <h1 class="title">Tanda Terima PPDB</h1>
        </div>

        <div class="content">
            <p class="greeting">Assalamu'alaikum {{ $registration->full_name }},</p>
            
            <p>Terima kasih telah melakukan pendaftaran di Pondok Pesantren Modern Darel Azhar. Kami menginformasikan bahwa berkas pendaftaran Anda telah kami terima sepenuhnya di sistem kami.</p>

            <div class="nis-container">
                <span class="nis-label">NOMOR REGISTRASI ANDA</span>
                <div class="nis-code">{{ $registration->registration_number }}</div>
            </div>

            <p>Mohon menunggu proses verifikasi berkas oleh Panitia PPDB. Status pendaftaran Anda akan kami informasikan lebih lanjut melalui dashboard sytem atau email resmi sekolah.</p>
        </div>

        <div class="footer">
            <p><strong>Pondok Pesantren Modern Darel Azhar</strong></p>
            <p>Email ini dikirim secara otomatis oleh sistem.</p>
        </div>
    </div>
</body>
</html>
