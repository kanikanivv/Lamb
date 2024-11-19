<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;

// 商品一覧
Route::get('/items', [ItemsController::class, 'index'])->name('items.index');
Route::get('/items/{id}', [ItemsController::class, 'show'])->name('items.show');
