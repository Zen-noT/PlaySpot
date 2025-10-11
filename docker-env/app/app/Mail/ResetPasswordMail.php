<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use App\Models\User;
use Carbon\Carbon;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, User $token)
    {
        $this->user = $user;
        $this->token = $token;
    }
    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        //トークン取得
        $token =['reset_token' => $this->token->token->rest_password_token_access_key];
        $now = Carbon::now();

        //トークンの有効期限付きURLを生成
        $url = URL::temporarySignedRoute('password.reset', $now->addMinutes(1), $token);

        //メール作成
        return $this->view('emails.reset_password')
                    ->subject('パスワード再設定用のURLのご案内')
                    ->form(config('mail.from.address'), config('mail.from.name'))
                    ->to($this->user->email)
                    ->with([
                        'user' => $this->user,
                        'url' => $url]);
 
    }
}
