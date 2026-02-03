<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServisController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TrackingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ========================================
// PUBLIC ROUTES - CUSTOMER FACING
// ========================================

// Homepage (Customer Landing)
Route::get('/', [TrackingController::class, 'home'])->name('home');

// Service Tracking
Route::get('cek-servis', [TrackingController::class, 'index'])->name('tracking.index');
Route::get('cek-servis/hasil', [TrackingController::class, 'show'])->name('tracking.show');

// ========================================
// ADMIN ROUTES - EMPLOYEE ONLY
// ========================================

// Admin Authentication
Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate'])->name('login.authenticate');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

// Protected Admin Routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Servis CRUD
    Route::resource('servis', ServisController::class);
    Route::get('servis/{id}/print', [ServisController::class, 'print'])->name('servis.print');

    // Laporan
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan');

    // Pengaturan
    Route::get('pengaturan', [PengaturanController::class, 'index'])->name('pengaturan');
    Route::post('pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');

    // Tracking Logs
    Route::get('tracking-logs', [TrackingController::class, 'logs'])->name('tracking.logs');
});
