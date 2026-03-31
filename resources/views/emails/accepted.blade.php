<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Kelulusan Santri Baru - Darel Azhar</title>
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
        
        /* Box / Kartu Preview */
        .lampiran-info { background-color: #f8fafc; border: 1px dashed #94a3b8; padding: 20px; text-align: center; margin: 25px 0; font-family: 'Arial', sans-serif; }
        .lampiran-info h3 { margin: 0 0 10px 0; font-size: 14px; text-transform: uppercase; color: #64748b; }
        .lampiran-info .nis-box { font-size: 28px; font-weight: 900; color: #1e242a; letter-spacing: 2px; border-bottom: 2px solid #d1a34b; display: inline-block; padding-bottom: 5px; margin-bottom: 20px; }

        /* Tombol / Call to Action */
        .area-tombol { text-align: center; margin: 30px 0 20px 0; }
        .btn-action { display: inline-block; background-color: #1e242a; color: #ffffff !important; text-decoration: none; padding: 14px 28px; font-weight: bold; font-family: 'Arial', sans-serif; font-size: 16px; border-radius: 4px; border-left: 6px solid #d1a34b; }

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
                <div class="baris-atribut"><span class="label-atribut">Nomor</span>: {{ date('Y') }}/PPDB/DA/LULUS-{{ str_pad($registration->id, 4, '0', STR_PAD_LEFT) }}</div>
                <div class="baris-atribut"><span class="label-atribut">Lampiran</span>: Bukti Penerimaan & Kartu Digital</div>
                <div class="baris-atribut"><span class="label-atribut">Perihal</span>: <strong>Keputusan Kelulusan Calon Santri</strong></div>
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
                <strong>Bapak/Ibu Orang Tua/Wali dari Ananda {{ strtoupper($registration->full_name) }}</strong><br>
                Di Tempat.
            </div>

            <p><strong><em>Assalamu'alaikum Warahmatullahi Wabarakatuh,</em></strong></p>

            <p>Dengan hormat,<br>
            Berdasarkan hasil Rapat Panitia Penerimaan Peserta Didik Baru (PPDB) Pondok Pesantren Modern Darel Azhar dan evaluasi berkas pendaftaran calon santri:</p>
            
            <ul style="list-style-type: none; padding-left: 0; margin-left: 20px;">
                <li><strong>Nama Lengkap:</strong> {{ $registration->full_name }}</li>
                <li><strong>Asal Sekolah:</strong> {{ $registration->previous_school ?? '-' }}</li>
            </ul>

            <p>Maka dengan penuh rasa syukur, kami memutuskan bahwa santri yang tercantum namanya di atas secara resmi dinyatakan <strong>LULUS SELEKSI</strong> dan <strong>DITERIMA</strong> sebagai santri/wati baru di Pondok Pesantren Modern Darel Azhar Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}.</p>

            <div class="lampiran-info">
                <h3>Nomor Induk Santri (NIS) Telah Diterbitkan:</h3>
                <div class="nis-box">{{ $registration->registration_number }}</div>
                <p style="margin:0; font-size:13px;">Gunakan nomor induk ini untuk keperluan administrasi pendidikan dan keuangan pondok.</p>
                
                <div class="area-tombol">
                    <a href="{{ route('ppdb.register.card') }}" class="btn-action">Tampilkan & Cetak Kartu Pelajar Digital Resmi</a>
                </div>
            </div>
            
            <p>Berkenaan dengan keputusan tersebut, kami mohon Bapak/Ibu segera menyelesaikan prosedur pendaftaran ulang serta mencetak <strong>Kartu Pelajar Digital</strong> (kartu tanda pengenal santri sah) melalui portal elektronik sekolah, dengan menekan tombol (tautan) yang terlampir di dalam dokumen ini.</p>
            
            <p>Demikian surat keputusan dan pemberitahuan kelulusan ini diterbitkan untuk dipergunakan sebagaimana mestinya. Kami sampaikan tahniah dan *Mabruk* atas bergabungnya Ananda; semoga kelak menjadi santri yang berakhlak mulia dan senantiasa dirahmati Allah SWT.</p>

            <p><strong><em>Wassalamu'alaikum Warahmatullahi Wabarakatuh.</em></strong></p>

        </div>

        <!-- TANDA TANGAN -->
        <div class="area-tanda-tangan">
            <div class="tanda-tangan">
                <p>Hormat kami,</p>
                <p><strong>Ketua Panitia PMB PPDB</strong></p>
                <div class="space-ttd">
                    <!-- Space for digital signature -->
                </div>
                <p class="nama-terang">Mudirul Ma'had</p>
            </div>
            <div class="clear"></div>
        </div>

    </div>
</body>
</html>
