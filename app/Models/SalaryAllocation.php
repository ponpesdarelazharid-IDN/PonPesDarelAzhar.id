<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalaryAllocation extends Model
{
    protected $table = 'salary_allocations';

    protected $fillable = [
        'salary_id',
        'category_id',
        'amount_allocated',
        'is_paid',
        'paid_at',
        'notes',
    ];

    protected $casts = [
        'amount_allocated' => 'decimal:2',
        'is_paid'          => 'boolean',
        'paid_at'          => 'date',
    ];

    public function salary(): BelongsTo
    {
        return $this->belongsTo(Salary::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(SalaryCategory::class, 'category_id');
    }

    public function getFormattedAmountAttribute(): string
    {
        return 'Rp ' . number_format($this->amount_allocated, 0, ',', '.');
    }
}
