<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [FoodController::class, 'home'])->name('home');

Route::prefix('foods')->group(function () {
    Route::get('/', [FoodController::class, 'index'])->name('foods.index');
    Route::get('/{id}', [FoodController::class, 'show'])->name('foods.show');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/* ===================== FORGOT / RESET PASSWORD ===================== */
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetCode'])->name('password.email');

Route::get('/verify-code', [AuthController::class, 'showVerifyCodeForm'])->name('password.verify-code');
Route::post('/verify-code', [AuthController::class, 'verifyCode'])->name('password.verify-code.post');

Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset.post');

/*
|--------------------------------------------------------------------------
| USER ACTION
|--------------------------------------------------------------------------
*/

Route::prefix('foods')->group(function () {

    // ambil makanan langsung
    Route::post('/buy/{id}', [FoodController::class, 'buy'])->name('foods.buy');

    // tampilkan halaman checkout
    Route::post('/checkout/{id}', [FoodController::class, 'checkout'])->name('foods.checkout');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /* ===================== SELL ===================== */
    Route::get('/sell', [FoodController::class, 'create'])->name('foods.create');
    Route::post('/sell', [FoodController::class, 'store'])->name('foods.store');

    /* ===================== MY FOODS ===================== */
    Route::get('/my-foods', [FoodController::class, 'myFoods'])->name('foods.my');

    /* ===================== FOOD MANAGEMENT ===================== */
    Route::prefix('foods')->group(function () {
        Route::get('/{id}/edit', [FoodController::class, 'edit'])->name('foods.edit');
        Route::put('/{id}', [FoodController::class, 'update'])->name('foods.update');
        Route::delete('/{id}', [FoodController::class, 'destroy'])->name('foods.delete');
    });

    /* ===================== ORDER ===================== */

    // 🔥 PROSES ORDER (PINDAH KE ORDER CONTROLLER)
    Route::post('/orders/store/{id}', [OrderController::class, 'store'])
        ->name('orders.store');

    // 🔥 LIST PESANAN USER
    Route::get('/my-orders', [OrderController::class, 'index'])
        ->name('orders.index');

    // 🔥 DETAIL PESANAN
    Route::get('/orders/{id}', [OrderController::class, 'show'])
        ->name('orders.show');

    // 🔥 PESANAN MASUK (STORE)
    Route::get('/pesanan', [FoodController::class, 'pesanan'])
        ->name('store.orders');

    // 🔥 KONFIRMASI PEMBAYARAN
    Route::post('/orders/confirm/{id}', [OrderController::class, 'confirm'])
        ->name('orders.confirm');
});

Route::get('/scan', function () {
    return view('orders.scan');
})->middleware('auth')->name('orders.scan');

Route::post('/scan', [OrderController::class, 'scan'])->name('orders.scan.process');

Route::get('/scan/{code}', [OrderController::class, 'showScanResult'])
    ->middleware('auth')
    ->name('orders.scan.result');

Route::post('/orders/complete/{id}', [OrderController::class, 'complete'])
    ->middleware('auth')
    ->name('orders.complete');
