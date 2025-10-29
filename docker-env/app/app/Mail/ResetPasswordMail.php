<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;


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
    public function __construct(User $user,$token)
    {
        $this->user = $user;
        $this->token = $token;
        Log::info('送信先メールアドレス: ' . $this->user->email);
    }
    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){

        $now = Carbon::now();

        //トークンの有効期限付きURLを生成
        $url = URL::temporarySignedRoute('user.edit_password', $now->addMinutes(60), ['token' => $this->token]);

        Log::info('送信先メールアドレス: ' . $this->user->email);

        //メール作成
        return $this->view('mails.password_reset_mail')
                    ->subject('パスワード再設定用のURLのご案内')
                    ->from('no-reply@example.test', 'TestMail')
                    // ->from(config('mail.from.address'), config('mail.from.name'))
                    ->with([
                        'user' => $this->user,
                        'url' => $url]);
 
    }
}
