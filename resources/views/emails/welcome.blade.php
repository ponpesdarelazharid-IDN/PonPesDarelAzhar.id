<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanda Terima Registrasi PPDB - Darel Azhar</title>
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
        
        /* Box Data Singkat */
        .lampiran-info { background-color: transparent; border: 1px dashed #cbd5e1; padding: 15px 20px; text-align: left; margin: 20px 0; font-family: 'Times New Roman', Times, serif; }
        .lampiran-info h3 { margin: 0 0 10px 0; font-size: 15px; text-transform: uppercase; color: #1e242a; text-decoration: underline; }
        .data-list { width: 100%; text-align: left; border-collapse: collapse; }
        .data-list td { padding: 4px 0; vertical-align: top; font-size: 15px; }
        .data-list td:first-child { width: 140px; font-weight: bold; }
        
        /* Tanda Tangan */
        .area-tanda-tangan { margin-top: 50px; display: table; width: 100%; }
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
                <div class="baris-atribut"><span class="label-atribut">Nomor</span>: {{ date('Y') }}/PPDB/DA/BKT-{{ str_pad($registration->id, 4, '0', STR_PAD_LEFT) }}</div>
                <div class="baris-atribut"><span class="label-atribut">Lampiran</span>: -</div>
                <div class="baris-atribut"><span class="label-atribut">Perihal</span>: <strong>Tanda Terima Berkas PPDB</strong></div>
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
                <strong>Sdr/i. {{ strtoupper($registration->full_name) }}</strong><br>
                Di Tempat.
            </div>

            <p><strong><em>Assalamu'alaikum Warahmatullahi Wabarakatuh,</em></strong></p>

            <p>Dengan hormat,<br>
            Puji syukur senantiasa kita panjatkan ke hadirat Allah SWT. Melalui surat (tanda terima) ini, Panitia Penerimaan Peserta Didik Baru (PPDB) Pondok Pesantren Modern Darel Azhar menyatakan bahwa kami telah menerima sepenuhnya pendaftaran formulir dan berkas elektronik atas nama Saudara/i:</p>
            
            <div class="lampiran-info">
                <table class="data-list">
                    <tr>
                        <td>Nomor Registrasi</td>
                        <td>: <strong>{{ $registration->registration_number }}</strong></td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>: {{ $registration->full_name }}</td>
                    </tr>
                    <tr>
                        <td>Asal Sekolah</td>
                        <td>: {{ $registration->origin_school ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Status Berkas</td>
                        <td>: <strong>MENUNGGU PROSES VERIFIKASI</strong></td>
                    </tr>
                </table>
            </div>

            <p>Selanjutnya, panitia akan melakukan validasi dan peninjauan secara menyeluruh terhadap kelengkapan dan keabsahan dokumen persyaratan (Pas Foto, Ijazah, dll) Anda yang telah dikirimkan ke dalam sistem kami.</p>

            <p>Mohon untuk senantiasa memantau menu Status Pendaftaran ('Dashboard') milik Anda di portal resmi secara berkala untuk mengetahui keputusan kelulusan. Segala bentuk pengumuman lanjutan akan kami terbitkan melalui akun tersebut.</p>
            
            <p>Demikian surat tanda terima penyetahan berkas elektronik ini diterbitkan untuk dipergunakan dengan penuh rasa tanggung jawab. Kami haturkan *jazakumullah khairan katsiran* atas kepercayaan Anda mendaftar di pondok pesantren ini.</p>

            <p><strong><em>Wassalamu'alaikum Warahmatullahi Wabarakatuh.</em></strong></p>

        </div>

        <!-- TANDA TANGAN -->
        <div class="area-tanda-tangan">
            <div class="tanda-tangan">
                <p>Hormat kami,<br>Admin/Panitia PPDB Center</p>
                <div class="space-ttd">
                    <!-- Space for digital signature -->
                </div>
                <p class="nama-terang">Panitia Pendaftaran Web</p>
            </div>
            <div class="clear"></div>
        </div>

    </div>
</body>
</html>
