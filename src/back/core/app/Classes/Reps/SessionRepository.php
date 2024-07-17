<?php


namespace App\Classes\Reps;


class SessionRepository
{
    public static function createSession(array $data)
    {
        $_SESSION['user_' . $data['userId']] = $data;
    }

    public static function getUserSession(int $userId): string
    {
        return isset($_SESSION['user_' . $userId]) ? '1' : '0';
    }
}
