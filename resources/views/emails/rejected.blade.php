<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran PPDB - {{ $profiles['nama_sekolah'] ?? 'Darel Azhar' }}</title>
    <style>
        body { margin: 0; padding: 0; font-family: 'Inter', system-ui, -apple-system, sans-serif; background-color: #F8FAFC; color: #1E293B; }
        .wrapper { max-width: 600px; margin: 40px auto; background-color: #FFFFFF; border-radius: 24px; overflow: hidden; border: 1px solid #E2E8F0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); }
        .hero { padding: 50px 40px; text-align: center; background-color: #0F172A; color: #FFFFFF; }
        .label { font-size: 10px; font-weight: 900; color: #94A3B8; text-transform: uppercase; letter-spacing: 3px; margin-bottom: 12px; display: block; }
        .title { font-size: 28px; font-weight: 900; color: #FFFFFF; margin: 0; letter-spacing: -1px; }
        .content { padding: 48px; line-height: 1.7; font-size: 15px; color: #475569; }
        .greeting { color: #0F172A; font-weight: 700; font-size: 18px; margin-bottom: 24px; display: block; }
        .status-box { margin: 32px 0; padding: 32px; background-color: #FEF2F2; border-radius: 20px; border: 1px solid #FEE2E2; text-align: center; }
        .status-label { font-size: 10px; color: #991B1B; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; }
        .status-value { font-size: 20px; color: #991B1B; font-weight: 900; margin-top: 8px; }
        .notes { margin-top: 24px; padding: 20px; background-color: #F8FAFC; border-left: 4px solid #CBD5E1; font-style: italic; font-size: 14px; border-radius: 0 12px 12px 0; }
        .btn { display: inline-block; background-color: #0F172A; color: #FFFFFF !important; text-decoration: none; padding: 16px 32px; font-weight: 800; border-radius: 12px; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; }
        .footer { padding: 32px; text-align: center; font-size: 12px; color: #94A3B8; background-color: #F8FAFC; border-top: 1px solid #E2E8F0; }
        @media only screen and (max-width: 600px) { .wrapper { margin: 0; border-radius: 0; } .hero, .content { padding: 40px 24px; } .title { font-size: 24px; } }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="hero">
            <span class="label">Informasi Status PPDB</span>
            <h1 class="title">Hasil Seleksi Pendaftaran</h1>
        </div>
        <div class="content">
            <span class="greeting">Assalamu'alaikum, {{ $registration->full_name }}</span>
            <p>Terima kasih atas minat Anda mendaftar di {{ $profiles['nama_sekolah'] ?? 'Pondok Pesantren Modern Darel Azhar' }}.</p>
            <p>Kami telah melakukan peninjauan mendalam terhadap berkas Anda dengan nomor registrasi <span style="font-weight: 700; color: #0F172A;">{{ $registration->registration_number }}</span>. Berdasarkan kriteria seleksi panitia, pendaftaran Anda dinyatakan:</p>
            <div class="status-box">
                <span class="status-label">STATUS AKHIR</span>
                <div class="status-value">TIDAK LULUS SELEKSI</div>
            </div>
            @if($registration->notes)
            <div class="notes">
                <strong>Catatan Panitia:</strong><br>
                "{{ $registration->notes }}"
            </div>
            @endif
            <p style="margin-top: 32px;">Keputusan ini bersifat final. Kami mendoakan yang terbaik bagi kelanjutan pendidikan Anda di tempat lain.</p>
        </div>
        <div class="footer">
            <p><strong>{{ $profiles['nama_sekolah'] ?? 'Pondok Pesantren Modern Darel Azhar' }}</strong></p>
            <p>{{ $profiles['alamat'] ?? '' }}</p>
        </div>
    </div>
</body>
</html>
