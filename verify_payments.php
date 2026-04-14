<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Registration;

$regs = Registration::whereNotNull('payment_receipt_url')->get();
echo "PAYMENTS_FOUND: " . $regs->count() . "\n";
foreach($regs as $r) {
    echo "ID: {$r->id} | Name: {$r->full_name} | URL: {$r->payment_receipt_url} | Status: {$r->status}\n";
}
if ($regs->count() === 0) {
    echo "NO_PAYMENTS_YET\n";
    // Check for any drafts
    $drafts = Registration::where('status', 'draft')->get();
    echo "DRAFTS_FOUND: " . $drafts->count() . "\n";
}
