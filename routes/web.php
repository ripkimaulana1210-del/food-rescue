<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\AuthController;

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

Route::get('/logout', [AuthController::class, 'logout']);


/*
|--------------------------------------------------------------------------
| USER ACTION
|--------------------------------------------------------------------------
*/

Route::prefix('foods')->group(function () {
    Route::post('/buy/{id}', [FoodController::class, 'buy'])->name('foods.buy');
    Route::post('/checkout/{id}', [FoodController::class, 'checkout'])->name('foods.checkout');
    Route::post('/pay/{id}', [FoodController::class, 'pay'])->name('foods.pay');
});


/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /* SELL */
    Route::get('/sell', [FoodController::class, 'create'])->name('foods.create');
    Route::post('/sell', [FoodController::class, 'store'])->name('foods.store');

    /* MY FOODS */
    Route::get('/my-foods', [FoodController::class, 'myFoods'])->name('foods.my');

    /* FOOD MANAGEMENT */
    Route::prefix('foods')->group(function () {
        Route::get('/{id}/edit', [FoodController::class, 'edit'])->name('foods.edit');
        Route::put('/{id}', [FoodController::class, 'update'])->name('foods.update');
        Route::delete('/{id}', [FoodController::class, 'destroy'])->name('foods.delete');
    });

    /* 🔥 PESANAN (FIX PENTING) */
    Route::get('/pesanan', [FoodController::class, 'pesanan'])->name('pesanan');
});