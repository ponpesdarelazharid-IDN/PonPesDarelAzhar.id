<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Mail\AcceptedMail;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::latest()->paginate(20);
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
            Mail::to($registration->user->email)->send(new AcceptedMail($registration));
        }

        return back()->with('success', 'Status pendaftaran berhasil diperbarui!');
    }
}
