<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\WorkoutPlanController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('auth:admin')->group(function () {
        // ... (rute dashboard dan member yang sudah ada)

        // Rute baru untuk manajemen jadwal latihan
        Route::resource('workout-plans', WorkoutPlanController::class);
    });
});
