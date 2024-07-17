<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileController extends Controller
{
    private const IMG_FOLDER = 'imgs';
    private const VIDEO_FOLDER = 'vids';
    private const MUSIC_FOLDER = 'misc';
    private const OTHER_FOLDER = 'other';

    private const IMG_EXTENTIONS = [
        'png',
        'jpeg',
        'jpg',
        'svg',
    ];

    private const VIDEO_EXTENTIONS = [
        'mp4',
        'avi',
        'mpg',
        'mpeg',
        'm4v',
        'mov',
    ];

    private const MUSIC_EXTENTIONS = [
        'wav',
        'mp3',
        'ogg',
        'ape',
        'flac'
    ];

    public static function saveFiles(array $files): array
    {
        $result = [];
        /** @var UploadedFile $file */
        foreach ($files as $key => $file) {
            $folder = self::getPathByFileType($file);
            $path = Storage::putFileAs('public/' . $folder, $file, $file->getClientOriginalName());
            $path = str_replace('public', 'storage', $path);
            $result[$key]['url'] = $path;
            $result[$key]['type'] = $folder;
        }
        return $result;
    }

    public static function getPathByFileType(UploadedFile $file): string
    {
        $result = '';
        if (in_array($file->getClientOriginalExtension(), self::IMG_EXTENTIONS)) {
            $result = self::IMG_FOLDER;
        } elseif (in_array($file->getClientOriginalExtension(), self::VIDEO_EXTENTIONS)) {
            $result = self::VIDEO_FOLDER;
        } elseif (in_array($file->getClientOriginalExtension(), self::MUSIC_EXTENTIONS)) {
            $result = self::MUSIC_FOLDER;
        } else {
            $result = self::OTHER_FOLDER;
        }
        return $result;
    }
}
