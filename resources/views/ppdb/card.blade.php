<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Pelajar - {{ $registration->full_name ?? 'Darel Azhar' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            /* Palet Warna Sesuai Desain */
            --bg-main: #1e242a; /* Warna latar utama (Abu-abu sangat gelap) */
            --bg-darker: #13171b; /* Warna aksen latar geometris */
            --bg-header: #111417; /* Warna latar header depan */
            --gold-gradient: linear-gradient(145deg, #c08f40 0%, #f9e68c 35%, #d1a34b 65%, #8e621f 100%); /* Efek Emas */
            --gold-gradient-horizontal: linear-gradient(to right, #a1762e, #f2dc83, #d7b057, #a1762e);
            --gold-text: #d4ae5c;
            --text-white: #ffffff;
            --text-gray: #9ba3ab;
            
            /* Dimensi Kartu Standar Landscape (Proporsional) */
            --card-width: 750px;
            --card-height: 470px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #e0e0e0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 40px;
            padding: 50px 20px;
        }

        /* --- STYLING UMUM KARTU --- */
        .card {
            width: var(--card-width);
            height: var(--card-height);
            background-color: var(--bg-main);
            border-radius: 12px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
            display: flex;
            flex-direction: column;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Aksen Geometris Background (Sudut) */
        .bg-shape {
            position: absolute;
            background-color: var(--bg-darker);
            z-index: 1;
        }
        .bg-shape-1 {
            width: 300px;
            height: 300px;
            top: -150px;
            right: -100px;
            transform: rotate(45deg);
            box-shadow: -10px 10px 20px rgba(0,0,0,0.2);
        }
        .bg-shape-2 {
            width: 250px;
            height: 250px;
            bottom: -150px;
            left: -100px;
            transform: rotate(45deg);
            background-color: #171c21;
        }
        .bg-shape-3 { /* Garis miring tambahan di sudut */
            width: 400px;
            height: 50px;
            background-color: #151a1e;
            top: 20px;
            right: -150px;
            transform: rotate(45deg);
        }

        /* Aksen Emas Samping Kiri (Kotak Tepi) */
        .gold-tab-left {
            position: absolute;
            left: 0;
            top: 30%;
            width: 35px;
            height: 40%;
            background: var(--gold-gradient);
            border-radius: 0 8px 8px 0;
            z-index: 5;
        }

        /* Aksen Emas Bawah (Garis bawah) */
        .gold-bar-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 18px;
            background: var(--gold-gradient-horizontal);
            z-index: 5;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        /* --- KARTU BAGIAN BELAKANG (GAMBAR 1) --- */
        .card-back .content {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            text-align: center;
            padding: 0 60px;
        }

        .logo-container-back {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: var(--bg-main);
            border: 6px solid transparent;
            background-image: linear-gradient(var(--bg-main), var(--bg-main)), var(--gold-gradient);
            background-origin: border-box;
            background-clip: content-box, border-box;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            box-shadow: inset 0 0 15px rgba(0,0,0,0.5), 0 5px 15px rgba(0,0,0,0.3);
        }

        .logo-container-back i {
            font-size: 50px;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card-back h1 {
            color: var(--text-white);
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 1.5px;
            line-height: 1.3;
            margin-bottom: 20px;
        }

        .separator-line {
            width: 80%;
            height: 2px;
            background: var(--gold-gradient-horizontal);
            margin-bottom: 20px;
        }

        .card-back p {
            color: var(--text-gray);
            font-size: 16px;
            font-weight: 400;
            line-height: 1.6;
            letter-spacing: 0.5px;
        }


        /* --- KARTU BAGIAN DEPAN (GAMBAR 2) --- */
        .card-front {
            display: flex;
            flex-direction: column;
        }

        .header-front {
            position: relative;
            z-index: 10;
            background-color: var(--bg-header);
            width: 100%;
            height: 100px;
            border-top: 6px solid transparent;
            border-bottom: 6px solid transparent;
            border-image: var(--gold-gradient-horizontal) 1;
            display: flex;
            align-items: center;
            padding: 0 50px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .header-logo i {
            font-size: 45px;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-right: 25px;
        }

        .header-text {
            display: flex;
            flex-direction: column;
        }

        .header-text h2 {
            color: var(--text-white);
            font-size: 32px;
            font-weight: 800;
            letter-spacing: 2px;
            line-height: 1;
        }

        .header-text h3 {
            color: var(--gold-text);
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 3px;
            margin-top: 5px;
        }

        .body-front {
            position: relative;
            z-index: 10;
            display: flex;
            padding: 40px 50px 40px 80px; /* Padding kiri lebih besar untuk area foto */
            flex-grow: 1;
        }

        .photo-container {
            width: 180px;
            height: 220px;
            border: 4px solid transparent;
            background-image: linear-gradient(var(--bg-main), var(--bg-main)), var(--gold-gradient);
            background-origin: border-box;
            background-clip: content-box, border-box;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 40px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.4);
            overflow: hidden; /* pastikan foto tidak keluar dari batas border */
        }

        .photo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 2px;
        }

        .data-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
        }

        .data-group {
            margin-bottom: 18px;
        }

        .data-label {
            color: var(--text-gray);
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }

        .data-value {
            color: var(--text-white);
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .data-value-normal {
            font-weight: 400;
            font-size: 16px;
        }

        /* Garis Pemisah Info Bawah */
        .bottom-divider {
            width: 100%;
            height: 1px;
            background-color: #3b4249;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .bottom-data-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .bottom-data-group {
            flex: 1;
        }

        .bottom-data-group.left {
            border-right: 1px solid #3b4249;
            padding-right: 20px;
        }

        .bottom-data-group.right {
            padding-left: 30px;
        }

        /* Warna khusus untuk NIS */
        .data-label-nis, .data-value-nis {
            color: var(--gold-text);
        }

        /* Responsive scaling jika layar kecil */
        @media (max-width: 800px) {
            .card {
                transform: scale(0.8);
                margin: -40px 0;
            }
        }
        @media (max-width: 600px) {
            .card {
                transform: scale(0.5);
                margin: -100px 0;
            }
        }

        /* Print Specifics */
        .no-print-section {
            background: white;
            padding: 20px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
            width: 100%;
            max-width: var(--card-width);
            margin-bottom: 20px;
        }
        .btn-print {
            background: #1e242a; color: white; padding: 12px 32px; border-radius: 8px; font-weight: 700; border: none; font-size: 14px; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 15px rgba(0,0,0,0.2); 
        }
        .btn-print:hover { background: #13171b; transform: translateY(-2px); }
        .btn-back { color: #64748b; font-size: 13px; font-weight: 600; text-decoration: none; display: block; margin-top: 15px; }
        
        @media print {
            body { background: white; margin: 0; padding: 0; align-items: flex-start; justify-content: flex-start; flex-direction: row; gap: 5mm; }
            .no-print-section { display: none !important; }
            .card {
                /* Mengubah rasio piksel ke ukuran ID fisik secara proper untuk mesin cetak/printer */
                transform: scale(0.43);
                transform-origin: top left;
                box-shadow: none !important;
                page-break-inside: avoid;
                margin: 0 !important;
            }
            @page { size: landscape; margin: 5mm; }
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
                <i class="fa-solid fa-mosque"></i>
            </div>
            <div class="header-text">
                <h2>DAREL AZHAR</h2>
                <h3>KARTU PELAJAR</h3>
            </div>
        </div>

        <div class="body-front">
            <div class="photo-container">
                @if(isset($registration) && $registration->photo_url)
                    <img src="{{ url($registration->photo_url) }}" alt="Foto Siswa">
                @else
                    <div style="width:100%; height:100%; background:#222; display:flex; align-items:center; justify-content:center; color:#555;">FOTO</div>
                @endif
            </div>

            <div class="data-container">
                <div class="data-group">
                    <div class="data-label">NAMA MURID</div>
                    <div class="data-value">{{ $registration->full_name ?? 'AISYAH AZ ZAHRA' }}</div>
                </div>

                <div class="data-group">
                    <div class="data-label">TEMPAT TGL LAHIR</div>
                    <div class="data-value">
                        @if(isset($registration) && $registration->birth_date)
                            {{ strtoupper($registration->birth_place) }}, {{ strtoupper($registration->birth_date->format('d F Y')) }}
                        @else
                            BANDUNG, 12 OKTOBER 2007
                        @endif
                    </div>
                </div>

                <div class="data-group">
                    <div class="data-label">ALAMAT DOMISILI</div>
                    <div class="data-value data-value-normal">{{ $registration->address ?? 'Jl. Anggrek No. 12, Cipete, Jakarta Selatan' }}</div>
                </div>

                <div class="bottom-divider"></div>

                <div class="bottom-data-container">
                    <div class="bottom-data-group left">
                        <div class="data-label">TGL TERDAFTAR</div>
                        <div class="data-value">
                            @if(isset($registration) && $registration->created_at)
                                {{ $registration->created_at->format('d F Y') }}
                            @else
                                15 Juli 2023
                            @endif
                        </div>
                    </div>
                    
                    <div class="bottom-data-group right">
                        <div class="data-label data-label-nis">NO NIS</div>
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

        <div class="content">
            <div class="logo-container-back">
                <i class="fa-solid fa-mosque"></i>
            </div>
            
            <h1>PONDOK PESANTREN<br>MODERN DAREL AZHAR</h1>
            
            <div class="separator-line"></div>
            
            <p>
                {{ $school['alamat'] ?? 'Jl. Pesantren No. 1, Desa Mulia, Kec. Sejahtera, Indonesia' }}
            </p>
            @if(isset($school) && !empty($school['tlp']))
                <p style="margin-top:10px; color: var(--gold-text); font-weight: bold;">
                    <i class="fa-solid fa-phone"></i> {{ $school['tlp'] }}
                </p>
            @endif
        </div>
    </div>

</body>
</html>
