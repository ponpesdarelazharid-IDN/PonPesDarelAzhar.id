<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Registration;

$regs = Registration::all();
echo "TOTAL_REGISTRATIONS: " . $regs->count() . "\n";
foreach($regs as $r) {
    echo "ID: {$r->id} | Name: {$r->full_name} | File: " . ($r->payment_receipt_url ? 'YES' : 'NO') . " | Status: {$r->status} | UserID: {$r->user_id}\n";
}
