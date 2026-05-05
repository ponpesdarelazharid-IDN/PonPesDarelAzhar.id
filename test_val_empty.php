<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegistrationRequest;

$req = new RegistrationRequest();
$req->merge([]); // empty POST

$validator = Validator::make($req->all(), $req->rules(), $req->messages());

if ($validator->fails()) {
    echo "FAILS!\n";
    print_r($validator->errors()->all());
} else {
    echo "PASS!\n";
}
