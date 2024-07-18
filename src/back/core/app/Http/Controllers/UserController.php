<?php

namespace App\Http\Controllers;

use App\Classes\Reps\UserRepository;
use App\Classes\ResponseBuilder;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
