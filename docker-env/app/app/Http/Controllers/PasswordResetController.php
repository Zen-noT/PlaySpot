<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    public function user_send(Request $request){
        // バリデーション
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // パスワードリセットメール送信処理（実装は省略）

        return redirect()->route('user.send_complete');
    }
    public function store_send(Request $request){
        // バリデーション
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // パスワードリセットメール送信処理（実装は省略）

        return redirect()->route('store.send_complete');
    }
    
    public function user_edit_password(Request $request){
        $token = $request->query('token');
        return view('user_edit_password', ['token' => $token]);
    }
    public function store_edit_password(Request $request){
        $token = $request->query('token');
        return view('store_edit_password', ['token' => $token]);
    }

    public function user_update_password(Request $request){
        // バリデーション
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // パスワード更新処理（実装は省略）

        return redirect()->route('user.login')->with('status', 'パスワードが更新されました。');
    }
    public function store_update_password(Request $request){
        // バリデーション
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // パスワード更新処理（実装は省略）

        return redirect()->route('store.login')->with('status', 'パスワードが更新されました。');
    }
}
