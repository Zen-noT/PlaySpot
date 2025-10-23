<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\RoleLoginController;   
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Auth;



//ログイン画面
Route::get('/user_login', [UserLoginController::class, 'showLoginForm'])->name('user.login');

Route::post('/user_login', [UserLoginController::class, 'login'])->name('user.login.submit');
Route::post('/logout/user', [UserLoginController::class, 'logout'])->name('user.logout');


Route::get('/store_login', [RoleLoginController::class, 'showLoginForm'])->name('store.login');

Route::post('/store_login', [RoleLoginController::class, 'login'])->name('store.login.submit');
Route::post('/logout/store', [RoleLoginController::class, 'logout'])->name('store.logout');


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


// 一般ユーザー権限
Route::group(['middleware' => 'auth.members:members'], function() {

    Route::get('/search', function () {return view('search');})->name('user.search');
    Route::get('/shops', [ShopController::class, 'index'])->name('shops.search');
    Route::get('/mypage', function () {return view('mypage');})->name('user.mypage');

    Route::get('/user/update', function () {return view('profile_edit');})->name('user.update');
    Route::post('/user/update', [UserController::class, 'user_update'])->name('user.update.submit');

    Route::get('/user/delete', function () {return view('user_delete');})->name('user.delete');
    Route::post('/user/delete', [UserController::class, 'user_delete'])->name('user.delete.submit');


    Route::get('/shops/detail/{shop}', [ShopController::class, 'shop_detail'])->name('shops.detail');
    //ajax
    Route::get('/shops/evaluation_create', [ShopController::class, 'evaluation_create'])->name('shops.evaluation_create');
    
});

// 店舗ユーザー権限
Route::group(['middleware' => 'auth.stores:web'], function(){

    Route::get('/store/management', [ShopController::class, 'show_management'])->name('store.management');

    Route::get('/shop/create', function () {return view('shop_create');})->name('shop.create');
    Route::post('/shop/create', [ShopController::class, 'shop_create'])->name('shop.create.submit');

    Route::get('/store/delete', function () {return view('store_delete');})->name('store.delete');
    Route::post('/store/delete', [UserController::class, 'store_delete'])->name('store.delete.submit');

    Route::post('/shop/waittime/submit', [ShopController::class, 'wait_time_update'])->name('wait.time.submit');

    Route::get('/shop/edit', [ShopController::class, 'edit'])->name('shop.edit');
    Route::post('/shop/edit', [ShopController::class, 'shop_update'])->name('shop.edit.submit');

    Route::get('/shop/delete', [ShopController::class, 'shop_delete_form'])->name('shop.delete');
    Route::post('/shop/delete', [ShopController::class, 'shop_destroy'])->name('shop.delete.submit');

});















?>