<?php

use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('inventory', InventoryController::class);
Route::resource('product', ProductController::class);


//Admin Routes
Route::get('/admin/dashboard', [PagesController::class, 'adminDashboard'])->name('dashboard');
Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin-profile.edit');
Route::patch('/admin/profile', [AdminProfileController::class, 'update'])->name('admin-profile.update');
Route::delete('/admin/profile', [AdminProfileController::class, 'destroy'])->name('admin-profile.destroy');
Route::get('/admin/product/add', [PagesController::class, 'product'])->name('admin.product');
Route::get('/admin/product/update/{id}', [PagesController::class, 'edit'])->name('admin.edit');
Route::get('/admin/product', [PagesController::class, 'productDisplay'])->name('admin.product-display');
Route::get('/admin/sales/{year}', [PagesController::class, 'sales'])->name('admin.sales');
Route::get('/admin/users', [PagesController::class, 'userManagement'])->name('admin.manageUser');
Route::post('/admin/users', [EmployeeController::class, 'store'])->name('employees.store');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('reports/monthly/{year}', [ReportController::class, 'nonJSON'])->name('reports.monthly');
Route::get('/report/download', [ReportController::class, 'downloadReport'])->name('report.download');
Route::get('/reports/end-of-day/{date}', [ReportController::class, 'endOfDayReport'])->name('reports.endOfDay');

//Employee
Route::get('/employee/login', function () {
    return view('employee.login');
})->name('employee.login.form');
Route::post('/employee/login', [EmployeeController::class, 'login'])->name('employee.login');
Route::post('/employee/logout', [EmployeeController::class, 'logout'])->name('employee.logout');

Route::middleware(['auth:employee'])->group(function () {
    Route::get('/cashier/cart', [CashierController::class, 'showCart'])->name('cashier.cart');
    Route::post('/cashier/add-to-cart/{id}', [CashierController::class, 'addToCart'])->name('cashier.addToCart');
    Route::post('/cashier/checkout', [CashierController::class, 'checkout'])->name('cashier.checkout');
    Route::post('/cashier/cancel', [CashierController::class, 'cancel'])->name('cashier.cancel');
    Route::get('products/search', [ProductController::class, 'index'])->name('products.index');
});
require __DIR__.'/auth.php';
