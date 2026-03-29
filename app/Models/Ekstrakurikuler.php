<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    /** @use HasFactory<\Database\Factories\EkstrakurikulerFactory> */
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'image', 'is_active'];
}
