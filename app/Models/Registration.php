<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $guarded = [];

    protected $casts = [
        'birth_date' => 'date',
    ];

    protected static function booted()
    {
        static::creating(function ($registration) {
            if (!$registration->registration_number) {
                $year = date('Y');
                $lastRegistration = static::whereYear('created_at', $year)
                    ->orderBy('id', 'desc')
                    ->first();

                $number = $lastRegistration ? (int) substr($lastRegistration->registration_number, -4) + 1 : 1;
                $registration->registration_number = 'PPDB-' . $year . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ppdbSetting()
    {
        return $this->belongsTo(PpdbSetting::class);
    }

    public function getPhotoUrlAttribute()
    {
        if (!$this->photo_path) {
            return null;
        }

        if (filter_var($this->photo_path, FILTER_VALIDATE_URL)) {
            return $this->photo_path;
        }

        return \Illuminate\Support\Facades\Storage::disk(config('filesystems.default', 'cloudinary'))->url($this->photo_path);
    }
}
