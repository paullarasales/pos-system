<?php

use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', [PagesController::class, 'adminDashboard'])->name('admin.dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin-profile.edit');
    Route::patch('/admin/profile', [AdminProfileController::class, 'update'])->name('admin-profile.update');
    Route::delete('/admin/profile', [AdminProfileController::class, 'destroy'])->name('admin-profile.destroy');
require __DIR__.'/auth.php';
