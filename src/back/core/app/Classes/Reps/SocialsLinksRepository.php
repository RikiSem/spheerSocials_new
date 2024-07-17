<?php


namespace App\Classes\Reps;


use App\Models\Social;
use App\Models\UserAndSocial;
use Illuminate\Database\Eloquent\Collection;

class SocialsLinksRepository
{
    public static function addUserToSocial(int $userId, int $socialId): int
    {
        return UserAndSocial::create([
            'userId' => $userId,
            'socialId' => $socialId
        ])->id;
    }
    public static function getUserSocialsByUserId(int $userId)
    {
        return UserAndSocial::where('userId', '=', $userId)
                ->join('socials','socials.id', '=', 'socialId',)
                ->get() ?? false ;;
    }

    public static function getLinksBySocialIdAndUserId(int $userId, int $socialId): Collection
    {
        return UserAndSocial::where('socialId', '=', $socialId)
            ->where('userId', '=', $userId)
            ->get();
    }
}
