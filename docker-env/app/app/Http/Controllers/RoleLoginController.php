<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Session;

class RoleLoginController extends Controller
{

    public function showLoginForm(){

        if (Auth::check()) {
            return redirect('/store/management'); 
        }
        
        return view('auth.store_login');
    }

    //ログイン処理
    public function login(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        //if(Auth::guard('web')->attempt($credentials)){
        if (Auth::attempt(array_merge($credentials, ['role' => '0']))) {

            $request->session()->regenerate();
            return redirect()->route('store.management'); 

        }else{
            return redirect('/login/store_user/error');
        }

        return redirect('/store_login')->withErrors(['error' => '無効なな承認情報です。']);
    }

    public function logout(Request $request){

        Auth::guard('web')->logout();
        $request->session()->regenerateToken();

        return redirect()->route('store.login')->with(['auth' => ['ログアウトしました'],]);
    }
}
