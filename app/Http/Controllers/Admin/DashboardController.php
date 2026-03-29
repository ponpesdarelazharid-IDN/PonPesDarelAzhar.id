<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_pendaftar' => Registration::count(),
            'pending' => Registration::where('status', 'pending')->count(),
            'verified' => Registration::where('status', 'verified')->count(),
            'accepted' => Registration::where('status', 'accepted')->count(),
            'total_berita' => Post::where('type', 'berita')->count(),
        ];
        
        $recent_registrations = Registration::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recent_registrations'));
    }
}
