<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\{LaboranDashboardController, MaintenanceController};
use App\Http\Controllers\AuthController;

// ===== PUBLIC ROUTES =====
Route::get('/', [PublicController::class, 'index'])->name('home');

// Form Submissions
Route::post('/submit-peminjaman', [PublicController::class, 'submitPeminjaman'])->name('public.peminjaman.submit');
Route::post('/submit-pengujian', [PublicController::class, 'submitPengujian'])->name('public.pengujian.submit');
Route::post('/submit-kunjungan', [PublicController::class, 'submitKunjungan'])->name('public.kunjungan.submit');

// API Endpoints
Route::get('/api/alat-tersedia', [PublicController::class, 'getAlatTersedia'])->name('api.alat');
Route::get('/api/jenis-pengujian', [PublicController::class, 'getJenisPengujian'])->name('api.pengujian');

// ===== AUTHENTICATION =====
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===== ADMIN ROUTES =====
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Route
    Route::get('/admin/laboran', [LaboranDashboardController::class, 'index'])->name('admin.laboran.dashboard');
    Route::get('/admin', function() { return redirect()->route('admin.laboran.dashboard'); });
    
    Route::prefix('admin/laboran')->name('admin.laboran.')->group(function () {
        
        // ===== MANAJEMEN ALAT =====
        Route::prefix('alat')->name('alat.')->group(function () {
            Route::get('/', [LaboranDashboardController::class, 'alat'])->name('index');
            Route::post('/', [LaboranDashboardController::class, 'alatStore'])->name('store');
            Route::put('/{alat}', [LaboranDashboardController::class, 'alatUpdate'])->name('update');
            Route::delete('/{alat}', [LaboranDashboardController::class, 'alatDestroy'])->name('destroy');
            Route::get('/export/{format}', [LaboranDashboardController::class, 'alatExport'])->name('export');
        });
        
        // ===== MANAJEMEN PEMINJAMAN =====
                    Route::prefix('peminjaman')->name('peminjaman.')->group(function () {
                Route::get('/', [LaboranDashboardController::class, 'peminjaman'])->name('index');
                Route::get('/export/{format}', [LaboranDashboardController::class, 'peminjamanExport'])->name('export');
                Route::get('/{peminjaman}', [LaboranDashboardController::class, 'peminjamanShow'])->name('show');
                Route::patch('/{peminjaman}/status', [LaboranDashboardController::class, 'peminjamanUpdateStatus'])->name('update-status');
                Route::delete('/{peminjaman}', [LaboranDashboardController::class, 'peminjamanDestroy'])->name('destroy');
            });
        
        // ===== MANAJEMEN PENGUJIAN =====
        Route::prefix('pengujian')->name('pengujian.')->group(function () {
            Route::get('/', [LaboranDashboardController::class, 'pengujian'])->name('index');
            Route::get('/{pengujian}', [LaboranDashboardController::class, 'pengujianShow'])->name('show');
            Route::patch('/{pengujian}/status', [LaboranDashboardController::class, 'pengujianUpdateStatus'])->name('update-status');
            Route::delete('/{pengujian}', [LaboranDashboardController::class, 'pengujianDestroy'])->name('destroy');
        });
        
        // ===== MANAJEMEN KUNJUNGAN =====
        Route::prefix('kunjungan')->name('kunjungan.')->group(function () {
            Route::get('/', [LaboranDashboardController::class, 'kunjungan'])->name('index');
            Route::get('/export/{format}', [LaboranDashboardController::class, 'kunjunganExport'])->name('export');
            Route::get('/{kunjungan}', [LaboranDashboardController::class, 'kunjunganShow'])->name('show');
            Route::patch('/{kunjungan}/status', [LaboranDashboardController::class, 'kunjunganUpdateStatus'])->name('update-status');
            Route::delete('/{kunjungan}', [LaboranDashboardController::class, 'kunjunganDestroy'])->name('destroy');
        });
        
        // ===== MANAJEMEN JENIS PENGUJIAN =====
        Route::prefix('jenis-pengujian')->name('jenis-pengujian.')->group(function () {
            Route::get('/', [LaboranDashboardController::class, 'jenisPengujian'])->name('index');
            Route::post('/', [LaboranDashboardController::class, 'jenisPengujianStore'])->name('store');
            Route::put('/{jenisPengujian}', [LaboranDashboardController::class, 'jenisPengujianUpdate'])->name('update');
            Route::delete('/{jenisPengujian}', [LaboranDashboardController::class, 'jenisPengujianDestroy'])->name('destroy');
            Route::get('/export/{format}', [LaboranDashboardController::class, 'jenisPengujianExport'])->name('export');
            Route::patch('/{jenisPengujian}/toggle', [LaboranDashboardController::class, 'jenisPengujianToggleAvailability'])->name('toggle');
        });
        
        // ===== MANAJEMEN KONTEN =====
        Route::prefix('artikel')->name('artikel.')->group(function () {
            Route::get('/', [LaboranDashboardController::class, 'artikel'])->name('index');
            Route::post('/', [LaboranDashboardController::class, 'artikelStore'])->name('store');
            Route::put('/{artikel}', [LaboranDashboardController::class, 'artikelUpdate'])->name('update');
            Route::delete('/{artikel}', [LaboranDashboardController::class, 'artikelDestroy'])->name('destroy');
            Route::get('/export/{format}', [LaboranDashboardController::class, 'artikelExport'])->name('export');
        });
        
        // ===== MANAJEMEN PENGURUS =====
        Route::prefix('pengurus')->name('pengurus.')->group(function () {
            Route::get('/', [LaboranDashboardController::class, 'pengurus'])->name('index');
            Route::post('/', [LaboranDashboardController::class, 'pengurusStore'])->name('store');
            Route::put('/{pengurus}', [LaboranDashboardController::class, 'pengurusUpdate'])->name('update');
            Route::delete('/{pengurus}', [LaboranDashboardController::class, 'pengurusDestroy'])->name('destroy');
            Route::get('/export/{format}', [LaboranDashboardController::class, 'pengurusExport'])->name('export');
            Route::patch('/{pengurus}/toggle', [LaboranDashboardController::class, 'pengurusToggleStatus'])->name('toggle');
        });
        
        // ===== MANAJEMEN MAINTENANCE =====
        Route::prefix('maintenance')->name('maintenance.')->group(function () {
            Route::get('/', [MaintenanceController::class, 'index'])->name('index');
            Route::post('/', [MaintenanceController::class, 'store'])->name('store');
            Route::get('/report', [MaintenanceController::class, 'report'])->name('report');
            Route::get('/alat-tersedia', [MaintenanceController::class, 'getAlatTersedia'])->name('alat-tersedia');
            Route::get('/{maintenance}', [MaintenanceController::class, 'show'])->name('show');
            Route::patch('/{maintenance}/status', [MaintenanceController::class, 'updateStatus'])->name('update-status');
            Route::delete('/{maintenance}', [MaintenanceController::class, 'destroy'])->name('destroy');
        });
        
    });
});

// ===== LEGACY REDIRECTS =====
Route::get('/laboratories', function () { return redirect('/', 301); });
Route::get('/simulasi', function () { return redirect('/#layanan'); });
Route::get('/akses-lab', function () { return redirect('/#layanan'); });
Route::get('/konsultasi', function () { return redirect('/#layanan'); });
Route::get('/workstation', function () { return redirect('/#layanan'); });
Route::get('/lab-visit', function () { return redirect('/#layanan'); });
Route::get('/analysis', function () { return redirect('/#layanan'); });
Route::get('/super-admin', function() { return redirect()->route('admin.laboran.dashboard'); }); 