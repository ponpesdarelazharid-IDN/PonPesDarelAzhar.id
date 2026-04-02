<?php

namespace App\Http\Controllers\Salary;

use App\Http\Controllers\Controller;
use App\Models\SalaryAllocation;
use Illuminate\Http\Request;

class SalaryAllocationController extends Controller
{
    /**
     * Toggle status paid/unpaid
     */
    public function togglePaid(int $id)
    {
        $allocation = SalaryAllocation::with('category')->findOrFail($id);
        $allocation->is_paid  = !$allocation->is_paid;
        $allocation->paid_at  = $allocation->is_paid ? now()->toDateString() : null;
        $allocation->save();

        $status = $allocation->is_paid ? '✅ Lunas' : '⏳ Belum lunas';

        return response()->json([
            'success'    => true,
            'is_paid'    => $allocation->is_paid,
            'paid_at'    => $allocation->paid_at,
            'status_label' => $status,
            'message'    => "{$allocation->category->name}: {$status}",
        ]);
    }

    /**
     * Update notes pada alokasi
     */
    public function updateNotes(Request $request, int $id)
    {
        $request->validate(['notes' => 'nullable|string|max:300']);
        $allocation = SalaryAllocation::findOrFail($id);
        $allocation->update(['notes' => $request->notes]);

        return response()->json(['success' => true, 'message' => 'Catatan disimpan.']);
    }
}
