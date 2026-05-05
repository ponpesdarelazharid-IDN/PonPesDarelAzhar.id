<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    Illuminate\Support\Facades\Password::sendResetLink(['email' => 'admin@ponpesdarelazhar.id']);
    echo "SUCCESS\n";
} catch (\Exception $e) {
    echo "ERROR: " . get_class($e) . " - " . $e->getMessage() . "\n";
}
