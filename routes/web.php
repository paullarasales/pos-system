<?php

use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Admin Routes
Route::get('/admin/dashboard', [PagesController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin-profile.edit');
Route::patch('/admin/profile', [AdminProfileController::class, 'update'])->name('admin-profile.update');
Route::delete('/admin/profile', [AdminProfileController::class, 'destroy'])->name('admin-profile.destroy');
Route::get('/admin/product', [PagesController::class, 'product'])->name('admin.product');
Route::get('/admin/inventory', [PagesController::class, 'inventory'])->name('admin.inventory');
Route::get('/admin/sales', [PagesController::class, 'sales'])->name('admin.inventory');
Route::get('/admin/users', [PagesController::class, 'userManagement'])->name('admin.manageUser');

//Others 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
