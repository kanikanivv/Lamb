<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\Admin\ItemsController as AdminItemsController;
use App\Http\Controllers\Admin\CategoriesController as AdminCategoriesController;
use App\Http\Controllers\Admin\SizesController as AdminSizesController;
use App\Http\Controllers\Admin\GendersController as AdminGendersController;
use App\Http\Controllers\Admin\ItemsCategoryController as AdminItemsCategoryController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\CartController;




//カート処理
Route::get('/carts',  [CartController::class, 'index'])->name('carts.index');//表示
Route::post('carts',  [CartController::class, 'store'])->name('carts.store');//追加


//新規登録画面から新規登録処理
Auth::routes();
Route::get('/register',  [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/items', [ItemsController::class, 'index']);


// 商品一覧
Route::prefix('items')->name('items.')->group(function() {
    Route::get('/',     [ItemsController::class, 'index'])->name('index');
    Route::get('/{id}', [ItemsController::class, 'show'])->name('show');
});

// お届け先確認画面
Route::get('/address', [OrderController::class, 'index'])->name('order.index');

// 購入完了
Route::get('/thanks', [ItemsController::class, 'done'])->name('items.done');

//ログイン機能
Route::prefix('admin')->name('admin.')->group(function () {
    //管理者ログインフォームの表示
    Route::get('login',  [LoginController::class, 'showLoginForm'])->name('login');
    //管理者ログイン処理
    Route::post('login', [LoginController::class, 'adminLogin'])->name('login');
});

// 管理画面
Route::prefix('admin')->name('admin.')->group(function() {
    // items:商品管理
    Route::prefix('items')->name('items.')->group(function() {
        Route::get('index',          [AdminItemsController::class, 'index'])->name('index');
        Route::delete('index/{id}',  [AdminItemsController::class, 'destroy'])->name('destroy');
    });

    //カテゴリー一覧
    Route::prefix('categories')->name('categories.')->group(function() {
        Route::get('index',         [AdminCategoriesController::class, 'index'])->name('index');
        //アイテム一覧表示
        Route::get('/itemscategory/index',                 [AdminItemsCategoryController::class, 'index'])->name('itemscategory.index');
        //アイテム編集画面表示
        Route::get('/itemscategory/create',                [AdminItemsCategoryController::class, 'create'])->name('itemscategory.create');
        //アイテム新規追加処理
        Route::post('/itemscategory',                      [AdminItemsCategoryController::class, 'store'])->name('itemscategory.store');
        //アイテム新規登録画面表示
        Route::get('/itemscategory/{itemcategory}/edit',   [AdminItemsCategoryController::class, 'edit'])->name('itemscategory.edit');
        //アイテム更新処理
        Route::put('/itemscategory/{id}',                  [AdminItemsCategoryController::class, 'update'])->name('itemscategory.update');
        //アイテム削除処理
        Route::get('/itemscategory/{id}',                  [AdminItemsCategoryController::class, 'destroy'])->name('itemscategory.destroy');
        Route::delete('/itemscategory/{id}',               [AdminItemsCategoryController::class, 'destroy'])->name('itemscategory.destroy');

        //サイズ一覧表示
        Route::get('/sizes/index', [AdminSizesController::class, 'index'])->name('sizes.index');
        //性別一覧表示
        Route::get('/genders/index', [AdminGendersController::class, 'index'])->name('genders.index');
    });
});
