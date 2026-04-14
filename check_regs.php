<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Registration;

$regs = Registration::latest()->take(5)->get();
echo "COUNT: " . $regs->count() . "\n";
foreach($regs as $r) {
    echo "ID: {$r->id} | Name: {$r->full_name} | File: " . ($r->payment_receipt_url ? 'YES' : 'NO') . " | Status: {$r->status}\n";
    if ($r->payment_receipt_url) {
        echo "   URL: {$r->payment_receipt_url}\n";
    }
}
