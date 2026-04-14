<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PpdbSetting;

class PpdbSettingSeeder extends Seeder
{
    public function run(): void
    {
        PpdbSetting::create([
            'academic_year' => '2024/2025',
            'is_open' => true,
            'open_date' => now(),
            'close_date' => now()->addMonths(6),
            'quota' => 250,
            'requirements' => "1. Fotokopi Ijazah (2 Lembar)\n2. Fotokopi Akta Kelahiran\n3. Fotokopi Kartu Keluarga\n4. Pas Foto 3x4 (4 Lembar)",
        ]);
    }
}
