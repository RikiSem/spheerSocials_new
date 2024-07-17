<?php


namespace App\Classes\Reps;


use App\Models\UserSocialLimit;

class SocialLimitRepository
{

    public static function addLimit(int $userId)
    {
        UserSocialLimit::addLimit($userId);
    }


}
