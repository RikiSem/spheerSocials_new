<?php

namespace App\Http\Controllers;

use App\Classes\Reps\SocialLimitRepository;
use App\Classes\Reps\UserRepository;
use App\Classes\ResponseBuilder;
use Illuminate\Http\Request;
use Mockery\Exception;

class AuthController extends Controller
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
}
