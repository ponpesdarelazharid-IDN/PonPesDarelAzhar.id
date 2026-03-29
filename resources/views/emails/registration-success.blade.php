<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Berhasil</title>
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #1e293b;
            padding: 40px 20px;
            text-align: center;
            color: #ffffff;
        }
        .content {
            padding: 40px;
        }
        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            background-color: #f1f5f9;
        }
        h1 { margin: 0; font-size: 24px; font-weight: 800; letter-spacing: -0.025em; }
        p { margin-bottom: 24px; }
        .stats {
            background-color: #f8fafc;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 32px;
        }
        .stat-item {
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
        }
        .stat-label { font-weight: 700; color: #64748b; font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; }
        .stat-value { font-weight: 800; color: #1e293b; }
        .btn {
            display: inline-block;
            background-color: #1e293b;
            color: #ffffff !important;
            padding: 16px 32px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 800;
            text-align: center;
            width: 100%;
            box-sizing: border-box;
        }
        /* Dark Mode Support */
        @media (prefers-color-scheme: dark) {
            body { background-color: #000000; }
            .container { background-color: #0a0a0a; color: #f8fafc; border: 1px solid #1e293b; }
            .header { background-color: #ffffff; color: #000000; }
            .content { color: #cbd5e1; }
            .stats { background-color: #111111; }
            .stat-value { color: #ffffff; }
            .btn { background-color: #ffffff; color: #000000 !important; }
            .footer { background-color: #000000; color: #475569; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PPDB ONLINE</h1>
            <div style="font-size: 14px; font-weight: 600; margin-top: 8px; opacity: 0.8;">{{ config('app.name') }}</div>
        </div>
        <div class="content">
            <p style="font-size: 18px; font-weight: 700; color: #1e293b;" class="stat-value">Halo, {{ $user->name }}!</p>
            <p>Selamat! Akun Anda telah berhasil dibuat. Silakan gunakan akun ini sebagai profil utama Anda untuk melakukan pendaftaran online PPDB dan memantau seluruh proses seleksi.</p>
            
            <div class="stats">
                <div class="stat-item">
                    <span class="stat-label">Email</span>
                    <span class="stat-value">{{ $user->email }}</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Tanggal Daftar</span>
                    <span class="stat-value">{{ $registrationDate }}</span>
                </div>
            </div>

            <p>Jangan lupa untuk segera melengkapi berkas pendaftaran Anda melalui link di bawah ini:</p>
            
            <a href="{{ route('dashboard') }}" class="btn">Lengkapi Berkas Sekarang</a>

            <p style="margin-top: 32px; font-size: 14px;">Email ini juga akan menjadi media informasi utama terkait seluruh pengumuman dan jadwal tes PPDB Anda.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.<br>
            Jl. Komp. Pendidikan No.RT 08/09, Muara Ciujung Tim., Lebak, Banten.
        </div>
    </div>
</body>
</html>
