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
            'total_prestasi' => Post::where('type', 'prestasi')->count(),
            'total_user' => \App\Models\User::count(),
        ];
        
        $recent_registrations = Registration::latest()->take(5)->get();
        $recent_posts = Post::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recent_registrations', 'recent_posts'));
    }

    public function migrate()
    {
        try {
            \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
            $output = \Illuminate\Support\Facades\Artisan::output();
            return "Database Migration Success! <br><pre>$output</pre><br><a href='".route('admin.dashboard')."'>Back to Dashboard</a>";
        } catch (\Exception $e) {
            return "Migration Failed: " . $e->getMessage();
        }
    }
}
