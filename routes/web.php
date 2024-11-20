<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\CartController;

<<<<<<< HEAD




//カート処理
Route::get('/carts',  [CartController::class, 'index'])->name('carts.index');//表示
Route::post('carts', [CartController::class, 'store'])->name('carts.store');//追加

=======
>>>>>>> 68be6f3cdb5f38f7008c444bba06140637c839d7
//新規登録画面から新規登録処理
Auth::routes();
Route::get('/register',  [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
<<<<<<< HEAD
Route::get('/items', [ItemsController::class, 'index']);

// 商品一覧
Route::get('/items', [ItemsController::class, 'index'])->name('items.index');
Route::get('/items/{id}', [ItemsController::class, 'show'])->name('items.show');
=======

// 商品一覧
Route::prefix('items')->name('items.')->group(function() {
    Route::get('/',     [ItemsController::class, 'index'])->name('index');
    Route::get('/{id}', [ItemsController::class, 'show'])->name('show');
});

// お届け先確認画面
Route::get('/address', [OrderController::class, 'index'])->name('order.index');

// 購入完了
Route::get('/thanks', [ItemsController::class, 'done'])->name('items.done');

// 管理画面
Route::prefix('admin')->name('admin')->group(function() {

    // items:商品管理
    Route::prefix('items')->name('items.')->group(function() {
        Route::get('create', [ItemsController::class, 'create'])->name('create');
    });
});
>>>>>>> 68be6f3cdb5f38f7008c444bba06140637c839d7
