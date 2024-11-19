<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\CartController;





//カート処理
Route::get('/carts',  [CartController::class, 'index'])->name('carts.index');//表示
Route::post('/carts', [CartController::class, 'store'])->name('carts.store');//追加

//新規登録画面から新規登録処理
Auth::routes();
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/items', [ItemsController::class, 'index']);

// 商品一覧
Route::get('/items', [ItemsController::class, 'index'])->name('items.index');
Route::get('/items/{id}', [ItemsController::class, 'show'])->name('items.show');

