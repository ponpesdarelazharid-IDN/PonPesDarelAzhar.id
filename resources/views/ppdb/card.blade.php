<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Pelajar - {{ $registration->full_name ?? 'Darel Azhar' }}</title>
    <!-- Font Awesome untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --card-width: 85.6mm;
            --card-height: 53.98mm;
            --bg-dark: #1e242a;
            --bg-slate: #2c343c;
            --text-white: #ffffff;
            --text-gray: #94a3b8;
            --gold-accent: #d1a34b;
            --gold-text: #f59e0b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: #f0f4f8;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            padding: 40px 20px;
        }

        /* Container Kartu */
        .card {
            width: var(--card-width);
            height: var(--card-height);
            background-color: var(--bg-dark);
            border-radius: 12px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            color: var(--text-white);
            margin-bottom: 30px;
            /* Ukuran fisik di layar (zoom) */
            zoom: 2.2; 
        }

        /* Dekorasi Background */
        .bg-shape {
            position: absolute;
            background: linear-gradient(135deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0) 100%);
            z-index: 1;
        }
        .bg-shape-1 { width: 300px; height: 300px; border-radius: 50%; top: -150px; right: -80px; }
        .bg-shape-2 { width: 200px; height: 200px; border-radius: 50%; bottom: -100px; left: -50px; }
        .bg-shape-3 { width: 100px; height: 100px; background: var(--gold-accent); opacity: 0.1; top: 40%; left: 30%; filter: blur(40px); }

        .gold-tab-left {
            position: absolute;
            left: 0;
            top: 20%;
            height: 60%;
            width: 4px;
            background-color: var(--gold-accent);
            border-radius: 0 4px 4px 0;
            z-index: 5;
        }

        .gold-bar-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--bg-dark) 0%, var(--gold-accent) 50%, var(--bg-dark) 100%);
            z-index: 5;
        }

        /* Layout Konten */
        .header-front {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            position: relative;
            z-index: 10;
        }

        .header-logo {
            width: 38px;
            height: 38px;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            padding: 3px;
        }
        .header-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .header-text h2 {
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 1px;
        }
        .header-text h3 {
            font-size: 9px;
            font-weight: 500;
            color: var(--gold-text);
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .body-front {
            padding: 15px 20px;
            display: flex;
            gap: 15px;
            position: relative;
            z-index: 10;
        }

        .photo-container {
            width: 65px;
            height: 85px;
            background: #222;
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 6px;
            overflow: hidden;
            flex-shrink: 0;
            margin-top: 5px;
        }

        .photo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .data-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
        }

        .data-group {
            margin-bottom: 6px;
        }

        .data-label {
            color: var(--text-gray);
            font-size: 7px;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 1px;
            text-transform: uppercase;
        }

        .data-value {
            color: var(--text-white);
            font-size: 11px;
            font-weight: 700;
        }

        .data-value-normal {
            font-weight: 400;
            font-size: 8px;
            color: #cbd5e1;
        }

        .bottom-divider {
            width: 100%;
            height: 1px;
            background-color: rgba(255,255,255,0.1);
            margin: 8px 0;
        }

        .bottom-data-container {
            display: flex;
            justify-content: space-between;
        }

        .data-label-nis { color: var(--gold-text); }
        .data-value-nis { color: var(--gold-text); font-size: 12px; }

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
        }

        .separator-line {
            width: 40px;
            height: 2px;
            background: var(--gold-accent);
            margin: 10px auto;
        }

        .card-back p {
            font-size: 8px;
            color: var(--text-gray);
            line-height: 1.5;
            max-width: 80%;
        }

        /* Print Specifics */
        .no-print-section {
            background: white;
            padding: 20px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
            width: 100%;
            max-width: 500px;
            margin-bottom: 20px;
        }
        .btn-print {
            background: #1e242a; color: white; padding: 12px 32px; border-radius: 8px; font-weight: 700; border: none; font-size: 14px; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 15px rgba(0,0,0,0.2); 
        }
        .btn-print:hover { background: #13171b; transform: translateY(-2px); }
        .btn-back { color: #64748b; font-size: 13px; font-weight: 600; text-decoration: none; display: block; margin-top: 15px; }
        
        @media print {
            body { background: white; margin: 0; padding: 0px; display: block; }
            .no-print-section { display: none !important; }
            .card {
                zoom: 1;
                box-shadow: none !important;
                page-break-inside: avoid;
                margin: 10mm auto !important;
                border: 0.1pt solid #eee;
            }
            @page { size: portrait; margin: 0; }
        }

    </style>
</head>
<body>

    <div class="no-print-section">
        <h1 style="font-size:24px; font-weight:800; color:#1e242a; margin-bottom:15px;">Pratinjau Kartu Pelajar</h1>
        <button onclick="window.print()" class="btn-print"><i class="fa-solid fa-print"></i> Cetak Kartu</button>
        <a href="{{ route('ppdb.status') }}" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard</a>
    </div>

    <!-- KARTU DEPAN -->
    <div class="card card-front">
        <div class="bg-shape bg-shape-1"></div>
        <div class="bg-shape bg-shape-2"></div>
        
        <div class="gold-tab-left"></div>
        <div class="gold-bar-bottom"></div>

        <div class="header-front">
            <div class="header-logo">
                <img src="{{ asset('images/logo-da.png') }}" alt="Logo Darel Azhar">
            </div>
            <div class="header-text">
                <h2>DAREL AZHAR</h2>
                <h3>KARTU PELAJAR</h3>
            </div>
        </div>

        <div class="body-front">
            <div class="photo-container">
                @if(isset($registration) && $registration->photo_url)
                    <img src="{{ $registration->photo_url }}" alt="Foto Siswa">
                @else
                    <div style="width:100%; height:100%; background:#222; display:flex; align-items:center; justify-content:center; color:#555; font-size:8px;">FOTO</div>
                @endif
            </div>

            <div class="data-container">
                <div class="data-group">
                    <div class="data-label">NAMA LENGKAP</div>
                    <div class="data-value">{{ strtoupper($registration->full_name ?? 'Aisyah Az Zahra') }}</div>
                </div>

                <div class="data-group">
                    <div class="data-label">TEMPAT, TGL LAHIR</div>
                    <div class="data-value">
                        @if(isset($registration) && $registration->birth_date)
                            {{ strtoupper($registration->birth_place) }}, {{ $registration->birth_date->format('d/m/Y') }}
                        @else
                            BANDUNG, 12/10/2007
                        @endif
                    </div>
                </div>

                <div class="data-group">
                    <div class="data-label">ALAMAT</div>
                    <div class="data-value data-value-normal">{{ Str::limit($registration->address ?? 'Jl. Anggrek No. 12, Cipete, Jakarta Selatan', 60) }}</div>
                </div>

                <div class="bottom-divider"></div>

                <div class="bottom-data-container">
                    <div class="bottom-data-group">
                        <div class="data-label">TGL TERDAFTAR</div>
                        <div class="data-value" style="font-size:9px;">
                            {{ isset($registration) && $registration->created_at ? $registration->created_at->format('d M Y') : date('d M Y') }}
                        </div>
                    </div>
                    
                    <div class="bottom-data-group" style="text-align: right;">
                        <div class="data-label data-label-nis">NOMOR NIS</div>
                        <div class="data-value data-value-nis">{{ $registration->registration_number ?? '2122.10.045' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KARTU BELAKANG -->
    <div class="card card-back">
        <div class="bg-shape bg-shape-1"></div>
        <div class="bg-shape bg-shape-2"></div>
        <div class="bg-shape bg-shape-3"></div>
        
        <div class="gold-tab-left"></div>
        <div class="gold-bar-bottom"></div>

        <div class="content" style="position:relative; z-index:10;">
            <div class="logo-container-back" style="margin: 0 auto 15px auto;">
                <img src="{{ asset('images/logo-da.png') }}" alt="Logo Darel Azhar">
            </div>
            
            <h1>PONDOK PESANTREN<br>MODERN DAREL AZHAR</h1>
            
            <div class="separator-line"></div>
            
            <p>
                {{ $school['alamat'] ?? 'Jl. Pesantren No. 1, Desa Mulia, Kec. Sejahtera, Indonesia' }}
            </p>
            @if(isset($school) && !empty($school['tlp']))
                <p style="margin-top:10px; color: var(--gold-text); font-weight: bold; font-size:9px;">
                    <i class="fa-solid fa-phone"></i> {{ $school['tlp'] }}
                </p>
            @endif
        </div>
    </div>

</body>
</html>
