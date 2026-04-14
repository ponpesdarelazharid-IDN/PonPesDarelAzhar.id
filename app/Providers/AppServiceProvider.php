<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

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

        // Hard Override Cloudinary Config (Bypass Vercel Cache & Sanitization)
        $sanitize = function($val) {
            if (!$val || str_contains($val, '<') || str_contains($val, 'your_')) return null;
            return $val;
        };

        config([
            'filesystems.disks.cloudinary' => [
                'driver' => 'cloudinary',
                'cloud' => $sanitize(env('CLOUDINARY_CLOUD_NAME')),
                'key' => $sanitize(env('CLOUDINARY_API_KEY')),
                'secret' => $sanitize(env('CLOUDINARY_API_SECRET')),
                'url' => $sanitize(env('CLOUDINARY_URL')),
            ],
            'cloudinary.cloud_url' => $sanitize(env('CLOUDINARY_URL'))
        ]);

        // Global share school profiles to all views (Bulletproof version)
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            try {
                $pluck = \App\Models\SchoolProfile::pluck('value', 'key')->toArray();
                
                // Override image keys with full URLs via the helper
                $pluck['logo'] = \App\Models\SchoolProfile::getValue('logo');
                $pluck['hero_image'] = \App\Models\SchoolProfile::getValue('hero_image');
                $pluck['secondary_image'] = \App\Models\SchoolProfile::getValue('secondary_image');

                $view->with('profiles', $pluck);
            } catch (\Exception $e) {
                // Fallback to empty array if DB or models fail
                $view->with('profiles', []);
            }
        });

        // Kustomisasi Email Verifikasi menjadi format Surat Resmi Kop Sekolah
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Pemberitahuan: Verifikasi Alamat Surat Elektronik (Email) PPDB Darel Azhar')
                ->view('emails.verify', ['url' => $url, 'user' => $notifiable]);
        });
    }
}
