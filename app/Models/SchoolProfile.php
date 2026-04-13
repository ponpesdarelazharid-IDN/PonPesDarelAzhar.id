<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    protected $fillable = ['key', 'value'];

    public static function getValue($key)
    {
        $profile = static::where('key', $key)->first();
        if (!$profile) return null;

        $images = ['logo', 'hero_image', 'secondary_image'];
        if (in_array($key, $images)) {
            $value = $profile->value;
            if (!$value) return null;
            if (filter_var($value, FILTER_VALIDATE_URL)) return $value;

            try {
                return \Illuminate\Support\Facades\Storage::disk('cloudinary')->url($value);
            } catch (\Exception $e) {
                // Return null if cloudinary fails instead of crashing the whole app
                return null;
            }
        }

        return $profile->value;
    }
}
