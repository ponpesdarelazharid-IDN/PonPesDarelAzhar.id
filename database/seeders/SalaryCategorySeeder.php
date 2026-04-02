<?php

namespace Database\Seeders;

use App\Models\SalaryCategory;
use Illuminate\Database\Seeder;

class SalaryCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // === FIXED (dipotong duluan, nominal tetap) ===
            [
                'name'        => 'Kampus',
                'type'        => 'fixed',
                'value'       => 0,
                'priority'    => 1,
                'icon'        => '🎓',
                'color'       => '#6366f1',
                'description' => 'Biaya pendidikan / kampus bulanan',
            ],
            [
                'name'        => 'Pajak Kendaraan',
                'type'        => 'fixed',
                'value'       => 0,
                'priority'    => 2,
                'icon'        => '🚗',
                'color'       => '#f59e0b',
                'description' => 'Pajak STNK kendaraan (dibagi 12 bulan)',
            ],
            [
                'name'        => 'Service Kendaraan',
                'type'        => 'fixed',
                'value'       => 0,
                'priority'    => 3,
                'icon'        => '🔧',
                'color'       => '#ef4444',
                'description' => 'Biaya servis rutin kendaraan per bulan',
            ],
            [
                'name'        => 'Kebutuhan Harian',
                'type'        => 'fixed',
                'value'       => 0,
                'priority'    => 4,
                'icon'        => '🛵',
                'color'       => '#10b981',
                'description' => 'Bensin, makan, rokok — kebutuhan harian selama sebulan',
            ],
            [
                'name'        => 'Bayar Air',
                'type'        => 'fixed',
                'value'       => 0,
                'priority'    => 5,
                'icon'        => '💧',
                'color'       => '#06b6d4',
                'description' => 'Tagihan air PDAM bulanan',
            ],
            [
                'name'        => 'Bayar Listrik',
                'type'        => 'fixed',
                'value'       => 0,
                'priority'    => 6,
                'icon'        => '⚡',
                'color'       => '#eab308',
                'description' => 'Tagihan listrik PLN bulanan',
            ],
            [
                'name'        => 'Arisan',
                'type'        => 'fixed',
                'value'       => 0,
                'priority'    => 7,
                'icon'        => '🤝',
                'color'       => '#ec4899',
                'description' => 'Setoran arisan bulanan',
            ],
            [
                'name'        => 'Belanja Bulanan',
                'type'        => 'fixed',
                'value'       => 0,
                'priority'    => 8,
                'icon'        => '🛒',
                'color'       => '#8b5cf6',
                'description' => 'Belanja kebutuhan rumah tangga bulanan',
            ],
            [
                'name'        => 'BPJS Kesehatan',
                'type'        => 'fixed',
                'value'       => 0,
                'priority'    => 9,
                'icon'        => '🏥',
                'color'       => '#14b8a6',
                'description' => 'Iuran BPJS Kesehatan bulanan',
            ],
            [
                'name'        => 'Internet & Komunikasi',
                'type'        => 'fixed',
                'value'       => 0,
                'priority'    => 10,
                'icon'        => '📱',
                'color'       => '#3b82f6',
                'description' => 'Tagihan internet rumah & paket data HP',
            ],

            // === PERCENTAGE (dihitung dari sisa setelah fixed) ===
            [
                'name'        => 'Dana Darurat',
                'type'        => 'percentage',
                'value'       => 10,
                'priority'    => 11,
                'icon'        => '🚨',
                'color'       => '#f97316',
                'description' => '10% dari sisa gaji — cadangan untuk keperluan mendesak',
            ],
            [
                'name'        => 'Tabungan',
                'type'        => 'percentage',
                'value'       => 20,
                'priority'    => 12,
                'icon'        => '🏦',
                'color'       => '#22c55e',
                'description' => '20% dari sisa gaji — tabungan rutin',
            ],
        ];

        foreach ($categories as $cat) {
            SalaryCategory::updateOrCreate(
                ['name' => $cat['name']],
                $cat
            );
        }

        $this->command->info('✅ ' . count($categories) . ' pos pengeluaran gaji berhasil di-seed!');
    }
}
