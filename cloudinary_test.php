<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Cloudinary\Cloudinary;

$cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'api_key'    => env('CLOUDINARY_API_KEY'),
        'api_secret' => env('CLOUDINARY_API_SECRET'),
    ],
]);

try {
    $result = $cloudinary->uploadApi()->upload('https://cloudinary-res.cloudinary.com/image/upload/cloudinary_logo.png');
    echo "✅ Koneksi Cloudinary BERHASIL!\n";
    echo "Public ID: " . $result['public_id'] . "\n";
    echo "URL: " . $result['secure_url'] . "\n";
} catch (\Exception $e) {
    echo "❌ Koneksi Cloudinary GAGAL!\n";
    echo "Error: " . $e->getMessage() . "\n";
}
