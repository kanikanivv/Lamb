<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;

Route::get('/', [ItemsController::class, 'index']);
Route::get('/items', [ItemsController::class, 'index']);
