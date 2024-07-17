<?php


namespace App\Classes\Reps;


use App\Models\Social;
use Illuminate\Database\Eloquent\Collection;

class SocialRepository
{

    public static function createNewSocial(string $name, string $desription, int $userId): int
    {
        $socialId = Social::create([
            'name' => $name,
            'description' => $desription,
            'author' => $userId,
        ])->id;
        SocialsLinksRepository::addUserToSocial($userId, $socialId);
        return $socialId;
    }

    public static function getSocialsByName(string $name): Social|null
    {
        return Social::where('name', '=', $name)
            ->first();
    }

    public static function getSocialsByNameAndUserId(string $name, int $userId): array
    {
        $result = [];
        Social::where('name', 'like', '%' . $name . '%')
            ->chunk(Social::CHUNK_LIMIT, function ($socials) use (&$result, $userId) {
            /** @var Social $social */
            foreach ($socials as $key => $social) {
                $socialLinkedWithUser = SocialsLinksRepository::getLinksBySocialIdAndUserId($userId, $social->id);
                if ($socialLinkedWithUser->isEmpty()) {
                    $result[$key]['id'] = $social->id;
                    $result[$key]['name'] = $social->name;
                    $result[$key]['description'] = $social->description;
                    $result[$key]['isJoinedUser'] = false;

                    continue;
                }
                $result[$key]['id'] = $social->id;
                $result[$key]['name'] = $social->name;
                $result[$key]['description'] = $social->description;
                $result[$key]['isJoinedUser'] = true;
            }
        });

        return $result;
    }
}
