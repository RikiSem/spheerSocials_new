<?php


namespace App\Classes\Reps;


use App\Models\SocialPost;

class PostRepository
{

    public static function addPost(int $userId, int $socialId, string $text, string $filesPath = ''): SocialPost
    {
        return SocialPost::create([
            'userId' => $userId,
            'socialId' => $socialId,
            'text' => $text,
            'files' => $filesPath,
        ]);
    }
}
