<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Mail\AcceptedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = Registration::query();

        // Search Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('registration_number', 'like', "%{$search}%")
                  ->orWhere('origin_school', 'like', "%{$search}%");
            });
        }

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $registrations = $query->latest()->paginate(20)->withQueryString();
        
        return view('admin.registrations.index', compact('registrations'));
    }

    public function show(Registration $registration)
    {
        return view('admin.registrations.show', compact('registration'));
    }

    public function update(Request $request, Registration $registration)
    {
        $validated = $request->validate([
            'status' => 'required|in:draft,pending,verified,accepted,rejected',
            'notes' => 'nullable|string'
        ]);

        // Proteksi: Hanya bisa accepted jika sudah lunas
        if ($validated['status'] === 'accepted' && $registration->payment_remaining > 0) {
            return back()->with('error', 'Pendaftar belum bisa dinyatakan LULUS (Accepted) karena masih memiliki sisa tagihan Rp ' . number_format($registration->payment_remaining, 0, ',', '.'));
        }

        $oldStatus = $registration->status;
        $registration->update($validated);

        if ($oldStatus !== 'accepted' && $validated['status'] === 'accepted') {
            try {
                Mail::to($registration->user->email)->send(new AcceptedMail($registration));
            } catch (\Exception $e) {
                Log::error('Gagal mengirim email kelulusan PPDB: ' . $e->getMessage());
            }
        } elseif ($oldStatus !== 'rejected' && $validated['status'] === 'rejected') {
            try {
                Mail::to($registration->user->email)->send(new \App\Mail\RejectedMail($registration));
            } catch (\Exception $e) {
                Log::error('Gagal mengirim email penolakan PPDB: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Status pendaftaran berhasil diperbarui!');
    }

    public function verifyInstallment(\App\Models\Payment $payment)
    {
        $payment->update(['status' => 'verified']);
        return back()->with('success', 'Pembayaran cicilan berhasil diverifikasi!');
    }

    public function rejectInstallment(Request $request, \App\Models\Payment $payment)
    {
        $request->validate(['notes' => 'required|string']);
        $payment->update([
            'status' => 'rejected',
            'notes' => $request->notes
        ]);
        return back()->with('success', 'Pembayaran cicilan ditolak dengan catatan.');
    }
}
