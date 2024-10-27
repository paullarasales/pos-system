<?php

use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('inventory', InventoryController::class);
Route::resource('product', ProductController::class);

//Admin Routes
Route::get('/admin/dashboard', [PagesController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin-profile.edit');
Route::patch('/admin/profile', [AdminProfileController::class, 'update'])->name('admin-profile.update');
Route::delete('/admin/profile', [AdminProfileController::class, 'destroy'])->name('admin-profile.destroy');
Route::get('/admin/product/add', [PagesController::class, 'product'])->name('admin.product');
Route::get('/admin/product/update/{id}', [PagesController::class, 'edit'])->name('admin.edit');
Route::get('/admin/product', [PagesController::class, 'productDisplay'])->name('admin.product-display');
Route::get('/admin/sales/{year}', [PagesController::class, 'sales'])->name('admin.sales');
Route::get('/admin/users', [PagesController::class, 'userManagement'])->name('admin.manageUser');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/cart', [CashierController::class, 'showCart'])->name('cashier.cart');
Route::post('/add-to-cart/{id}', [CashierController::class, 'addToCart'])->name('cashier.addToCart');
Route::post('/checkout', [CashierController::class, 'checkout'])->name('cashier.checkout');

Route::get('reports/monthly/{year}', [ReportController::class, 'nonJSON'])->name('reports.monthly');


require __DIR__.'/auth.php';
