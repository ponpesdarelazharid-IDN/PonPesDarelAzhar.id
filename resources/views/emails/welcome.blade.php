<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .header {
            text-align: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #1e293b;
            margin: 0;
            font-size: 24px;
            font-weight: 800;
        }
        .registration-number {
            display: inline-block;
            background: #1e293b;
            color: #fff;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: bold;
            margin-top: 10px;
        }
        .content {
            margin-bottom: 30px;
        }
        .summary-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }
        .summary-item {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
        }
        .summary-label {
            font-weight: 600;
            color: #64748b;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            margin-top: 40px;
        }
        /* Dark Mode Support */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #000000;
                color: #e2e8f0;
            }
            .container {
                background: #0a0a0a;
                border: 1px solid #1e293b;
            }
            .header h1 {
                color: #fff;
            }
            .header {
                border-bottom: 1px solid #1e293b;
            }
            .summary-box {
                background: #111111;
                border: 1px solid #1e293b;
            }
            .summary-label {
                color: #94a3b8;
            }
            .registration-number {
                background: #fff;
                color: #000;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Selamat Datang!</h1>
            <div class="registration-number">{{ $registration->registration_number }}</div>
            <p>Pendaftaran Anda Telah Kami Terima</p>
        </div>

        <div class="content">
            <p>Halo <strong>{{ $registration->full_name }}</strong>,</p>
            <p>Terima kasih telah mendaftar di Pondok Pesantren Modern Darel Azhar. Data pendaftaran Anda telah berhasil kami simpan dalam sistem kami.</p>

            <div class="summary-box">
                <h3 style="margin-top: 0; font-size: 16px;">Ringkasan Data:</h3>
                <div class="summary-item">
                    <span class="summary-label">Nama Lengkap</span>
                    <span>{{ $registration->full_name }}</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Asal Sekolah</span>
                    <span>{{ $registration->origin_school }}</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Status</span>
                    <span style="color: #059669; font-weight: bold;">Menunggu Verifikasi</span>
                </div>
            </div>

            <p style="margin-top: 30px;">Silakan simpan nomor pendaftaran di atas untuk keperluan pengecekan status di kemudian hari.</p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Pondok Pesantren Modern Darel Azhar. All rights reserved.
        </div>
    </div>
</body>
</html>
