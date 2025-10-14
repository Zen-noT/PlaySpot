<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserLoginController extends Controller
{
    public function showLoginForm(){
        return view('search');
    }

    public function login(Request $request){

        $credentials = $request->only('email', 'password');

        if(Auth::guard('user')->attempt($credentials)){

            $user = Auth::user();

            if($user->role === "1"){
                return redirect()->intended('/search');
            }else{
                Auth::logout();
                return redirect('/user_login')->withErrors(['error' => '無効なユーザー権限です。']);
            }
        }

        return redirect('/user_login')->withErrors(['error' => '無効なな承認情報です。']);
    }

    public function logout(){
        Auth::guard('user')->logout();
        return redirect('/user_login');
    }
}
