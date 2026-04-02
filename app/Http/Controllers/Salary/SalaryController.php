<?php

namespace App\Http\Controllers\Salary;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use App\Services\SalaryCalculationService;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function __construct(private SalaryCalculationService $calculator) {}

    public function index()
    {
        $salaries = Salary::orderBy('month', 'desc')->paginate(12);
        return view('salary.input', compact('salaries'));
    }

    /**
     * Preview kalkulasi sebelum disimpan (AJAX)
     */
    public function preview(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|min:1']);
        $result = $this->calculator->calculate((float) $request->amount);
        return response()->json($result);
    }

    /**
     * Simpan gaji + kalkulasi alokasi
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'month'  => 'required|date_format:Y-m',
            'notes'  => 'nullable|string|max:500',
        ]);

        try {
            $salary = $this->calculator->save(
                (float) $request->amount,
                $request->month,
                $request->notes ?? ''
            );

            return redirect()
                ->route('salary.detail', $salary->id)
                ->with('success', '✅ Gaji bulan ' . $salary->month_label . ' berhasil dihitung!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', '❌ Gagal: ' . $e->getMessage());
        }
    }

    /**
     * Detail alokasi satu bulan gaji
     */
    public function show(int $id)
    {
        $salary = Salary::with(['allocations' => function ($q) {
            $q->with('category')->orderBy('category_id');
        }])->findOrFail($id);

        $result = $this->calculator->calculate((float) $salary->amount);

        return view('salary.detail', compact('salary', 'result'));
    }

    /**
     * Hapus record gaji
     */
    public function destroy(int $id)
    {
        $salary = Salary::findOrFail($id);
        $label  = $salary->month_label;
        $salary->allocations()->delete();
        $salary->delete();

        return redirect()->route('salary.index')
            ->with('success', "🗑️ Data gaji {$label} berhasil dihapus.");
    }
}
