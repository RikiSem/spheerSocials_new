<?php

namespace App\Http\Controllers;

use App\Classes\Reps\SessionRepository;
use App\Classes\Reps\SocialLimitRepository;
use App\Classes\Reps\SocialRepository;
use App\Classes\Reps\SocialsLinksRepository;
use App\Classes\Reps\UserRepository;
use App\Classes\ResponseBuilder;
use Illuminate\Http\Request;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ApiController extends Controller
{
    public function login(Request $req)
    {
        try {
            $login = $req->get('login');
            $pass = $req->get('pass');
            $result =  UserRepository::verifyLoginUser($login, $pass);
            $result = ResponseBuilder::okResponse($result);
            if (!isset($result)) {
                throw new \Exception('Verify failed');
            }
        } catch (Exception $e) {
            $result = ResponseBuilder::VerifyFailedResponse($e->getMessage());
        }
        return response($result, $result['status']);
    }

    public function registration(Request $req)
    {
        try{
            $login = $req->get('login');
            $email = $req->get('mail');
            $pass = $req->get('pass');
            $user = UserRepository::getUserByLogin($login);
            if (!isset($user)) {
                $user = UserRepository::saveNewUser($login, $email, $pass);
                SocialLimitRepository::addLimit($user->id);
                $result = ResponseBuilder::okResponse([
                    'userId' => $user->id,
                    'token' => $user->api_token,
                ]);
            } else {
                throw new \Exception('User with this login already exist');
            }
        } catch (\Exception $e) {
            $result = ResponseBuilder::alreadyExist($e->getMessage());
        }

        return response($result, $result['status']);
    }

    public function getUserSocials(int $userId)
    {
        $result = ResponseBuilder::OKResponse(SocialsLinksRepository::getUserSocialsByUserId($userId));
        return response($result, $result['status']);
    }

    public function createNewSocial(Request $req)
    {
        try {
            $name = $req->get('name');
            $desription = $req->get('description');
            $userId = (int)$req->get('author');
            $social = SocialRepository::getSocialsByName($name);
            if (isset($social)) {
                throw new \Exception('Social with this name already exist');
            }
            $result = ResponseBuilder::okResponse(SocialRepository::createNewSocial($name, $desription, $userId));
        } catch (\Exception $e) {
            $result = ResponseBuilder::alreadyExist($e->getMessage());
        }

        return response($result, $result['status']);
    }

    public function searchSocials(string $name, string $userId)
    {
        $result = ResponseBuilder::okResponse(SocialRepository::getSocialsByNameAndUserId($name, (int)$userId));
        return response($result, $result['status']);
    }

    public function joinToSocials(string $socialId, string $userId)
    {
        $result = ResponseBuilder::okResponse(SocialsLinksRepository::addUserToSocial((int)$userId, (int)$socialId));
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

    public function createPost(Request $request)
    {
        $socialId = $request->socialId;
        $userId = $request->userId;
        $text = $request->text;

        if ($request->postFiles) {
            $files = $request->postFiles;
        }
        $postId = PostController::createPost($userId, $socialId, $text, $files ?? [])->id;
        $result = ResponseBuilder::okResponse($postId);
        return response($result, $result['status']);
    }

    public function getSession(Request $request)
    {
        $userId = $request->id;
        /*$result = SessionRepository::getUserSession($userId);
        if ($result) {
            $result = ResponseBuilder::okResponse($userId);
        } else {
            $result = ResponseBuilder::verifyFailedResponse('Session not exist');
        }
        return response($result, $result['status']);*/
        return response(SessionRepository::getUserSession($userId), 200);
    }

    public function getUser(int $userId)
    {
        $result = ResponseBuilder::okResponse(UserRepository::getUserById($userId));
        return response($result, $result['status']);
    }

    public function getUserAvatar(int $userId)
    {
        $result = ResponseBuilder::okResponse(ImageController::getUserAvatar($userId));
        return response($result, $result['status']);
    }
}
