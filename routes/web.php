<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\Admin\ItemsController as AdminItemsController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\CartController;



//カート処理
Route::prefix('carts')->name('carts.')->group(function() {
    Route::get('/',  [CartController::class, 'index'])->name('index');
    Route::post('/', [CartController::class, 'store'])->name('store');
});

//新規登録画面から新規登録処理
Auth::routes();
Route::get('/register',  [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// 商品一覧
Route::prefix('items')->name('items.')->group(function() {
    Route::get('/',     [ItemsController::class, 'index'])->name('index');
    Route::get('/{id}', [ItemsController::class, 'show'])->name('show');
});

// お届け先確認画面
Route::get('/address', [OrderController::class, 'index'])->name('order.index');

// 購入完了
Route::get('/thanks', [ItemsController::class, 'done'])->name('items.done');

// admin:管理画面
Route::prefix('admin')->name('admin.')->group(function() {

    // items:商品管理
    Route::prefix('items')->name('items.')->group(function() {
        Route::get('index',   [AdminItemsController::class, 'index'])->name('index');
        Route::get('create',  [AdminItemsController::class, 'create'])->name('create');
        Route::post('create',  [AdminItemsController::class, 'store'])->name('store');
    });
});
