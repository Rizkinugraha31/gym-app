<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Import semua controller yang dibutuhkan
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController as AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\WorkoutPlanController;
use App\Http\Controllers\Admin\ExerciseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Halaman Depan
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk Member (Bawaan Breeze + Profil)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        // Ini bisa menjadi halaman home untuk member
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Grup Rute Admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Rute Login & Logout Admin (bisa diakses oleh 'guest')
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'create'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'store']);
    });

    // Rute yang hanya bisa diakses setelah admin login
    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AdminLoginController::class, 'destroy'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Rute untuk konfirmasi pembayaran
        Route::patch('/members/{membership}/confirm', [MemberController::class, 'confirmPayment'])->name('members.confirm');

        // Rute resource untuk CRUD
        Route::resource('members', MemberController::class);
        Route::resource('workout-plans', WorkoutPlanController::class);
        Route::resource('workout-plans.exercises', ExerciseController::class)->shallow();
    });
});


// Rute Autentikasi Member bawaan Breeze
require __DIR__.'/auth.php';
