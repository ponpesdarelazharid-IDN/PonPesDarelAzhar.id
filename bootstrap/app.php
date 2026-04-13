<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Throwable $e) {
            if (request()->is('register') || request()->is('admin/*')) {
                return response()->make("DEBUG ERROR: " . $e->getMessage() . "\n\n" . $e->getTraceAsString(), 500, ['Content-Type' => 'text/plain']);
            }
        });
    })->create();

if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || getenv('VERCEL')) {
    $app->useStoragePath('/tmp/storage');
    // Force Laravel to look in /tmp for service and package manifests
    // This solves "Target class [view] does not exist" caused by Vercel build VM absolute paths
    putenv('APP_SERVICES_CACHE=/tmp/storage/bootstrap/cache/services.php');
    putenv('APP_PACKAGES_CACHE=/tmp/storage/bootstrap/cache/packages.php');
    putenv('APP_CONFIG_CACHE=/tmp/storage/bootstrap/cache/config.php');
    putenv('APP_ROUTES_CACHE=/tmp/storage/bootstrap/cache/routes-v7.php');
    putenv('APP_EVENTS_CACHE=/tmp/storage/bootstrap/cache/events.php');
    $_ENV['APP_SERVICES_CACHE'] = '/tmp/storage/bootstrap/cache/services.php';
    $_ENV['APP_PACKAGES_CACHE'] = '/tmp/storage/bootstrap/cache/packages.php';
    $_ENV['APP_CONFIG_CACHE'] = '/tmp/storage/bootstrap/cache/config.php';
    $_ENV['APP_ROUTES_CACHE'] = '/tmp/storage/bootstrap/cache/routes-v7.php';
    $_ENV['APP_EVENTS_CACHE'] = '/tmp/storage/bootstrap/cache/events.php';

    $paths = [
        '/tmp/storage/bootstrap/cache',
        '/tmp/storage/framework/cache/data',
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/logs',
    ];
    foreach ($paths as $path) {
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }
}

return $app;
