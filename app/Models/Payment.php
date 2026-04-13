<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'registration_payments';
    
    protected $guarded = [];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function getAmountFormattedAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function getReceiptUrlAttribute($value)
    {
        if (!$value) return null;
        if (filter_var($value, FILTER_VALIDATE_URL)) return $value;
        return \Illuminate\Support\Facades\Storage::disk('cloudinary')->url($value);
    }
}
