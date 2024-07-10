<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\PrincipalPICController;

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
Route::get('/principal/pic/{id}', [PrincipalController::class, 'showPrincipalPIC'])->name('principal.pic');

Route::middleware(['auth'])->group(function () {
    Route::get('/principal-pic/{brand}', [PrincipalPICController::class, 'index'])->name('principal.pic');
    Route::post('/principal-pic/{brand}', [PrincipalPICController::class, 'store'])->name('principal.pic.store');
    Route::delete('/principal-pic/{brand}/{pic}', [PrincipalPICController::class, 'destroy'])->name('principal.pic.destroy');
});
