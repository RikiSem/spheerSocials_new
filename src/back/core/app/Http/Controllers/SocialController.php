<?php

namespace App\Http\Controllers;

use App\Classes\Reps\SocialRepository;
use App\Classes\Reps\SocialsLinksRepository;
use App\Classes\ResponseBuilder;
use Illuminate\Http\Request;

class SocialController extends Controller
{
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

    public function joinToSocials(string $socialId, string $userId)
    {
        $result = ResponseBuilder::okResponse(SocialsLinksRepository::addUserToSocial((int)$userId, (int)$socialId));
        return response($result, $result['status']);
    }

    public function getUserSocials(int $userId)
    {
        $result = ResponseBuilder::OKResponse(SocialsLinksRepository::getUserSocialsByUserId($userId));
        return response($result, $result['status']);
    }

    public function searchSocials(string $name, string $userId)
    {
        $result = ResponseBuilder::okResponse(SocialRepository::getSocialsByNameAndUserId($name, (int)$userId));
        return response($result, $result['status']);
    }
}
