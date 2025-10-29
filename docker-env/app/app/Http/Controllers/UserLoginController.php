<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserLoginController extends Controller
{
    
    public function showLoginForm(){

        if (Auth::guard('members')->check()) {
            return redirect('/search'); 
        }
        return view('auth.user_login');
    }

    //ログイン処理
    public function login(Request $request){

        $credentials = $request->only('email', 'password');

        if(Auth::guard('members')->attempt($credentials)){

            $user = Auth::guard('members')->user();

            if($user && $user->role == 1){
                return redirect()->route('user.search');
            }else{
                Auth::guard('members')->logout();
                return redirect()->route('user.login')->withErrors(['error' => '無効なユーザー権限です。']);
            }
        }
        

        return redirect('/login/user')->withErrors(['error' => '無効なな承認情報です。'])->withInput();
    }

    public function logout(Request $request){

        Auth::guard('members')->logout();
        $request->session()->regenerateToken();

        return redirect()->route('user.login')->with(['auth' => ['ログアウトしました'],]);
    }
}
