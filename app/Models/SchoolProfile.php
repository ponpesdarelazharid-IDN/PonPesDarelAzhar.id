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

            // EMERGENCY NUKE: Disable Cloudinary disk access to prevent 500 errors
            // return \Illuminate\Support\Facades\Storage::disk('cloudinary')->url($value);
            return null; 
        }

        return $profile->value;
    }
}
