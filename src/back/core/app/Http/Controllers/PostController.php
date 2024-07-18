<?php

namespace App\Http\Controllers;

use App\Classes\Reps\PostRepository;
use App\Classes\ResponseBuilder;
use App\Classes\TimeParser;
use App\Models\SocialPost;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private const POST_COUNT_LIMIT = 50;

    public static function createPost(Request $request)
    {
        $socialId = $request->socialId;
        $userId = $request->userId;
        $text = $request->text;

        if ($request->postFiles) {
            $files = $request->postFiles;
        }
        $filesPath = json_encode(FileController::saveFiles($files));
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

    public static function getUserPosts(int $socialId, int $userId, int $skip = 0)
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
        $result = [];
        $publicPosts = self::getSocialPosts($socialId, $userId);
        foreach ($publicPosts as $key => $post) {
            $result[$key]['text'] = $post->text;
            $result[$key]['created_at'] = TimeParser::parseTime(Carbon::createFromTimeString($post->created_at)
                ->diff(Carbon::now()));
            $postFiles = json_decode($post->files, true);
            foreach ($postFiles as $fileKey => $file) {
                $result[$key]['files'][$fileKey]['url'] = $file['url'];
                $result[$key]['files'][$fileKey]['type'] = $file['type'];
            }
        }

        return $result;
    }

    public static function getPostsForPrivateUserFeed(int $socialId, int $userId): array
    {
        $result = [];
        $privatePosts = self::getUserPosts($socialId, $userId);
        foreach ($privatePosts as $key => $post) {
            $result[$key]['text'] = $post->text;
            $result[$key]['created_at'] = TimeParser::parseTime(Carbon::createFromTimeString($post->created_at)
                ->diff(Carbon::now()));
            $postFiles = json_decode($post->files, true);
            foreach ($postFiles as $fileKey => $file) {
                $result[$key]['files'][$fileKey]['url'] = $file['url'];
                $result[$key]['files'][$fileKey]['type'] = $file['type'];
            }
        }

        return $result;
    }
}
