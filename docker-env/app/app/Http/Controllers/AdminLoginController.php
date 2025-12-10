<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    
    public function showAdminLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin/home'); 
        }
        return view('auth.admin_login');
    }

    //ログイン処理
    public function login(Request $request){

        $credentials = $request->only('email', 'password');

        if(Auth::guard('admin')->attempt($credentials)){

            $user = Auth::guard('admin')->user();

            if($user && $user->role == 3){
                return redirect()->route('admin.home');
            }else{
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->withErrors(['error' => '無効なユーザー権限です。']);
            }
        }
        

        return redirect('/admin_login')->withErrors(['error' => '無効なな承認情報です。'])->withInput();
    }

    public function logout(Request $request){

        Auth::guard('admin')->logout();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with(['auth' => ['ログアウトしました'],]);
    }
}
