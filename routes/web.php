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
    Route::get('/ppdb/status', function () {
        $registration = \App\Models\Registration::where('user_id', auth()->id())->first();
        return view('ppdb.status', compact('registration'));
    })->name('ppdb.status');

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
