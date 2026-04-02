<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran PPDB - {{ $profiles['nama_sekolah'] ?? config('app.name') }}</title>
    <style>
        body { margin: 0; padding: 20px; font-family: 'Inter', 'Arial', sans-serif; background-color: #f8fafc; color: #1e293b; }
        .wrapper { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 24px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
        .header { padding: 40px 20px; text-align: center; background-color: #1e293b; border-bottom: 1px solid #e2e8f0; }
        .label { font-size: 12px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 4px; margin-bottom: 10px; display: block; }
        .title { font-size: 24px; font-weight: 900; color: #ffffff; margin: 0; letter-spacing: -0.5px; }
        
        .content { padding: 40px; line-height: 1.7; font-size: 16px; color: #475569; }
        .greeting { color: #1e293b; font-weight: 600; margin-bottom: 20px; font-size: 18px; }
        .status-box { margin: 30px 0; padding: 25px; background-color: #fef2f2; border-radius: 16px; border: 1px solid #fee2e2; text-align: center; }
        .status-label { font-size: 13px; color: #991b1b; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; }
        .status-value { font-size: 20px; color: #991b1b; font-weight: 900; margin-top: 5px; }
        
        .notes { margin-top: 20px; padding: 15px; background-color: #f8fafc; border-left: 4px solid #cbd5e1; font-style: italic; font-size: 14px; }
        
        .cta-area { text-align: center; margin-top: 30px; }
        .btn { display: inline-block; background-color: #1e293b; color: #ffffff !important; text-decoration: none; padding: 16px 32px; font-weight: 800; border-radius: 12px; font-size: 16px; }
        
        .footer { padding: 30px; text-align: center; font-size: 13px; color: #64748b; border-top: 1px solid #e2e8f0; background-color: #f8fafc; }
        .footer p { margin: 5px 0; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <span class="label">Informasi PPDB</span>
            <h1 class="title">Status Pendaftaran</h1>
        </div>

        <div class="content">
            <p class="greeting">Assalamu'alaikum {{ $registration->full_name }},</p>
            
            <p>Terima kasih atas minat dan kepercayaan Anda untuk mendaftarkan diri di {{ $profiles['nama_sekolah'] ?? config('app.name') }}.</p>
            
            <p>Setelah melakukan peninjauan mendalam terhadap berkas dan hasil seleksi pendaftaran Anda dengan nomor registrasi <span style="font-weight: 700;">{{ $registration->registration_number }}</span>, dengan berat hati kami menginformasikan bahwa pendaftaran Anda dinyatakan:</p>
            
            <div class="status-box">
                <span class="status-label">STATUS</span>
                <div class="status-value">TIDAK LULUS SELEKSI</div>
            </div>

            @if($registration->notes)
            <div class="notes">
                <strong>Catatan Panitia:</strong><br>
                "{{ $registration->notes }}"
            </div>
            @endif

            <p style="margin-top: 30px;">Keputusan ini bersifat final berdasarkan hasil seleksi panitia. Kami mendoakan yang terbaik bagi kelanjutan pendidikan Anda di tempat yang lain.</p>

            <div class="cta-area">
                <a href="{{ route('ppdb.status') }}" class="btn">LIHAT DETAIL DI DASHBOARD</a>
            </div>
        </div>

        <div class="footer">
            <p><strong>{{ $profiles['nama_sekolah'] ?? 'Pondok Pesantren Modern Darel Azhar' }}</strong></p>
            <p>{{ $profiles['alamat'] ?? '' }}</p>
            <p>Email ini dikirim secara otomatis oleh sistem pendaftaran.</p>
        </div>
    </div>
</body>
</html>
