<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;

Route::get('/items', [ItemsController::class, 'index']);
j
