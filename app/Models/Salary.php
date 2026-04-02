<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Salary extends Model
{
    protected $table = 'salaries';

    protected $fillable = [
        'amount',
        'month',
        'notes',
        'total_fixed',
        'total_percentage',
        'remaining',
    ];

    protected $casts = [
        'amount'           => 'decimal:2',
        'total_fixed'      => 'decimal:2',
        'total_percentage' => 'decimal:2',
        'remaining'        => 'decimal:2',
    ];

    public function allocations(): HasMany
    {
        return $this->hasMany(SalaryAllocation::class);
    }

    public function getFormattedAmountAttribute(): string
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function getMonthLabelAttribute(): string
    {
        $months = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
            '04' => 'April',   '05' => 'Mei',       '06' => 'Juni',
            '07' => 'Juli',    '08' => 'Agustus',   '09' => 'September',
            '10' => 'Oktober', '11' => 'November',  '12' => 'Desember',
        ];
        [$year, $month] = explode('-', $this->month);
        return ($months[$month] ?? $month) . ' ' . $year;
    }

    public function getTotalAllocatedAttribute(): float
    {
        return (float) $this->total_fixed + (float) $this->total_percentage;
    }
}
