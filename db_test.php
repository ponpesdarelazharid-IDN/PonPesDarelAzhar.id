<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    DB::connection()->getPdo();
    echo "✅ Koneksi Database BERHASIL!\n";
    echo "Database: " . DB::connection()->getDatabaseName() . "\n";
} catch (\Exception $e) {
    echo "❌ Koneksi Database GAGAL!\n";
    echo "Error: " . $e->getMessage() . "\n";
}
