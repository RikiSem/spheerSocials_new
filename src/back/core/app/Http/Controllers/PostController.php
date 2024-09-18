<?php

namespace App\Http\Controllers;

use App\Classes\Reps\PostRepository;
use App\Classes\Reps\UserRepository;
use App\Classes\ResponseBuilder;
use App\Classes\TimeParser;
use App\Models\SocialPost;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private const POST_COUNT_LIMIT = 50;

    public static function createPost(Request $request)
    {
        $socialId = $request->socialId;
        $userId = $request->userId;
        $text = $request->text;
        $filesPath = '';
        if ($request->postFiles) {
            $files = $request->postFiles;
            $filesPath = json_encode(FileController::saveFiles($files));
        }
        $postId = PostRepository::addPost($userId, (int)$socialId, $text, $filesPath)->id;
        $result = ResponseBuilder::okResponse($postId);
        return response($result, $result['status']);
    }

    public function getPublicPosts(string $socialId, string $userId)
    {
        $result = ResponseBuilder::okResponse(PostController::getPostsForPublicUserFeed((int)$socialId, (int)$userId));
        return response($result, $result['status']);
    }

    public function getPrivatePosts(string $socialId, string $userId)
    {
        $result = ResponseBuilder::okResponse(PostController::getPostsForPrivateUserFeed((int)$socialId, (int)$userId));
        return response($result, $result['status']);
    }

    public static function getUserPosts(int $socialId, int $userId, int $skip = 0): Collection
    {
        return SocialPost::where('userId', '=', $userId)
            ->where('socialId', '=', $socialId)
            ->orderBy('id', 'desc')
            ->limit(self::POST_COUNT_LIMIT)
            ->skip($skip)
            ->get();
    }

    public static function getSocialPosts(int $socialId, int $userId, int $skip = 0)
    {
        return SocialPost::where('userId', '!=', $userId)
            ->where('socialId', '=', $socialId)
            ->orderBy('id', 'desc')
            ->limit(self::POST_COUNT_LIMIT)
            ->skip($skip)
            ->get();
    }

    public static function getPostsForPublicUserFeed(int $socialId, int $userId): array
    {
        $publicPosts = self::getSocialPosts($socialId, $userId);
        return PostController::prepareData($publicPosts);
    }

    public static function getPostsForPrivateUserFeed(int $socialId, int $userId): array
    {
        $privatePosts = self::getUserPosts($socialId, $userId);
        return PostController::prepareData($privatePosts);
    }

    public static function prepareData(Collection $data)
    {
        $result = [];
        foreach ($data as $key => $post) {
            $result[$key]['text'] = $post->text;
            $result[$key]['author'] = UserRepository::getUserById($post->userId)->toArray();
            $result[$key]['author']['avatar'] = ImageController::getUserAvatar($post->userId);
            $result[$key]['created_at'] = TimeParser::parseTime(Carbon::createFromTimeString($post->created_at)
                ->diff(Carbon::now()));
            $postFiles = json_decode($post->files, true) ?? [];
            foreach ($postFiles as $fileKey => $file) {
                $result[$key]['files'][$fileKey]['url'] = $file['url'];
                $result[$key]['files'][$fileKey]['type'] = $file['type'];
            }
        }

        return $result;
    }
}
