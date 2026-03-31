<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Pelajar - {{ $registration->full_name ?? 'Darel Azhar' }}</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --card-width: 85.6mm;
            --card-height: 53.98mm;
            --bg-black: #111111;
            --bg-dark-grey: #1a1a1a;
            --gold-primary: #d4af37;
            --gold-gradient: linear-gradient(135deg, #d4af37 0%, #996515 100%);
            --text-white: #ffffff;
            --text-gray: #9ca3af;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: #f3f4f6;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            padding: 40px 20px;
        }

        /* Container Kartu */
        .card {
            width: var(--card-width);
            height: var(--card-height);
            background-color: var(--bg-black);
            border-radius: 14px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0,0,0,0.4);
            color: var(--text-white);
            margin-bottom: 20px;
            zoom: 2.2; /* Zoom untuk pratinjau monitor */
            border: 1px solid #333;
        }

        /* Emas Dekorasi (Sudut) */
        .corner-accent {
            position: absolute;
            background: var(--gold-gradient);
            z-index: 1;
        }
        .corner-top-left { width: 100px; height: 30px; top: -15px; left: -40px; transform: rotate(-35deg); }
        .corner-bottom-right { width: 150px; height: 40px; bottom: -20px; right: -50px; transform: rotate(-35deg); }
        
        .gold-line-top { position: absolute; top: 0; left: 0; width: 100%; height: 3px; background: var(--gold-gradient); z-index: 5; }
        .gold-line-bottom { position: absolute; bottom: 0; left: 0; width: 100%; height: 5px; background: var(--gold-gradient); z-index: 5; }
        
        .accent-bar-left { position: absolute; left: 0; top: 35%; height: 30%; width: 5px; background: var(--gold-gradient); z-index: 5; }

        /* Header */
        .header {
            padding: 15px 20px 10px 20px;
            display: flex;
            align-items: center;
            position: relative;
            z-index: 10;
        }

        .mosque-icon {
            font-size: 24px;
            color: var(--gold-primary);
            margin-right: 15px;
            text-shadow: 0 0 10px rgba(212, 175, 55, 0.3);
        }

        .header-text h2 {
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 0.5px;
            line-height: 1.1;
        }
        .header-text h3 {
            font-size: 10px;
            font-weight: 600;
            color: var(--gold-primary);
            letter-spacing: 4px;
            margin-top: 2px;
            text-transform: uppercase;
        }

        .top-divider {
            position: absolute;
            top: 55px;
            left: 20px;
            width: calc(100% - 40px);
            height: 1px;
            background: linear-gradient(90deg, var(--gold-primary) 0%, rgba(212,175,55,0) 100%);
            z-index: 10;
        }

        /* Body */
        .body {
            padding: 15px 25px;
            display: flex;
            gap: 20px;
            position: relative;
            z-index: 10;
            margin-top: 5px;
        }

        .photo-box {
            width: 70px;
            height: 90px;
            border: 2px solid var(--gold-primary);
            padding: 2px;
            background: #000;
            flex-shrink: 0;
            position: relative;
        }
        /* Corner Photo Accents */
        .photo-box::before { content: ''; position: absolute; top: -5px; left: -5px; width: 10px; height: 10px; border-top: 2px solid var(--gold-primary); border-left: 2px solid var(--gold-primary); }
        .photo-box::after { content: ''; position: absolute; bottom: -5px; right: -5px; width: 10px; height: 10px; border-bottom: 2px solid var(--gold-primary); border-right: 2px solid var(--gold-primary); }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info-grid {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .info-item {
            margin-bottom: 8px;
        }

        .label {
            font-size: 7px;
            color: var(--text-gray);
            font-weight: 500;
            margin-bottom: 1px;
            text-transform: uppercase;
        }

        .value {
            font-size: 11px;
            font-weight: 700;
            color: var(--text-white);
        }

        .value-small {
            font-size: 8px;
            color: #ddd;
            font-weight: 400;
        }

        /* Footer Info */
        .footer-info {
            position: absolute;
            bottom: 6px; /* Moved up slightly to prevent clipping */
            left: 115px; /* Aligned with photo/info gap */
            width: calc(100% - 135px);
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            z-index: 10;
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 5px;
        }

        .footer-item.right { text-align: right; }
        .nis-label { color: var(--gold-primary); }
        .nis-value { color: var(--gold-primary); font-size: 13px; letter-spacing: 0.5px; line-height: 1; }

        /* Kartu Belakang */
        .card-back {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
        }

        .logo-container-back {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            padding: 5px;
        }
        .logo-container-back img { max-width: 100%; max-height: 100%; }

        .card-back h1 {
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 8px;
            line-height: 1.2;
            color: #fff;
        }

        .separator-line {
            width: 40px;
            height: 2px;
            background: var(--gold-gradient);
            margin: 10px auto;
        }

        .card-back .school-address {
            font-size: 8px;
            color: var(--text-gray);
            line-height: 1.5;
            max-width: 90%;
            text-align: center; /* Ensure address is centered */
            margin: 0 auto;
        }

        /* UI Buttons (Non-Print) */
        .ui-section {
            background: white;
            padding: 20px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            text-align: center;
            width: 100%;
            max-width: 500px;
            margin-bottom: 20px;
        }
        .btn-print {
            background: #111; color: white; padding: 12px 35px; border-radius: 8px; font-weight: 800; border: none; font-size: 14px; cursor: pointer; transition: 0.3s;
        }
        .btn-print:hover { background: #333; transform: translateY(-2px); }
        .btn-back { color: #888; font-size: 13px; text-decoration: none; display: block; margin-top: 15px; font-weight: 600; }

        @media print {
            body { background: white; margin: 0; padding: 0; display: block; }
            .ui-section { display: none !important; }
            .card {
                zoom: 1; /* Reset zoom untuk print */
                box-shadow: none !important;
                border: none;
                margin: 20mm auto !important;
            }
            @page { size: portrait; margin: 0; }
        }
    </style>
</head>
<body>

    <div class="ui-section">
        <h1 style="color:#111; font-size:22px; font-weight:900; margin-bottom:15px; text-transform:uppercase;">Kartu Pelajar Digital</h1>
        <button onclick="window.print()" class="btn-print"><i class="fa-solid fa-print"></i> CETAK KARTU</button>
        <a href="{{ route('ppdb.status') }}" class="btn-back">KEMBALI KE DASHBOARD</a>
    </div>

    <!-- KARTU DEPAN -->
    <div class="card">
        <!-- Accents -->
        <div class="corner-accent corner-top-left"></div>
        <div class="corner-accent corner-bottom-right"></div>
        <div class="gold-line-top"></div>
        <div class="gold-line-bottom"></div>
        <div class="accent-bar-left"></div>
        <div class="top-divider"></div>

        <div class="header">
            <div class="mosque-icon">
                <i class="fa-solid fa-mosque"></i>
            </div>
            <div class="header-text">
                <h2>DAREL AZHAR</h2>
                <h3>KARTU PELAJAR</h3>
            </div>
        </div>

        <div class="body">
            <div class="photo-box">
                @if(isset($registration) && $registration->photo_url)
                    <img src="{{ $registration->photo_url }}" alt="Foto Siswa">
                @else
                    <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-size:8px; color:#444;">FOTO 3X4</div>
                @endif
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <p class="label">NAMA MURID</p>
                    <p class="value">{{ strtoupper($registration->full_name ?? 'AISYAH AZ ZAHRA') }}</p>
                </div>

                <div class="info-item">
                    <p class="label">TEMPAT TGL LAHIR</p>
                    <p class="value">
                        @if(isset($registration) && $registration->birth_date)
                            {{ strtoupper($registration->birth_place) }}, {{ $registration->birth_date->format('d OKTOBER Y') }}
                        @else
                            BANDUNG, 12 OKTOBER 2007
                        @endif
                    </p>
                </div>

                <div class="info-item">
                    <p class="label">ALAMAT DOMISILI</p>
                    <p class="value-small">{{ Str::limit($registration->address ?? 'Jl. Anggrek No. 12, Cipete, Jakarta Selatan', 65) }}</p>
                </div>
            </div>
        </div>

        <div class="footer-info">
            <div class="footer-item">
                <p class="label">TGL TERDAFTAR</p>
                <p class="value" style="font-size: 9px;">
                    {{ isset($registration) && $registration->created_at ? $registration->created_at->format('d/m/Y') : '15/07/2023' }}
                </p>
            </div>
            <div class="footer-item right">
                <p class="label nis-label">NO NIS</p>
                <p class="value nis-value">{{ $registration->registration_number ?? '2122.10.045' }}</p>
            </div>
        </div>
    </div>

    <!-- KARTU BELAKANG -->
    <div class="card card-back">
        <!-- Accents -->
        <div class="corner-accent corner-top-left"></div>
        <div class="corner-accent corner-bottom-right"></div>
        <div class="gold-line-top"></div>
        <div class="gold-line-bottom"></div>
        <div class="accent-bar-left"></div>
        
        <div class="content" style="position:relative; z-index:10; width: 100%;">
            <div class="logo-container-back" style="margin: 0 auto 15px auto;">
                <img src="{{ asset('images/logo-da.png') }}" alt="Logo Darel Azhar">
            </div>
            
            <h1>PONDOK PESANTREN<br>MODERN DAREL AZHAR</h1>
            
            <div class="separator-line"></div>
            
            <p class="school-address">
                {{ $profiles['alamat'] ?? 'Jl. Komp. Pendidikan No.RT 08/09, Muara Ciujung Tim., Kec. Rangkasbitung, Kabupaten Lebak, Banten 42314' }}
            </p>
            
            @if(isset($profiles['tlp']))
                <p style="margin-top:10px; color: var(--gold-primary); font-weight: bold; font-size:9px;">
                    <i class="fa-solid fa-phone"></i> {{ $profiles['tlp'] }}
                </p>
            @endif
        </div>
    </div>

</body>
</html>
