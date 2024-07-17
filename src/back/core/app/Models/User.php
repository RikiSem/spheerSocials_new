<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getUserById(int $userId): self
    {
        return self::select('users.id', 'users.login', 'users.about', 'users.isPremium', 'user_social_limits.limit')
            ->where('users.id', '=', $userId)
            ->join('user_social_limits', 'user_social_limits.userId', '=', 'users.id')
            ->first();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
