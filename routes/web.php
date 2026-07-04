<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\NewsController as PublicNewsController;
use App\Models\News;

Route::get('/', function () {
    $news = News::latest()->take(3)->get();
    return view('welcome', compact('news'));
});

// Public News Route
Route::get('/berita/{news}', [PublicNewsController::class, 'show'])->name('news.show');

// Google Auth Routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// User Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ReportController::class, 'index'])->name('dashboard');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
});

// Admin Routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminReportController::class, 'dashboard'])->name('dashboard');
    
    // Kelola Berita
    Route::resource('news', NewsController::class);
    
    // Kelola Laporan
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{report}', [AdminReportController::class, 'show'])->name('reports.show');
    Route::patch('/reports/{report}/status', [AdminReportController::class, 'updateStatus'])->name('reports.update-status');
    Route::patch('/reports/{report}/assign', [AdminReportController::class, 'assign'])->name('reports.assign');

    // Kelola Pegawai
    Route::resource('pegawai', App\Http\Controllers\Admin\PegawaiController::class)->except(['show']);
});

// Pegawai Routes
Route::middleware(['auth', 'verified', 'pegawai'])->prefix('pegawai')->name('pegawai.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Pegawai\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/reports/{report}', [App\Http\Controllers\Pegawai\DashboardController::class, 'show'])->name('reports.show');
    Route::patch('/reports/{report}/status', [App\Http\Controllers\Pegawai\DashboardController::class, 'updateStatus'])->name('reports.update-status');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
