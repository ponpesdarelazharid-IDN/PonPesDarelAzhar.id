<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\SchoolProfileController as AdminSchoolProfileController;
use App\Http\Controllers\Admin\PpdbSettingController as AdminPpdbSettingController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\EkstrakurikulerController as AdminEkstrakurikulerController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use Illuminate\Support\Facades\Route;

// ==== PUBLIC WEBSITE ====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita', [PostController::class, 'berita'])->name('berita.index');
Route::get('/acara', [PostController::class, 'acara'])->name('acara.index');
Route::get('/prestasi', [PostController::class, 'prestasi'])->name('prestasi.index');
Route::get('/ekstrakurikuler', [PostController::class, 'ekstrakurikuler'])->name('ekstrakurikuler.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/test-menu', function() {
    return view('welcome'); // Or any view that uses public layout
})->name('test.menu');

// ==== PPDB USER AREA ====
Route::get('/ppdb', [PpdbController::class, 'landing'])->name('ppdb.landing');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/ppdb/register', [App\Http\Controllers\RegistrationController::class, 'index'])->name('ppdb.register');
    Route::post('/ppdb/register/step1', [App\Http\Controllers\RegistrationController::class, 'storeStep1'])->name('ppdb.register.store1');
    Route::get('/ppdb/register/step2', [App\Http\Controllers\RegistrationController::class, 'step2'])->name('ppdb.register.step2');
    Route::post('/ppdb/register/step2', [App\Http\Controllers\RegistrationController::class, 'storeStep2'])->name('ppdb.register.store2');
    Route::get('/ppdb/register/step3', [App\Http\Controllers\RegistrationController::class, 'step3'])->name('ppdb.register.step3');
    Route::post('/ppdb/register/step3', [App\Http\Controllers\RegistrationController::class, 'storeStep3'])->name('ppdb.register.store3');
    Route::get('/ppdb/register/step4', [App\Http\Controllers\RegistrationController::class, 'step4'])->name('ppdb.register.step4');
    Route::post('/ppdb/register/finalize', [App\Http\Controllers\RegistrationController::class, 'storeFinal'])->name('ppdb.register.finalize');
    Route::post('/ppdb/payment', [App\Http\Controllers\RegistrationController::class, 'storePayment'])->name('ppdb.payment.store');
    Route::post('/ppdb/installment', [App\Http\Controllers\RegistrationController::class, 'storeInstallment'])->name('ppdb.installment.store');
    Route::get('/ppdb/status', function () {
        $registration = \App\Models\Registration::where('user_id', auth()->id())->first();
        return view('ppdb.status', compact('registration'));
    })->name('ppdb.status');
    Route::get('/ppdb/status/card', [App\Http\Controllers\RegistrationController::class, 'printCard'])->name('ppdb.register.card');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==== ADMIN AREA ====
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/migrate', [AdminDashboardController::class, 'migrate'])->name('migrate');
    Route::resource('posts', AdminPostController::class);
    Route::resource('school-profiles', AdminSchoolProfileController::class)->only(['index', 'store']);
    Route::resource('ppdb-settings', AdminPpdbSettingController::class)->only(['index', 'store', 'update']);
    Route::resource('registrations', AdminRegistrationController::class)->only(['index', 'show', 'update']);
    Route::resource('users', AdminUserController::class);
    Route::resource('ekstrakurikuler', AdminEkstrakurikulerController::class);
    Route::resource('programs', AdminProgramController::class);
    Route::patch('/installments/{payment}/verify', [AdminRegistrationController::class, 'verifyInstallment'])->name('installments.verify');
    Route::patch('/installments/{payment}/reject', [AdminRegistrationController::class, 'rejectInstallment'])->name('installments.reject');

});

