<?php

namespace App\Http\Controllers;

use App\Models\UserAvatar;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    private const DEFAULT_AVATAR = 'default.png';

    public static function getUserAvatar(int $userId): string
    {
        $result = UserAvatar::where('userId', '=', $userId)
            ->orderBy('id', 'DESC')
            ->first();
        if (!isset($result->img)) {
            $result = self::getDefaultAvatar();
        } else {
            $result = Storage::url($result->img);
        }
        return $result;
    }

    public static function getDefaultAvatar()
    {
        return Storage::url('imgs/avatars/' . self::DEFAULT_AVATAR);
    }
}
