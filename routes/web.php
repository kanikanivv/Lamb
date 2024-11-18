<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\auth\RegisterController;

Route::get('/', [ItemsController::class, 'index']);

//新規登録画面から新規登録処理
    Auth::routes();
    Route::middleware('guest')->group(function () {
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [RegisterController::class, 'register']);
    });
// Route::get('/items', [ItemsController::class, 'index']);


