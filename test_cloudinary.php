<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Storage;

echo "Uploading to Cloudinary...\n";
$storage = Storage::disk('cloudinary');

$binary = "This is a test file content.";
$tmpPath = sys_get_temp_dir() . '/' . uniqid() . '.txt';
file_put_contents($tmpPath, $binary);

$file = new \Illuminate\Http\UploadedFile($tmpPath, 'test.txt', 'text/plain', null, true);
$path = $storage->putFile('ppdb/test', $file);

if ($path) {
    echo "SUCCESS. URL: " . $storage->url($path) . "\n";
} else {
    echo "FAILED.\n";
}

@unlink($tmpPath);
