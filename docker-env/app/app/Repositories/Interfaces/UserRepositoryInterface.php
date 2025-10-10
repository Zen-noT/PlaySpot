<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * メールアドレスからユーザー情報を取得
     *
     * @param string $email
     * @return User
     */
    public function findFromEmail(string $email): User;

    /**
     * パスワードリセット用トークンを発行
     *
     * @param int $userId
     * @return User
     */
    public function updateOrCreateUser(int $userId): User;
}
