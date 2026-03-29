<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbSetting extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_open' => 'boolean',
        'open_date' => 'date',
        'close_date' => 'date',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
