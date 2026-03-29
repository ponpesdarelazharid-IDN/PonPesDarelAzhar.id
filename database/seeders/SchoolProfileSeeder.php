<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolProfile;

class SchoolProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = [
            'nama_sekolah' => 'Pondok Pesantren Modern Darel Azhar',
            'profil_sekolah' => 'Lembaga pendidikan Islam yang memadukan kurikulum pesantren dan sekolah umum untuk mencetak generasi Qurani yang berwawasan global.',
            'sejarah' => 'Darel Azhar didirikan dengan visi besar untuk menciptakan harmoni antara intelektualitas dan spritualitas di Banten.',
            'visi' => 'Terwujudnya Lembaga Pendidikan Islam yang Unggul dalam Imtaq dan Iptek.',
            'misi' => "- Menyelenggarakan pendidikan formal dan non-formal yang berkualitas.\n- Membina santri dengan akhlakul karimah.\n- Mencetak kader umat yang siap mengabdi di masyarakat.",
            'tujuan' => 'Menghasilkan lulusan yang hafal Quran, cakap berbahasa asing, dan berprestasi akademik.',
            'alamat' => 'Jl. Komp. Pendidikan No.RT 08/09, Muara Ciujung Tim., Kec. Rangkasbitung, Kabupaten Lebak, Banten 42314',
            'email' => 'info@darel-azhar.sch.id',
            'tlp' => '0812-3456-7890',
            'google_maps_url' => 'https://maps.app.goo.gl/YourMapLink',
        ];

        foreach ($profiles as $key => $value) {
            \App\Models\SchoolProfile::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
