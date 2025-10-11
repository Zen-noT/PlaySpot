<?php

namespace App\Rules;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class TokenExpirationTimeCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $now = Carbon::now();
        $userRepository = app(UserRepositoryInterface::class);
        $userToken = $userRepository->getUserByToken($value);
        $expirationTime = new Carbon($userToken->token_created_at);

        return $now->lte($expirationTime);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'このリンクの有効期限が切れています。再度パスワードリセットを行ってください。';
    }
}
