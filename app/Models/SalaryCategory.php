<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalaryCategory extends Model
{
    protected $table = 'salary_categories';

    protected $fillable = [
        'name',
        'type',
        'value',
        'priority',
        'icon',
        'color',
        'is_active',
        'description',
    ];

    protected $casts = [
        'value'     => 'decimal:2',
        'is_active' => 'boolean',
        'priority'  => 'integer',
    ];

    public function allocations(): HasMany
    {
        return $this->hasMany(SalaryAllocation::class, 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFixed($query)
    {
        return $query->where('type', 'fixed');
    }

    public function scopePercentage($query)
    {
        return $query->where('type', 'percentage');
    }

    public function getFormattedValueAttribute(): string
    {
        if ($this->type === 'fixed') {
            return 'Rp ' . number_format($this->value, 0, ',', '.');
        }
        return $this->value . '%';
    }
}
