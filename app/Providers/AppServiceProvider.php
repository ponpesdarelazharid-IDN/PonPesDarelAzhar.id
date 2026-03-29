<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (isset($_SERVER['VERCEL_URL']) || env('APP_ENV') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Global share school profiles to all views
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $view->with('profiles', \App\Models\SchoolProfile::pluck('value', 'key')->toArray());
        });
    }
}
