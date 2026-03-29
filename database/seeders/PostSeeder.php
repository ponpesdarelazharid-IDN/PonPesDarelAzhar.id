<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::where('role', 'admin')->first() ?? \App\Models\User::factory()->create(['role' => 'admin']);

        // Berita
        for ($i = 1; $i <= 3; $i++) {
            \App\Models\Post::create([
                'user_id' => $admin->id,
                'title' => "Berita Sekolah Ke-$i",
                'slug' => "berita-sekolah-$i",
                'excerpt' => "Ini adalah ringkasan berita sekolah yang sangat menarik ke-$i.",
                'content' => "Konten lengkap berita sekolah ke-$i yang berisi informasi detail mengenai kegiatan terbaru.",
                'type' => 'berita',
                'published_at' => now(),
            ]);
        }

        // Acara
        for ($i = 1; $i <= 3; $i++) {
            \App\Models\Post::create([
                'user_id' => $admin->id,
                'title' => "Agenda Kegiatan $i",
                'slug' => "agenda-kegiatan-$i",
                'content' => "Informasi mengenai agenda kegiatan sekolah $i yang akan dilaksanakan segera.",
                'type' => 'acara',
                'event_date' => now()->addDays($i * 2),
                'published_at' => now(),
            ]);
        }

        // Prestasi
        for ($i = 1; $i <= 3; $i++) {
            \App\Models\Post::create([
                'user_id' => $admin->id,
                'title' => "Juara Lomba Tingkat Nasional $i",
                'slug' => "juara-lomba-$i",
                'content' => "Siswa kami berhasil meraih prestasi gemilang di ajang perlombaan ke-$i.",
                'type' => 'prestasi',
                'published_at' => now(),
            ]);
        }
    }
}
