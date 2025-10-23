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

        // if (Auth::guard('web')->check()) {
        //     return redirect('/'); 
        // }
        //dd(session()->all(), Auth::guard('web')->check(), Auth::getDefaultDriver());
        
        

        return view('auth.store_login');
    }

    //ログイン処理
    public function login(Request $request){

        $credentials = $request->only('email', 'password');

        Auth::shouldUse('web');

        if(Auth::guard('web')->attempt($credentials)){

            Auth::shouldUse('web');

            //dd(session()->all());

            //dd(Auth::guard('web')->check(), session()->all()); // 認証状態とセッション内容を確認

            //dd(Auth::guard()->getName());


            $user = Auth::guard('web')->user();

            if($user && $user->role === "0"){

                return redirect()->intended(route('store.management'));   
                
                
            }else{
                Auth::guard('web')->logout();
                return redirect()->route('store.login')->withErrors(['error' => '無効なユーザー権限です。']);
            }
        }

        return redirect('/store_login')->withErrors(['error' => '無効なな承認情報です。']);
    }

    public function logout(Request $request){

        Auth::guard('web')->logout();
        $request->session()->regenerateToken();

        return redirect()->route('store.login')->with(['auth' => ['ログアウトしました'],]);
    }
}
