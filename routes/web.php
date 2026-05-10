<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\DashboardController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


 //Admin Profile Routes
Route::prefix('admin')->middleware(['auth','verified'])->group(function () {
   Route::get('/profile', [ProfileController::class, 'AdminProfile'])->name('admin.profile');
   Route::post('/profile/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
   Route::post('/password/update', [ProfileController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});


Route::prefix('admin')->middleware(['auth','verified'])->group(function () {
     Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
     Route::get('/user/list', [DashboardController::class, 'userList'])->name('user.list');
    Route::get('/user/list/{id}', [DashboardController::class, 'userDestroy'])->name('user.destroy');
    //Admin Logout Route
    Route::get('/admin/logout', [DashboardController::class, 'AdminLogout'])->name('admin.logout');
});

Route::prefix('admin')->middleware(['auth','verified'])->group(function () {

    //Category Route
    Route::get('category/index', [CategoryController::class, 'index'])->name('category.index');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/{id}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/{id}/update', [CategoryController::class, 'update'])->name('category.update');

    //Products Route
    Route::get('/products/index', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/{id}/show', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
   
    //Customers Route
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{id}', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::get('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    
    //Sales Route
    Route::resource('sales', SaleController::class);
    Route::get('/invoice/{id}/download', [SaleController::class, 'downloadInvoice'])->name('invoice.download');
});




require __DIR__.'/auth.php';
