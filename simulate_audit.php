<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\Registration;
use Illuminate\Support\Facades\Hash;

$email = 'santri.audit.final@example.com';
echo "Starting simulation for: $email\n";

$u = User::updateOrCreate(
    ['email' => $email],
    ['name' => 'Santri Audit Final', 'password' => Hash::make('Password123!'), 'role' => 'pendaftar']
);

$setting = \App\Models\PpdbSetting::first();
if (!$setting) {
    echo "ERROR: Run PpdbSettingSeeder first!\n";
    exit;
}

$r = Registration::updateOrCreate(
    ['user_id' => $u->id],
    [
        'ppdb_setting_id' => $setting->id,
        'full_name' => 'Santri Audit Final',
        'nisn' => '1122334455',
        'gender' => 'L',
        'birth_place' => 'Jakarta',
        'birth_date' => '2010-05-15',
        'address' => 'Jl. Jenderal Sudirman No. 1 Audit',
        'status' => 'accepted',
        'registration_number' => 'PPDB-2024-TEST-99',
        'education_level' => 'SMA',
        'origin_school' => 'SMP Audit'
    ]
);

echo "SUCCESS|USER: " . $u->email . "|REG: " . $r->registration_number . "|STATUS: " . $r->status . "\n";
