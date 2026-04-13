<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Suppress outputting deprecation warnings to the browser in PHP 8.4/8.5
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
ini_set('display_errors', '0');

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

try {
    $app->handleRequest(Request::capture());
} catch (\Throwable $e) {
    if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
        header('Content-Type: text/plain');
        echo "=== VERCEL LARAVEL CRASH ===\n";
        echo "Message: " . $e->getMessage() . "\n";
        echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
        echo "Trace:\n" . $e->getTraceAsString() . "\n\n";
        if ($prev = $e->getPrevious()) {
            echo "=== PREVIOUS EXCEPTION ===\n";
            echo "Message: " . $prev->getMessage() . "\n";
            echo "File: " . $prev->getFile() . ":" . $prev->getLine() . "\n";
        }
        exit(1);
    }
    throw $e;
}
