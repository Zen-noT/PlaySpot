<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Requests\PasswordResetRequest;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ResetMailSendRequest;

class PasswordResetController extends Controller
{
    private $userRepository;
    private const MAIL_SEND_SESSION_KEY = 'user_reset_password_mail_sended_action';

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }




    public function user_send(ResetMailSendRequest $request){
        
        try{
            //ユーザー情報取得
            $user = $this->userRepository->findFromEmail($request->email);
            $Token = $this->userRepository->updateOrCreateUser($user->id);

            //メール送信
            Log::info('メール送信処理開始');
            Mail::send(new PasswordResetMail($user,$Token));
            Log::info('メール送信処理終了');
        }catch(Exception $e){
            Log::error($e->getMessage());
            return back()->withErrors(['email' => 'メールの送信に失敗しました。時間をおいて再度お試しください。']);
        }

        // 不正アクセス防止セッションキー
        session()->put(self::MAIL_SEND_SESSION_KEY, 'user_reset_password_send_email');

        return redirect()->route('user.send_complete');
    }

    public function store_send(ResetMailSendRequest $request){

        try{
            //ユーザー情報取得
            $user = $this->userRepository->getUserByEmail($request->email);
            $Token = $this->userRepository->updateOrCreateUser($user->id);

            //メール送信
            Log::info('メール送信処理開始');
            Mail::send(new PasswordResetMail($user,$Token));
            Log::info('メール送信処理終了');
        }catch(Exception $e){
            Log::error($e->getMessage());
            return back()->withErrors(['email' => 'メールの送信に失敗しました。時間をおいて再度お試しください。']);
        }

        // 不正アクセス防止セッションキー
        session()->put(self::MAIL_SEND_SESSION_KEY, 'user_reset_password_send_email');

        return redirect()->route('store.send_complete');
    }

    public function user_send_complete(){
        //不正アクセス防止
        if(session()->get(self::MAIL_SEND_SESSION_KEY) !== 'user_reset_password_send_email'){
            return redirect()->route('user.reset')
            ->with('error', '不正なアクセスです。');
        }
        return view('user_send_complete');
    }
    
    public function user_edit_password(Request $request){
        //署名付きURLではない場合
        if (!$request->hasValidSignature()) {
            abort(403,'URLの有効期限が切れています。再度パスワードリセットを行ってください。');
        }
        $resetToken = $request->query('token');
        
        try{
            $userToken = $this->userRepository->getUserByToken($resetToken);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('user.reset')
            ->with('error', '不正なアクセスです。再度やり直してください。');
        }
        return view('user_edit_password', ['token' => $token]);
    }
    public function store_edit_password(Request $request){
        
        //署名付きURLではない場合
        if (!$request->hasValidSignature()) {
            abort(403,'URLの有効期限が切れています。再度パスワードリセットを行ってください。');
        }
        $resetToken = $request->query('token');
        
        try{
            $userToken = $this->userRepository->getUserByToken($resetToken);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('user.reset')
            ->with('error', '不正なアクセスです。再度やり直してください。');
        }
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