// ==== PUBLIC AUDIT PREVIEW ROUTES (TEMPORARY) ====
Route::prefix('audit')->group(function () {
    Route::get('/preview-card', function () {
        $profiles = \App\Models\SchoolProfile::pluck('value', 'key')->toArray();
        $registration = \App\Models\Registration::where('status', 'accepted')->first() ?? new \App\Models\Registration([
            'full_name' => 'AISYAH AZ ZAHRA',
            'birth_place' => 'BANDUNG',
            'birth_date' => now()->subYears(15),
            'address' => 'Jl. Anggrek No. 12, Cipete, Jakarta Selatan',
            'registration_number' => 'PPDB-2024.10.999',
            'created_at' => now(),
        ]);
        
        return view('ppdb.card', compact('registration', 'profiles'));
    })->name('audit.preview.card');

    Route::get("/preview-email-accepted", function () {
        $profiles = \App\Models\SchoolProfile::pluck('value', 'key')->toArray();
        $registration = \App\Models\Registration::where('status', 'accepted')->first() ?? new \App\Models\Registration([
            'id' => 1,
            "full_name" => "AISYAH AZ ZAHRA", 
            "registration_number" => "PPDB-2024.10.999"
        ]);
        return view("emails.accepted", compact("registration", "profiles"));
    })->name('audit.preview.email.accepted');
    Route::get("/preview-email-verify", function () {
        $profiles = \App\Models\SchoolProfile::pluck('value', 'key')->toArray();
        $user = \App\Models\User::first() ?? new \App\Models\User(["name" => "AISYAH AZ ZAHRA", "email" => "aisyah@example.com"]);
        return view("emails.verify", ["url" => "https://darelazhar.sch.id/verify-email/123", "user" => $user, "profiles" => $profiles]);
    })->name('audit.preview.email.verify');
});


// Emergency Migration & Diagnostic Route for Vercel
Route::get('/deploy-sync-db', function(\Illuminate\Http\Request $request) {
    // SECURITY PATCH: Cegah akses publik ke endpoint berbahaya ini
    if (app()->environment('production') && $request->query('token') !== env('SYNC_TOKEN', 'darelazhar123')) {
        abort(403, 'Unauthorized Access. Please provide valid token.');
    }

    try {
        echo "<h3>--- System Diagnostic ---</h3>";
        
        // 1. Test DB Connection
        echo "Testing DB Connection... ";
        \DB::connection()->getPdo();
        echo "<span style='color:green'>SUCCESS</span><br>";

        // 2. Test Cloudinary Disk
        echo "Testing Cloudinary Disk... ";
        $cloudinaryTest = false;
        try {
            \Storage::disk('cloudinary');
            $cloudinaryTest = true;
            echo "<span style='color:green'>SUCCESS</span><br>";
        } catch (\Exception $e) {
            echo "<span style='color:red'>FAILED (" . $e->getMessage() . ")</span><br>";
        }

        // 3. Run Migrations
        echo "Running Migrations... ";
        \Artisan::call('migrate', ['--force' => true]);
        echo "<span style='color:green'>SUCCESS</span><br>";

        // 4. Test Mail Sending (Silent)
        echo "Testing Mail Configuration... ";
        $mailTest = false;
        try {
            // Kita hanya cek koneksi transport, tidak benar-benar kirim email ke user
            \Mail::mailer('smtp')->getSymfonyTransport()->start();
            $mailTest = true;
            echo "<span style='color:green'>SUCCESS</span><br>";
        } catch (\Exception $e) {
            echo "<span style='color:red'>FAILED (" . $e->getMessage() . ")</span><br>";
        }

        // 5. Audit Env Variables (Sanitized)
        echo "<h4>--- Env Variable Audit ---</h4>";
        $envToAudit = [
            'CLOUDINARY_CLOUD_NAME', 'CLOUDINARY_API_KEY', 'CLOUDINARY_API_SECRET', 'CLOUDINARY_URL',
            'MAIL_HOST', 'MAIL_PORT', 'MAIL_USERNAME', 'MAIL_PASSWORD', 'MAIL_FROM_ADDRESS'
        ];
        foreach ($envToAudit as $key) {
            $val = env($key);
            $status = $val ? "<span style='color:green'>PRESENT</span>" : "<span style='color:red'>MISSING</span>";
            $preview = $val ? (substr($val, 0, 3) . "..." . substr($val, -3)) : "N/A";
            echo "<b>$key:</b> $status (" . $preview . ")<br>";
        }

        // 6. JSON Output for machine audit
        if (request()->get('format') === 'json') {
            return response()->json([
                'db_connection' => true,
                'cloudinary_disk' => $cloudinaryTest,
                'mail_transport' => $mailTest,
                'env_audit' => array_combine($envToAudit, array_map(fn($k) => (bool)env($k), $envToAudit)),
            ]);
        }

        echo "<h4>--- Sync Completed Successfully! ---</h4>";
    } catch (\Exception $e) {
        echo "<br><b style='color:red'>FATAL ERROR:</b> " . $e->getMessage() . "<br>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    }
});

require __DIR__.'/auth.php';

