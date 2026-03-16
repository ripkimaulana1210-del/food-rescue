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

Route::get('/', [FoodController::class, 'home']);

Route::get('/foods', [FoodController::class, 'index']);
Route::get('/foods/{id}', [FoodController::class, 'show']);


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);


/*
|--------------------------------------------------------------------------
| USER ACTION
|--------------------------------------------------------------------------
*/

Route::post('/foods/buy/{id}', [FoodController::class, 'buy']);
Route::post('/foods/checkout/{id}', [FoodController::class, 'checkout']);
Route::post('/foods/pay/{id}', [FoodController::class, 'pay']);


/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/sell', [FoodController::class, 'create']);
    Route::post('/sell', [FoodController::class, 'store']);

    Route::get('/my-foods', [FoodController::class, 'myFoods']);

    Route::get('/dashboard', function () {

        if (Auth::user()->role == "admin") {
            return view('admin.dashboard');
        }

        if (Auth::user()->role == "store") {
            return view('store.dashboard');
        }

        return view('home');
    });
});

Route::middleware('auth')->group(function () {

    Route::get('/sell', [FoodController::class, 'create']);
    Route::post('/foods', [FoodController::class, 'store']);

    Route::get('/my-foods', [FoodController::class, 'myFoods']);

    Route::get('/foods/{id}/edit', [FoodController::class, 'edit']);
    Route::put('/foods/{id}', [FoodController::class, 'update']);

    Route::delete('/foods/{id}', [FoodController::class, 'destroy']);
});
