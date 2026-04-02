<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    /** @use HasFactory<\Database\Factories\EkstrakurikulerFactory> */
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'image', 'is_active'];

    public function getImageAttribute($value)
    {
        if (!$value) return null;
        if (filter_var($value, FILTER_VALIDATE_URL)) return $value;

        return \Illuminate\Support\Facades\Storage::disk('cloudinary')->url($value);
    }
}
