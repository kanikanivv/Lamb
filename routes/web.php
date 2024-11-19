<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\auth\RegisterController;

<<<<<<< HEAD
Route::get('/', [ItemsController::class, 'index']);

//新規登録画面から新規登録処理
Auth::routes();
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/items', [ItemsController::class, 'index']);
=======
// 商品一覧
Route::get('/items', [ItemsController::class, 'index'])->name('items.index');
Route::get('/items/{id}', [ItemsController::class, 'show'])->name('items.show');
>>>>>>> feature/202411/sekiya
