<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Verifikasi Pendaftaran</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; background-color: #f0f4f8; margin: 0; padding: 30px; color: #1e242a; }
        .surat-container { background-color: #ffffff; max-width: 650px; margin: 0 auto; padding: 40px; border: 1px solid #cbd5e1; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        
        /* Kop Surat Resmi */
        .kop-surat { text-align: center; border-bottom: 3px solid #1a5e20; padding-bottom: 25px; margin-bottom: 30px; position: relative; }
        .kartu-logo { width: 100px; height: auto; margin-bottom: 15px; }
        .kop-title { margin: 0; font-size: 14px; font-weight: bold; letter-spacing: 1px; color: #1e242a; text-transform: uppercase; }
        .kop-nama { margin: 5px 0; font-size: 22px; font-weight: 800; color: #1a5e20; font-family: 'Arial', sans-serif; text-transform: uppercase; }
        .kop-alamat { margin: 0; font-size: 12px; color: #64748b; line-height: 1.5; }
        
        .clear { clear: both; }

        /* Atribut Surat */
        .atribut-surat { margin-bottom: 30px; font-size: 14px; display: table; width: 100%; border-collapse: collapse; }
        .atribut-kiri { display: table-cell; width: 60%; vertical-align: top; }
        .atribut-kanan { display: table-cell; width: 40%; vertical-align: top; text-align: right; }
        .baris-atribut { margin-bottom: 4px; }
        .label-atribut { display: inline-block; width: 70px; }

        /* Isi Surat */
        .isi-surat { font-size: 15px; line-height: 1.6; text-align: justify; }
        .isi-surat p { margin-bottom: 15px; }
        .salam-pembuka { font-weight: bold; margin-bottom: 15px; }
        
        /* Tombol / Call to Action */
        .area-tombol { text-align: center; margin: 35px 0; }
        .btn-action { display: inline-block; background-color: #1e242a; color: #ffffff !important; text-decoration: none; padding: 14px 28px; font-weight: bold; font-family: 'Arial', sans-serif; font-size: 16px; border-radius: 4px; border-left: 6px solid #d1a34b; }
        .info-link { font-size: 12px; color: #64748b; word-break: break-all; margin-top: 20px; font-family: 'Arial', sans-serif; }

        /* Tanda Tangan */
        .area-tanda-tangan { margin-top: 40px; display: table; width: 100%; }
        .tanda-tangan { display: table-cell; width: 300px; text-align: center; font-size: 15px; vertical-align: top; float: right; }
        .tanda-tangan p { margin: 0 0 5px 0; }
        .space-ttd { height: 75px; }
        .nama-terang { font-weight: bold; text-decoration: underline; }
        
        @media only screen and (max-width: 600px) {
            body { padding: 10px; }
            .surat-container { padding: 20px; }
            .kop-surat img { position: static; display: block; margin: 0 auto 10px auto; }
            .kop-teks { margin-left: 0; }
            .atribut-kiri, .atribut-kanan { display: block; width: 100%; text-align: left; margin-bottom: 10px; }
            .tanda-tangan { float: none; width: 100%; margin-top: 30px; text-align: right; }
        }
    </style>
</head>
<body>
    <div class="surat-container">
        
        <!-- KOP SURAT -->
        <div class="kop-surat">
            <img src="{{ $message->embed(public_path('images/logo-da.png')) }}" alt="Logo Darel Azhar" class="kartu-logo">
            
            <div class="kop-teks">
                <h1 class="kop-title">Yayasan Pendidikan Islam</h1>
                <h2 class="kop-nama">Pondok Pesantren Modern Darel Azhar</h2>
                <p class="kop-alamat">
                    {{ $profiles['alamat'] ?? 'Jl. Pesantren No. 1, Desa Mulia, Kec. Sejahtera, Indonesia' }}<br>
                    Telp: {{ $profiles['tlp'] ?? '08123456789' }} | Email: {{ $profiles['email'] ?? 'info@darelazharsystem.id' }}
                </p>
            </div>
            <div class="clear"></div>
        </div>

        <!-- ATRIBUT SURAT -->
        <div class="atribut-surat">
            <div class="atribut-kiri">
                <div class="baris-atribut"><span class="label-atribut">Nomor</span>: {{ date('Y') }}/PPDB/DA/VERIF-{{ strtoupper(Str::random(4)) }}</div>
                <div class="baris-atribut"><span class="label-atribut">Lampiran</span>: -</div>
                <div class="baris-atribut"><span class="label-atribut">Perihal</span>: <strong>Pemberitahuan Verifikasi Pendaftaran</strong></div>
            </div>
            <div class="atribut-kanan">
                Banten, {{ date('d F Y') }}
            </div>
            <div class="clear"></div>
        </div>

        <!-- ISI SURAT -->
        <div class="isi-surat">
            <div class="salam-pembuka">
                Kepada Yth,<br>
                <strong>Calon Santri / Orang Tua Wali</strong><br>
                Di Tempat.
            </div>

            <p><strong><em>Assalamu'alaikum Warahmatullahi Wabarakatuh,</em></strong></p>

            <p>Dengan hormat,<br>
            Puji syukur senantiasa kita panjatkan ke hadirat Allah SWT. Bersama surat (email) ini, kami memberitahukan bahwa Anda telah melakukan proses pendaftaran akun di portal Penerimaan Peserta Didik Baru (PPDB) Pondok Pesantren Modern Darel Azhar.</p>
            
            <p>Demi menjaga keamanan data pendaftaran, kami mewajibkan setiap calon santri untuk melakukan validasi alamat surat elektronik (Email) yang digunakan mendaftar. Mohon kesediaannya untuk <strong>menekan (klik) tombol pengesahan</strong> di bawah ini agar akun pendaftaran Anda dapat segera diaktifkan:</p>

            <div class="area-tombol">
                <a href="{{ $url }}" class="btn-action">Sah-kan Pendaftaran Sekarang</a>
            </div>

            <p>Apabila Anda tidak merasa mendaftar di portal PPDB Darel Azhar, mohon abaikan surat (email) ini secara otomatis.</p>
            
            <p>Demikian surat pemberitahuan verifikasi ini kami sampaikan. Atas perhatian dan kerja samanya, kami ucapkan jazakumullah khairan katsiran.</p>

            <p><strong><em>Wassalamu'alaikum Warahmatullahi Wabarakatuh.</em></strong></p>

        </div>

        <!-- TANDA TANGAN -->
        <div class="area-tanda-tangan">
            <div class="tanda-tangan">
                <p>Hormat kami,</p>
                <p><strong>Panitia PPDB Darel Azhar</strong></p>
                <div class="space-ttd">
                    <!-- Space for digital signature -->
                </div>
                <p class="nama-terang">Mudirul Ma'had</p>
            </div>
            <div class="clear"></div>
        </div>

        <div style="border-top: 1px dashed #cbd5e1; margin-top: 40px; padding-top: 15px; font-size: 11px; color: #94a3b8; text-align: center; font-family: 'Arial', sans-serif;">
            Jika tombol di atas tidak berfungsi, salin dan tempel tautan berikut ke browser Anda:<br>
            <span style="color:#3b82f6;">{{ $url }}</span>
        </div>

    </div>
</body>
</html>
