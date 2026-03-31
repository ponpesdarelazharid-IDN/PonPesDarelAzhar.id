<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Pelajar - {{ $registration->full_name ?? 'Darel Azhar' }}</title>
    <style>
      /* Styling Container Kartu */
      .kartu-pelajar {
        width: 350px;
        height: auto;
        border: 2px solid #1a5e20; /* Warna hijau senada logo */
        border-radius: 12px;
        background-color: #ffffff;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
        overflow: hidden;
        margin: 20px auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-bottom: 20px;
      }

      /* Header Kartu (Logo dan Judul) */
      .kartu-header {
        background-color: #f8f9fa;
        width: 100%;
        padding: 15px 0;
        text-align: center;
        border-bottom: 3px solid #d32f2f; /* Warna merah senada logo */
      }

      .kartu-logo {
        width: 70px;
        height: auto;
        margin-bottom: 10px;
      }

      .kartu-header h2 {
        margin: 0;
        font-size: 14px;
        color: #333;
      }

      .kartu-header h3 {
        margin: 5px 0 0 0;
        font-size: 12px;
        color: #1a5e20;
      }

      /* Body Kartu (Data Siswa) */
      .kartu-body {
        padding: 20px;
        width: 100%;
        box-sizing: border-box;
        text-align: center;
      }

      .foto-siswa {
        width: 120px;
        height: 160px;
        background-color: #e0e0e0;
        border: 2px solid #ccc;
        margin: 0 auto 15px auto;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
      }

      .foto-siswa img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .data-siswa {
        text-align: left;
        font-size: 13px;
        line-height: 1.8;
        color: #333;
        background: #f9f9f9;
        padding: 15px;
        border-radius: 8px;
      }

      .data-siswa strong {
        color: #1a5e20;
        width: 100px;
        display: inline-block;
      }

      @media print {
        .no-print { display: none; }
        body { background: white; }
        .kartu-pelajar { box-shadow: none; border: 1px solid #1a5e20; }
      }

      .btn-print {
        display: block;
        width: 200px;
        margin: 20px auto;
        padding: 10px;
        background: #1a5e20;
        color: white;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
      }
    </style>
</head>
<body style="background: #f4f4f4; padding: 20px;">

    <div class="no-print" style="text-align: center; margin-bottom: 20px;">
        <button onclick="window.print()" class="btn-print">CETAK KARTU</button>
        <a href="{{ route('ppdb.status') }}" style="color: #666; font-size: 12px; display: block; margin-top: 10px;">Kembali ke Dashboard</a>
    </div>

    <div class="kartu-pelajar">
        <div class="kartu-header">
            <img src="{{ asset('images/logo-da.png') }}" alt="Logo Darel Azhar" class="kartu-logo">
            <h2>PONPES MODERN DAREL-AZHAR</h2>
            <h3>KARTU PELAJAR</h3>
        </div>
        <div class="kartu-body">
            <div class="foto-siswa">
                @if(isset($registration) && $registration->photo_url)
                    <img src="{{ $registration->photo_url }}" alt="Foto Siswa">
                @else
                    <span style="font-size: 12px; color: #999;">FOTO 3x4</span>
                @endif
            </div>
            <div class="data-siswa">
                <strong>Nama:</strong> {{ $registration->full_name ?? 'Fulan bin Fulan' }}<br>
                <strong>NIS:</strong> {{ $registration->registration_number ?? '123456789' }}<br>
                <strong>Kamar:</strong> {{ $registration->room ?? '-' }}<br>
                <strong>Alamat:</strong> {{ $registration->address ?? 'Rangkasbitung' }}
            </div>
        </div>
    </div>

</body>
</html>
