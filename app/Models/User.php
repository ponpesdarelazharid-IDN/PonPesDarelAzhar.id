<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'otp_code',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function registration()
    {
        return $this->hasOne(Registration::class);
    }

    /**
     * Override verification notification to be resilient against SMTP failures.
     */
    public function sendEmailVerificationNotification()
    {
        try {
            $this->notify(new \Illuminate\Auth\Notifications\VerifyEmail);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('SMTP Error: Gagal mengirim email verifikasi. ' . $e->getMessage());
        }
    }
}
