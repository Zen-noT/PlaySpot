<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RoleLoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.store_login');
    }

    public function login(Request $request){

        $credentials = $request->only('email', 'password');

        if(Auth::guard('store')->attempt($credentials)){
            $user = Auth::user();

            if($user->role === "0"){
                return redirect()->intended('/management');
            }else{
                Auth::logout();
                return redirect('/store_login')->withErrors(['error' => '無効なユーザー権限です。']);
            }
        }

        return redirect('/store_login')->withErrors(['error' => '無効なな承認情報です。']);
    }

    public function logout(){
        Auth::guard('store')->logout();
        return redirect('/store_login');
    }
}
