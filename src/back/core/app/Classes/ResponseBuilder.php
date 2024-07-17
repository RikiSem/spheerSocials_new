<?php


namespace App\Classes;


use Symfony\Component\HttpFoundation\Response;

class ResponseBuilder
{

    private const RESPONSE_TEMPLATE = [
        'content' => '',
        'status' => ''
    ];

    public static function okResponse(mixed $data): array
    {
        $result = self::RESPONSE_TEMPLATE;
        $result['content'] = $data;
        $result['status'] = Response::HTTP_OK;
        return $result;
    }

    public static function verifyFailedResponse(string $message): array
    {
        $result = self::RESPONSE_TEMPLATE;
        $result['content'] = $message;
        $result['status'] = Response::HTTP_UNAUTHORIZED;

        return $result;
    }

    public static function alreadyExist(string $message): array
    {
        $result = self::RESPONSE_TEMPLATE;
        $result['content'] = $message;
        $result['status'] = Response::HTTP_BAD_REQUEST;
        return $result;
    }

    public static function empty(string $message): array
    {
        $result = self::RESPONSE_TEMPLATE;
        $result['content'] = $message;
        $result['status'] = Response::HTTP_NO_CONTENT;
        return $result;
    }
}
