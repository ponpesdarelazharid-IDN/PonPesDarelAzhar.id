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

        // Monthly Trends (Last 6 Months)
        $months = [];
        $counts = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->translatedFormat('F');
            $counts[] = Registration::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
        }

        $charts = [
            'trends' => [
                'labels' => $months,
                'data' => $counts
            ],
            'gender' => [
                'L' => Registration::where('gender', 'L')->count(),
                'P' => Registration::where('gender', 'P')->count(),
            ],
            'status' => [
                'Pending' => $stats['pending'],
                'Verified' => $stats['verified'],
                'Accepted' => $stats['accepted'],
                'Rejected' => Registration::where('status', 'rejected')->count(),
            ]
        ];

        // System Health Check
        $health = [];
        $logoPath = public_path('images/logo-da.png');
        if (file_exists($logoPath)) {
            $size = filesize($logoPath) / (1024 * 1024); // MB
            if ($size > 1) {
                $health[] = [
                    'type' => 'warning',
                    'message' => "File logo-da.png sangat besar (" . number_format($size, 2) . " MB). Ini memperlambat loading website. Disarankan < 300 KB.",
                ];
            }
        }
        
        $recent_registrations = Registration::latest()->take(5)->get();
        $recent_posts = Post::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recent_registrations', 'recent_posts', 'charts', 'health'));
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
