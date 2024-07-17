<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSocialLimit extends Model
{
    use HasFactory;
    protected $guarded = [];

    public const DEFAULT_SOCIAL_LIMIT = 3;

    public static function addLimit(int $userId)
    {
        self::create([
            'userId' => $userId,
        ]);
    }
}
