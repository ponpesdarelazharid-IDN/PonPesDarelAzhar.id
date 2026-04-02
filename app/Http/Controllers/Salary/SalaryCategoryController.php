<?php

namespace App\Http\Controllers\Salary;

use App\Http\Controllers\Controller;
use App\Models\SalaryCategory;
use Illuminate\Http\Request;

class SalaryCategoryController extends Controller
{
    public function index()
    {
        $categories = SalaryCategory::orderBy('priority')->orderBy('type')->get();
        return view('salary.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'type'        => 'required|in:fixed,percentage',
            'value'       => 'required|numeric|min:0',
            'priority'    => 'required|integer|min:1',
            'icon'        => 'required|string|max:10',
            'color'       => 'required|string|max:20',
            'description' => 'nullable|string|max:300',
        ]);

        // Validasi: percentage tidak boleh lebih dari 100%
        if ($data['type'] === 'percentage') {
            $existingTotal = SalaryCategory::active()->percentage()->sum('value');
            if ($existingTotal + $data['value'] > 100) {
                return back()->withInput()->with('error', '❌ Total persentase tidak boleh melebihi 100%! Saat ini sudah ' . $existingTotal . '%');
            }
        }

        SalaryCategory::create($data);
        return back()->with('success', "✅ Pos pengeluaran '{$data['name']}' berhasil ditambahkan!");
    }

    public function update(Request $request, SalaryCategory $salaryCategory)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'type'        => 'required|in:fixed,percentage',
            'value'       => 'required|numeric|min:0',
            'priority'    => 'required|integer|min:1',
            'icon'        => 'required|string|max:10',
            'color'       => 'required|string|max:20',
            'is_active'   => 'boolean',
            'description' => 'nullable|string|max:300',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        $salaryCategory->update($data);
        return back()->with('success', "✅ Pos pengeluaran '{$data['name']}' berhasil diperbarui!");
    }

    public function destroy(SalaryCategory $salaryCategory)
    {
        $name = $salaryCategory->name;
        $salaryCategory->delete();
        return back()->with('success', "🗑️ Pos pengeluaran '{$name}' berhasil dihapus.");
    }
}
