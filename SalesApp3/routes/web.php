<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\PrincipalPICController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\DistributorPICController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientPICController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;

Route::get('/laravel', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/', function () {
    return view('homepagetrial');
});

require __DIR__.'/auth.php';

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'processSignup'])->name('signup.submit');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.submit');
Route::get('/get-user-position', [AuthController::class, 'getUserPosition']);
Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('forgot-password', [AuthController::class, 'processForgotPassword'])->name('forgot-password.submit');
Route::get('reset-password/{email}', [AuthController::class, 'showResetPasswordForm'])->name('reset-password');
Route::post('reset-password', [AuthController::class, 'processResetPassword'])->name('reset-password.submit');

Route::get('/homepage', [HomeController::class, 'index'])->name('homepage')->middleware('auth');
Route::post('/change-status/{id}', [UserController::class, 'changeStatus'])->name('change-status');
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

Route::get('/principal', [PageController::class, 'principal'])->name('principal');
Route::get('/distributor', [PageController::class, 'distributor'])->name('distributor');
Route::get('/client', [PageController::class, 'client'])->name('client');
Route::get('/sales', [PageController::class, 'sales'])->name('sales');
Route::get('/product', [PageController::class, 'product'])->name('product');

Route::get('/principal', [PrincipalController::class, 'index'])->name('principal.index')->middleware('auth');
Route::post('/principal', [PrincipalController::class, 'store'])->name('principal.store')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance');
Route::put('/principal/{id}', [PrincipalController::class, 'update'])->name('principal.update')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance');
Route::delete('/principal/{id}', [PrincipalController::class, 'destroy'])->name('principal.destroy')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance');
Route::get('/principal/{id}', [PrincipalController::class, 'show'])->name('principal.show')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/principal/{id}/pics', [PrincipalPICController::class, 'index'])->name('principal.pic')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance');
    Route::post('/principal/{id}/pics', [PrincipalPICController::class, 'store'])->name('principal.pic.store')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance');
    Route::delete('/principal/{id}/pics/{Principal_PIC_ID}', [PrincipalPICController::class, 'destroy'])->name('principal.pic.destroy')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/distributor', [DistributorController::class, 'index'])->name('distributor.index')->middleware('auth');
    Route::post('/distributor', [DistributorController::class, 'store'])->name('distributor.store')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance');
    Route::put('/distributor/{id}', [DistributorController::class, 'update'])->name('distributor.update')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance');
    Route::delete('/distributor/{id}', [DistributorController::class, 'destroy'])->name('distributor.destroy')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance');
    Route::get('/distributor/{id}', [DistributorController::class, 'show'])->name('distributor.show')->middleware('auth');
    Route::get('/distributor/{id}', [DistributorController::class, 'getDistributor'])->name('distributor.get');
    Route::get('/principals', [DistributorController::class, 'getPrincipal']);    
});

Route::middleware(['auth'])->group(function () {
    Route::get('/distributor/{id}/pics', [DistributorPICController::class, 'index'])->name('distributor.pic')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance');
    Route::post('/distributor/{id}/pics', [DistributorPICController::class, 'store'])->name('distributor.pic.store')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance');
    Route::delete('/distributor/{id}/pics/{Distributor_PIC_ID}', [DistributorPICController::class, 'destroy'])->name('distributor.pic.destroy')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/client', [ClientController::class, 'index'])->name('client.index')->middleware('auth');
    Route::post('/client', [ClientController::class, 'store'])->name('client.store')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance,Sales,Manager');
    Route::put('/client/{id}', [ClientController::class, 'update'])->name('client.update')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance,Sales,Manager');
    Route::delete('/client/{id}', [ClientController::class, 'destroy'])->name('client.destroy')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance,Sales,Manager');
    Route::get('/client/{id}', [ClientController::class, 'show'])->name('client.show')->middleware('auth');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/client/{id}/pics', [ClientPICController::class, 'index'])->name('client.pic')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance,Sales,Manager');
    Route::post('/client/{id}/pics', [ClientPICController::class, 'store'])->name('client.pic.store')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance,Sales,Manager');
    Route::delete('/client/{id}/pics/{Client_PIC_ID}', [ClientPICController::class, 'destroy'])->name('client.pic.destroy')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance,Sales,Manager');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/product', [ProductController::class, 'index'])->name('product')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance,Sales,Manager');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store')->middleware('auth', 'checkUserPosition:Super Admin,Sales,Manager');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update')->middleware('auth', 'checkUserPosition:Super Admin,Sales,Manager');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy')->middleware('auth', 'checkUserPosition:Super Admin,Sales,Manager');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show')->middleware('auth');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/sales', [SaleController::class, 'index'])->name('sales')->middleware('auth', 'checkUserPosition:Super Admin,Admin/Finance,Sales,Manager');
    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
    Route::put('/sales/{id}', [SaleController::class, 'update'])->name('sales.update')->middleware('auth', 'checkUserPosition:Super Admin,Sales,Manager');
    Route::delete('/sales/{id}', [SaleController::class, 'destroy'])->name('sales.destroy')->middleware('auth', 'checkUserPosition:Super Admin,Sales,Manager');
    Route::get('/sales/{id}', [SaleController::class, 'show'])->name('sales.show')->middleware('auth');
    Route::get('/sales/client-pic/{clientId}', [SaleController::class, 'getClientPICs']);
    Route::get('/sales/distributors/{brandId}', [SaleController::class, 'getDistributors']);
    Route::get('/sales/products/{brandId}', [SaleController::class, 'getProducts']);
    Route::get('/sales/product-category/{productId}', [SaleController::class, 'getCategory']);
});