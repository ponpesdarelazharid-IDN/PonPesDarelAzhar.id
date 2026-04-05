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
}
