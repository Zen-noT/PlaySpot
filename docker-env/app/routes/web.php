<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\RoleLoginController;   
use App\Http\Controllers\PasswordResetController;




//共通
Route::get('/', function () {return view('auth.user_login');});
Route::get('/login/user', [UserLoginController::class, 'showLoginForm'])->name('user.login');
Route::get('/login/store', [RoleLoginController::class, 'showLoginForm'])->name('store.login');

Route::prefix('create')->group(function () {
    // 新規登録画面
    Route::get('/user', [UserController::class, 'user_create'])->name('user.create');
    Route::get('/store', [UserController::class, 'store_create'])->name('store.create');

    // 新規登録処理
    Route::post('/user', [UserController::class, 'user_store'])->name('user.store');
    Route::post('/store', [UserController::class, 'store_store'])->name('store.store');
});

Route::prefix('reset')->group(function () {
    //パスワードリセット画面
    Route::get('/user/form', function () {return view('user_reset');})->name('user.reset');
    Route::get('/store/form', function () {return view('store_reset');})->name('store.reset');
    //メール送信処理
    Route::post('/user/send', [PasswordResetController::class,'user_send'])->name('user.sendmail');
    Route::post('/store/send', [PasswordResetController::class,'store_send'])->name('store.sendmail');
    //メール送信完了
    Route::get('/user/complete', function () {return view('user_send_complete');})->name('user.send_complete');
    Route::get('/store/complete', function () {return view('store_send_complete');})->name('store.send_complete');
    //パスワード再設定画面
    Route::get('/user/edit', [PasswordResetController::class,'user_edit_password'])->name('user.edit_password');
    Route::get('/store/edit', [PasswordResetController::class,'store_edit_password'])->name('store.edit_password');
    //パスワード更新処理
    Route::post('/user/update', [PasswordResetController::class,'user_update_password'])->name('user.update_password');
    Route::post('/store/update', [PasswordResetController::class,'store_update_password'])->name('store.update_password');
    //パスワード更新完了
    Route::get('/user/password/complete', function () {return view('user_password_complete');})->name('user.password_complete');
    Route::get('/store/password/complete', function () {return view('store_password_complete');})->name('store.password_complete');
});

Route::resource('users', UserController::class);

// 一般ユーザー権限
Route::group(['middleware' => 'user.auth'], function() {

    Route::post('/user_login', [UserLoginController::class, 'login'])->name('user.login.submit');
    Route::post('/logout', [UserLoginController::class, 'logout'])->name('user.logout');
    
});

// 店舗ユーザー権限
Route::group(['middleware' => 'role.auth'], function(){

    Route::post('/store_login', [RoleLoginController::class, 'login'])->name('store.login');
    Route::post('/logout', [RoleLoginController::class, 'logout'])->name('store.logout');

});















?>