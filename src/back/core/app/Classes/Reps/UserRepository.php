<?php


namespace App\Classes\Reps;


use App\Classes\ResponseBuilder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository
{
    public static function getUserByLogin(string $login): User|null
    {
        return User::where('login', '=', $login)->first();
    }

    public static function getUserById(int $userId): User
    {
        return User::select('users.id', 'users.login', 'users.about', 'users.isPremium', 'user_social_limits.limit')
            ->where('users.id', '=', $userId)
            ->join('user_social_limits', 'user_social_limits.userId', '=', 'users.id')
            ->first();
    }

    public static function saveNewUser(string $login, string $email, string $pass): User
    {
        return User::create([
            'login' => $login,
            'email' => $email,
            'password' => Hash::make($pass),
            'api_token' => hash('sha256', Str::random(60)),
        ]);
    }

    public static function verifyLoginUser(string $login, string $pass): array
    {
        $user = self::getUserByLogin($login);
        $result = [];
        if ($user) {
            if (Hash::check($pass, $user->getPassword())) {
                $result = [
                    'userId' => $user->getId(),
                    'token' => $user->api_token,
                ];
            }
        }

        return $result;
    }

}
