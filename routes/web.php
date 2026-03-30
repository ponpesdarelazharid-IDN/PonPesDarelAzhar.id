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
use Illuminate\Support\Facades\Route;

// ==== PUBLIC WEBSITE ====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita', [PostController::class, 'berita'])->name('berita.index');
Route::get('/acara', [PostController::class, 'acara'])->name('acara.index');
Route::get('/prestasi', [PostController::class, 'prestasi'])->name('prestasi.index');
Route::get('/ekstrakurikuler', [PostController::class, 'ekstrakurikuler'])->name('ekstrakurikuler.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

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
});

require __DIR__.'/auth.php';

// ==== PREVIEW ROUTE FOR CARD ====
Route::get('/preview-card', function () {
    $registration = new \App\Models\Registration([
        'full_name' => 'Aisyah Az Zahra',
        'birth_place' => 'Bandung',
        'birth_date' => now()->subYears(15),
        'address' => 'Jl. Anggrek No. 12, Cipete, Jakarta Selatan',
        'registration_number' => '2122.10.045',
    ]);
    $registration->created_at = now();
    $registration->photo_path = 'https://i.pravatar.cc/300?img=5';
    $school = [
        'nama_sekolah' => 'Pondok Pesantren Modern Darel Azhar',
        'alamat' => 'Jl. Pesantren No. 1, Desa Mulia, Kec. Sejahtera, Indonesia',
        'telepon' => '08123456789'
    ];
    return view('ppdb.card', compact('registration', 'school'));
});

Route::get("/preview-email-accepted", function () {
    $registration = \App\Models\Registration::first() ?? new \App\Models\Registration(["full_name" => "Aisyah Az Zahra", "registration_number" => "2122.10.045"]);
    return view("emails.accepted", compact("registration"));
});

Route::get("/preview-email-verify", function () {
    return view("emails.verify", ["url" => "https://darelazhar.sch.id/verify-email/123", "user" => \App\Models\User::first()]);
});
