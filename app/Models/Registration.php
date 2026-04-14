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

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getTotalRequiredAttribute()
    {
        $isMts = str_contains(strtoupper($this->education_level), 'MTS');
        $isPutra = strtoupper($this->gender) === 'L';

        if ($isMts) {
            return $isPutra ? 6900000 : 7000000;
        } else {
            return $isPutra ? 6326000 : 6426000;
        }
    }

    public function getTotalPaidAttribute()
    {
        return $this->payments()->where('status', 'verified')->sum('amount');
    }

    public function getPaymentRemainingAttribute()
    {
        return max(0, $this->total_required - $this->total_paid);
    }

    public function getPaymentProgressAttribute()
    {
        if ($this->total_required <= 0) return 100;
        return min(100, round(($this->total_paid / $this->total_required) * 100));
    }

    public function getFeeBreakdownAttribute()
    {
        $isMts = str_contains(strtoupper($this->education_level), 'MTS');
        $isPutra = strtoupper($this->gender) === 'L';

        $items = [
            ['name' => "Uang Organisasi Santri 1 Tahun", 'price' => 200000],
            ['name' => "Uang Meja dan Kursi", 'price' => 500000],
            ['name' => "Dana Perluasan Wakaf (Pondok)", 'price' => 1700000],
            ['name' => "Uang Ujian 1 Tahun", 'price' => 200000],
            ['name' => "Almari & Kasur (Pribadi)", 'price' => 1000000],
            ['name' => "Iuran Makan Bulan Juli", 'price' => 350000],
            ['name' => "Uang Asrama, Air, Listrik (Juli)", 'price' => 345000],
            ['name' => "Map Raport", 'price' => 50000],
            ['name' => "Majalah (Al-Azhar & Wardah)", 'price' => 100000],
            ['name' => "Cuci Pakaian / Laundry (Pribadi)", 'price' => 90000],
            ['name' => "Pekan Perkenalan (Ta'aruf)", 'price' => 90000],
        ];

        // Bookshop
        if ($isMts) {
            $items[] = ['name' => "Paket Bookshop MTs", 'price' => 1200000];
        } else {
            $items[] = ['name' => "Paket Bookshop SMA/MA", 'price' => 626000];
        }

        // Uniforms
        $items[] = ['name' => "Seragam Pramuka", 'price' => $isPutra ? 170000 : 215000];
        $items[] = ['name' => "Seragam Olahraga", 'price' => 175000];
        $items[] = ['name' => "Seragam Hitam Putih", 'price' => $isPutra ? 175000 : 215000];
        $items[] = ['name' => "Seragam Koko/Jubah", 'price' => $isPutra ? 180000 : 195000];
        $items[] = ['name' => "Seragam Silat", 'price' => 175000];

        // Adjustment factor to reach total (as per requirement total - calculated items)
        $currentSum = collect($items)->sum('price');
        $diff = $this->total_required - $currentSum;
        if ($diff > 0) {
            $items[] = ['name' => "Biaya Operasional & Pendaftaran", 'price' => $diff];
        }

        return $items;
    }

    public function getPhotoUrlAttribute($value)
    {
        if (!$value) return asset('images/default-avatar.png');
        if (filter_var($value, FILTER_VALIDATE_URL)) return $value;
        try {
            return \Illuminate\Support\Facades\Storage::disk('cloudinary')->url($value);
        } catch (\Exception $e) {
            return asset('images/default-avatar.png');
        }
    }

    public function getBirthCertUrlAttribute($value)
    {
        if (!$value) return null;
        if (filter_var($value, FILTER_VALIDATE_URL)) return $value;
        try {
            return \Illuminate\Support\Facades\Storage::disk('cloudinary')->url($value);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getIjazahUrlAttribute($value)
    {
        if (!$value) return null;
        if (filter_var($value, FILTER_VALIDATE_URL)) return $value;
        try {
            return \Illuminate\Support\Facades\Storage::disk('cloudinary')->url($value);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getSkhuUrlAttribute($value)
    {
        if (!$value) return null;
        if (filter_var($value, FILTER_VALIDATE_URL)) return $value;
        try {
            return \Illuminate\Support\Facades\Storage::disk('cloudinary')->url($value);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getFamilyCardUrlAttribute($value)
    {
        if (!$value) return null;
        if (filter_var($value, FILTER_VALIDATE_URL)) return $value;
        try {
            return \Illuminate\Support\Facades\Storage::disk('cloudinary')->url($value);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getKtpParentUrlAttribute($value)
    {
        if (!$value) return null;
        if (filter_var($value, FILTER_VALIDATE_URL)) return $value;
        try {
            return \Illuminate\Support\Facades\Storage::disk('cloudinary')->url($value);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getPaymentReceiptUrlAttribute($value)
    {
        if (!$value) return null;
        if (filter_var($value, FILTER_VALIDATE_URL)) return $value;
        try {
            return \Illuminate\Support\Facades\Storage::disk('cloudinary')->url($value);
        } catch (\Exception $e) {
            return null;
        }
    }
}
