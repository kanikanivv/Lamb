<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\auth\RegisterController;

Route::get('/', [ItemsController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//ログイン画面から新規登録に遷移
Route::post('/register', [App\Http\Controllers\auth\RegisterController::class, 'index']);
//新規登録画面から新規登録処理
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

