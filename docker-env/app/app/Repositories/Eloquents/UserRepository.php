<?php

namespace App\Repositories\Eloquents;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserRepository implements UserRepositoryInterface
{
    private $user;
    private $userToken;

    public function __construct(User $user, User $userToken)
    {
        $this->user = $user;
        $this->userToken = $userToken;
    }

    // メールアドレスからユーザー情報を取得
    public function findFromEmail(string $email): User
    {
        return $this->user->where('email', $email)->first();
    }

    // パスワードリセット用トークンを発行
    public function updateOrCreateUser(int $userId): User
    {
        $now = Carbon::now();
        //idをハッシュ化
        $token = hash('sha256',$userId);
        return $this->userToken->updateOrCreate(
            ['id' => $userId],
            [
                // $tokenを含むトークンを作成
                'rest_password_access_key' =>uniqid(rand(), $token),
                //1時間有効
                'rest_password_access_limit' => $now->addHour()->toDateTimeString() 
            ]
        );
    }

    // トークンからユーザー情報を取得
    public function getUserTokenFromUser(string $token): User
    {
        return $this->userToken->where('rest_password_access_key', $token)->first();
    }

    // ユーザーのパスワードを更新
    public function updateUserPassword(int $userId, string $newPassword): void
    {
        $this->user->where('id', $userId)->update(['password' => $newPassword]);
    }
}