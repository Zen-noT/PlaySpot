<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class RoleLoginController extends Controller
{
    public function showLoginForm(){
        // if (Auth::guard('stores')->check()) {
        //     return redirect('/'); 
        // }
        return view('auth.store_login');
    }

    public function login(Request $request){

        $credentials = $request->only('email', 'password');

        if(Auth::guard('stores')->attempt($credentials)){

            $user = Auth::guard('stores')->user();

            if($user && $user->role === "0"){

                return redirect()->route('store.management');              //後で設定
            }else{
                Auth::guard('stores')->logout();
                return redirect()->route('store.login')->withErrors(['error' => '無効なユーザー権限です。']);
            }
        }

        return redirect('/store_login')->withErrors(['error' => '無効なな承認情報です。']);
    }

    public function logout(){

        Auth::guard('stores')->logout();
        $request->session()->regenerateToken();

        return redirect()->route('store.login')->with(['auth' => ['ログアウトしました'],]);
    }
}
