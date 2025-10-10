<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\RoleLoginController;   




//共通
Route::get('/', function () {return view('auth.user_login');});
Route::get('/user_login', [UserLoginController::class, 'showLoginForm'])->name('user.login');
Route::get('/store_login', [RoleLoginController::class, 'showLoginForm'])->name('store.login');

// 新規登録画面
Route::get('/user_create', [UserController::class, 'user_create'])->name('user.create');
Route::get('/store_create', [UserController::class, 'store_create'])->name('store.create');

// 新規登録処理
Route::post('/user_create', [UserController::class, 'user_store'])->name('user.store');
Route::post('/store_create', [UserController::class, 'store_store'])->name('store.store');

//パスワードリセット画面
Route::get('/user_reset', function () {return view('user_reset');})->name('user.reset');
Route::get('/store_reset', function () {return view('store_reset');})->name('store.reset');


Route::resource('users', UserController::class);

// 一般ユーザー権限
Route::group(['middleware' => 'user.auth'], function() {

    Route::post('/user_login', [UserLoginController::class, 'login'])->name('user.login');
    Route::post('/logout', [UserLoginController::class, 'logout'])->name('user.logout');
    
});

// 店舗ユーザー権限
Route::group(['middleware' => 'role.auth'], function(){

    Route::post('/store_login', [RoleLoginController::class, 'login'])->name('store.login');
    Route::post('/logout', [RoleLoginController::class, 'logout'])->name('store.logout');

});















?>