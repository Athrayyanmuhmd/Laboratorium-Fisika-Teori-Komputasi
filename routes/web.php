<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SuperAdminDashboardController;
use App\Http\Controllers\Admin\AdminLaboratoryController;
use App\Http\Controllers\Admin\AdminEquipmentController;
use App\Http\Controllers\Admin\AdminRentalController;
use App\Http\Controllers\Admin\AdminVisitController;
use App\Http\Controllers\Admin\AdminTestController;
use App\Http\Controllers\Admin\AdminComputerController;
use App\Http\Controllers\Admin\SuperAdminUserController;
use App\Http\Controllers\Admin\SuperAdminStaffController;
use App\Http\Controllers\Admin\SuperAdminGalleryController;

// Main Single Page Application
Route::get('/', [LaboratoryController::class, 'index'])->name('home');

// Redirect all section routes to single page with anchors
Route::get('/layanan', function () {
    return redirect('/#layanan');
})->name('services');

Route::get('/fasilitas', function () {
    return redirect('/#fasilitas');
})->name('facilities');

Route::get('/penelitian', function () {
    return redirect('/#penelitian');
})->name('research');

Route::get('/kontak', function () {
    return redirect('/#kontak');
})->name('contact');

// Layanan Simulasi & Komputasi
Route::prefix('simulasi')->name('simulation.')->group(function () {
    Route::get('/', [RentalController::class, 'index'])->name('index');
    Route::get('/request', [RentalController::class, 'create'])->name('create');
    Route::post('/', [RentalController::class, 'store'])->name('store');
    Route::get('/track', [RentalController::class, 'track'])->name('track');
});

// Layanan Akses Lab
Route::prefix('akses-lab')->name('lab-access.')->group(function () {
    Route::get('/', [VisitController::class, 'index'])->name('index');
    Route::get('/request', [VisitController::class, 'create'])->name('create');
    Route::post('/', [VisitController::class, 'store'])->name('store');
    Route::get('/track', [VisitController::class, 'track'])->name('track');
});

// Layanan Konsultasi
Route::prefix('konsultasi')->name('consultation.')->group(function () {
    Route::get('/', [TestController::class, 'index'])->name('index');
    Route::get('/request', [TestController::class, 'create'])->name('create');
    Route::post('/', [TestController::class, 'store'])->name('store');
    Route::get('/track', [TestController::class, 'track'])->name('track');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Super Admin Routes (Protected)
Route::prefix('super-admin')->name('super-admin.')->middleware(['auth', 'super_admin'])->group(function () {
    Route::get('/', [SuperAdminDashboardController::class, 'index'])->name('dashboard');
    
    // User Management
    Route::resource('users', SuperAdminUserController::class);
    Route::patch('users/{user}/toggle-status', [SuperAdminUserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::patch('users/{user}/change-role', [SuperAdminUserController::class, 'changeRole'])->name('users.change-role');
    
    // Staff Management
    Route::resource('staff', SuperAdminStaffController::class);
    Route::patch('staff/{staff}/toggle-status', [SuperAdminStaffController::class, 'toggleStatus'])->name('staff.toggle-status');
    Route::patch('staff/{staff}/toggle-featured', [SuperAdminStaffController::class, 'toggleFeatured'])->name('staff.toggle-featured');
    
    // Gallery Management
    Route::resource('gallery', SuperAdminGalleryController::class);
    Route::patch('gallery/{gallery}/toggle-status', [SuperAdminGalleryController::class, 'toggleStatus'])->name('gallery.toggle-status');
    Route::patch('gallery/{gallery}/toggle-featured', [SuperAdminGalleryController::class, 'toggleFeatured'])->name('gallery.toggle-featured');
    
    // System Analytics & Reports
    Route::get('/analytics', [SuperAdminDashboardController::class, 'analytics'])->name('analytics');
    Route::get('/reports', [SuperAdminDashboardController::class, 'reports'])->name('reports');
    Route::get('/system-logs', [SuperAdminDashboardController::class, 'systemLogs'])->name('system-logs');
});

// Admin Routes (Protected)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Equipment Management (untuk workstation dan software)
    Route::resource('equipment', AdminEquipmentController::class);
    Route::post('equipment/{equipment}/toggle-status', [AdminEquipmentController::class, 'toggleStatus'])->name('equipment.toggle-status');
    
    // Computer Layout Management
    Route::resource('computers', AdminComputerController::class);
    Route::put('computers/{computer}/status', [AdminComputerController::class, 'updateStatus'])->name('computers.update-status');
    Route::get('computers/{computer}/data', [AdminComputerController::class, 'getComputer'])->name('computers.get-data');
    Route::put('computers/{computer}/quick-update', [AdminComputerController::class, 'quickUpdate'])->name('computers.quick-update');
    Route::get('computers-stats', [AdminComputerController::class, 'getStats'])->name('computers.stats');
    
    // Simulation Request Management
    Route::resource('simulations', AdminRentalController::class)->only(['index', 'show', 'edit', 'update']);
    Route::patch('simulations/{rental}/approve', [AdminRentalController::class, 'approve'])->name('simulations.approve');
    Route::patch('simulations/{rental}/reject', [AdminRentalController::class, 'reject'])->name('simulations.reject');
    Route::patch('simulations/{rental}/complete', [AdminRentalController::class, 'return'])->name('simulations.complete');
    
    // Lab Access Management
    Route::resource('lab-access', AdminVisitController::class);
    Route::patch('lab-access/{visit}/approve', [AdminVisitController::class, 'approve'])->name('lab-access.approve');
    Route::patch('lab-access/{visit}/reject', [AdminVisitController::class, 'reject'])->name('lab-access.reject');
    Route::patch('lab-access/{visit}/complete', [AdminVisitController::class, 'complete'])->name('lab-access.complete');
    
    // Consultation Management
    Route::resource('consultations', AdminTestController::class);
    Route::patch('consultations/{test}/approve', [AdminTestController::class, 'approve'])->name('consultations.approve');
    Route::patch('consultations/{test}/reject', [AdminTestController::class, 'reject'])->name('consultations.reject');
    Route::patch('consultations/{test}/start', [AdminTestController::class, 'start'])->name('consultations.start');
    Route::patch('consultations/{test}/complete', [AdminTestController::class, 'complete'])->name('consultations.complete');
});

// Legacy routes untuk kompatibilitas (redirect ke single page)
Route::get('/laboratories', function () {
    return redirect('/', 301);
});

Route::get('/rentals', function () {
    return redirect('/simulasi', 301);
});

Route::get('/visits', function () {
    return redirect('/akses-lab', 301);
});

Route::get('/tests', function () {
    return redirect('/konsultasi', 301);
});

// Additional redirects for old section-based URLs
Route::get('/beranda', function () {
    return redirect('/#beranda');
});

Route::get('/home', function () {
    return redirect('/#beranda');
});
