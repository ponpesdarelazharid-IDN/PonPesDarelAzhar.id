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
    Route::resource('ppdb-settings', AdminPpdbSettingController::class)->only(['index', 'store']);
    Route::resource('registrations', AdminRegistrationController::class)->only(['index', 'show', 'update']);
    Route::resource('users', AdminUserController::class);
    Route::resource('ekstrakurikuler', AdminEkstrakurikulerController::class);
    Route::resource('programs', AdminProgramController::class);
    Route::patch('/installments/{payment}/verify', [AdminRegistrationController::class, 'verifyInstallment'])->name('installments.verify');
    Route::patch('/installments/{payment}/reject', [AdminRegistrationController::class, 'rejectInstallment'])->name('installments.reject');

    // ==== PREVIEW ROUTES (INTERNAL ONLY) ====
    Route::get('/preview-card', function () {
        $profiles = \App\Models\SchoolProfile::pluck('value', 'key')->toArray();
        $registration = \App\Models\Registration::first() ?? new \App\Models\Registration([
            'full_name' => 'Aisyah Az Zahra',
            'birth_place' => 'Bandung',
            'birth_date' => now()->subYears(15),
            'address' => 'Jl. Anggrek No. 12, Cipete, Jakarta Selatan',
            'registration_number' => '2122.10.045',
            'created_at' => now(),
        ]);
        
        $school = [
            'nama_sekolah' => $profiles['nama_sekolah'] ?? 'Pondok Pesantren Modern Darel Azhar',
            'alamat' => $profiles['alamat'] ?? 'Jl. Pesantren No. 1, Desa Mulia, Kec. Sejahtera, Indonesia',
            'telepon' => $profiles['tlp'] ?? '08123456789'
        ];
        return view('ppdb.card', compact('registration', 'school', 'profiles'));
    })->name('preview.card');

    Route::get("/preview-email-accepted", function () {
        $profiles = \App\Models\SchoolProfile::pluck('value', 'key')->toArray();
        $registration = \App\Models\Registration::first() ?? new \App\Models\Registration([
            'id' => 1,
            "full_name" => "Aisyah Az Zahra", 
            "registration_number" => "2122.10.045",
            "previous_school" => "SMP Negeri 1 Jakarta"
        ]);
        return view("emails.accepted", compact("registration", "profiles"));
    })->name('preview.email.accepted');

    Route::get("/preview-email-verify", function () {
        $profiles = \App\Models\SchoolProfile::pluck('value', 'key')->toArray();
        $user = \App\Models\User::first() ?? new \App\Models\User(["name" => "Aisyah Az Zahra", "email" => "aisyah@example.com"]);
        return view("emails.verify", ["url" => "https://darelazhar.sch.id/verify-email/123", "user" => $user, "profiles" => $profiles]);
    })->name('preview.email.verify');
});


require __DIR__.'/auth.php';

