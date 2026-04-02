<?php

namespace App\Http\Controllers\Salary;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use App\Models\SalaryCategory;
use App\Models\SalaryAllocation;
use Illuminate\Http\Request;

class SalaryDashboardController extends Controller
{
    public function index()
    {
        $currentMonth = now()->format('Y-m');
        $salary = Salary::where('month', $currentMonth)
            ->with(['allocations.category' => function ($q) {
                $q->orderBy('priority');
            }])
            ->first();

        $latestSalaries = Salary::orderBy('month', 'desc')->take(6)->get();
        $totalCategories = SalaryCategory::active()->count();

        // Data untuk chart (6 bulan terakhir)
        $chartData = Salary::orderBy('month', 'desc')->take(6)->get()->reverse()->map(function ($s) {
            return [
                'month'  => $s->month_label,
                'amount' => (float) $s->amount,
                'allocated' => (float) $s->total_allocated,
                'remaining' => (float) $s->remaining,
            ];
        })->values();

        // Statistik
        $stats = [
            'total_salary'   => $salary ? (float) $salary->amount : 0,
            'total_fixed'    => $salary ? (float) $salary->total_fixed : 0,
            'total_percentage' => $salary ? (float) $salary->total_percentage : 0,
            'remaining'      => $salary ? (float) $salary->remaining : 0,
            'paid_count'     => $salary ? $salary->allocations->where('is_paid', true)->count() : 0,
            'unpaid_count'   => $salary ? $salary->allocations->where('is_paid', false)->count() : 0,
        ];

        // Donut chart data per kategori
        $donutData = [];
        if ($salary) {
            foreach ($salary->allocations->load('category') as $alloc) {
                $donutData[] = [
                    'name'   => $alloc->category->name,
                    'icon'   => $alloc->category->icon,
                    'color'  => $alloc->category->color,
                    'amount' => (float) $alloc->amount_allocated,
                    'isPaid' => $alloc->is_paid,
                ];
            }
        }

        return view('salary.dashboard', compact(
            'salary', 'stats', 'chartData', 'donutData',
            'latestSalaries', 'totalCategories', 'currentMonth'
        ));
    }
}
