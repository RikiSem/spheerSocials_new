<?php


namespace App\Classes;


class TimeParser
{
    private const SECONDS_PARSE = [
        'секунду' => [
            1
        ],
        'секунды' => [
            2,
            3,
            4
        ],
        'секунд' => [
            5,
            6,
            7,
            8,
            9,
        ],
    ];
    private const MINUTES_PARSE = [
        'минуту' => [
            1
        ],
        'минуты' => [
            2,
            3,
            4
        ],
        'минут' => [
            5,
            6,
            7,
            8,
            9,
        ],
    ];

    private const HOURS_PARSE = [
        'час' => [
            1
        ],
        'часа' => [
            2,
            3,
            4,
        ],
        'часов' => [
            5,
            6,
            7,
            8,
            9,
        ],
    ];

    private const DAY_PARSE = [
        'день' => [
            1
        ],
        'дня' => [
            2,
            3,
            4,
        ],
        'дней' => [
            5,
            6,
            7,
            8,
            9,
        ],
    ];

    private const MONTH_PARSE = [
        'месяц' => [
            1
        ],
        'месяца' => [
            2,
            3,
            4,
        ],
        'месяцев' => [
            5,
            6,
            7,
            8,
            9,
        ],
    ];

    private const YEAR_PARSE = [
        'год' => [
            1
        ],
        'года' => [
            2,
            3,
            4,
        ],
        'лет' => [
            5,
            6,
            7,
            8,
            9,
        ],
    ];

    public static function parseTime(\DateInterval $dateInterval)
    {
        $result = '';
        if ($dateInterval->y !== 0) {
            $result .= self::parseYears((string)$dateInterval->y);
        }
        if ($dateInterval->m !== 0) {
            $result .= self::parseMonth((string)$dateInterval->m);
        }
        if ($dateInterval->d !== 0) {
            $result .= self::parseDays((string)$dateInterval->d);
        }
        if ($dateInterval->h !== 0) {
            $result .= self::parseHours((string)$dateInterval->h);
        }
        if ($dateInterval->i !== 0) {
            $result .= self::parseMin((string)$dateInterval->i);
        }
        if ($dateInterval->s !== 0) {
            $result .= self::parseSeconds((string)$dateInterval->s);
        }
        $result .= ' назад';
        return $result;
    }
    public static function parseYears(string $year)
    {
        $result = '';
        foreach (self::YEAR_PARSE as $key => $item) {
            if (in_array(substr($year, strlen($year) - 1, 1) , $item)) {
                $result = $year . ' ' . $key;
            }
            if (strlen($year) === 2 && $year <= 20) {
                $result = $year . ' ' . array_key_last(self::YEAR_PARSE);
            }
        }

        $result .= ' ';
        return $result;
    }

    public static function parseMonth(string $month)
    {
        $result = '';
        foreach (self::MONTH_PARSE as $key => $item) {
            if (in_array(substr($month, strlen($month) - 1, 1) , $item)) {
                $result = $month . ' ' . $key;
            }
            if (strlen($month) === 2 && $month <= 12) {
                $result = $month . ' ' . array_key_last(self::MONTH_PARSE);
            }
        }

        $result .= ' ';
        return $result;
    }

    public static function parseDays(string $day)
    {
        $result = '';
        foreach (self::DAY_PARSE as $key => $item) {
            if (in_array(substr($day, strlen($day) - 1, 1) , $item)) {
                $result = $day . ' ' . $key;
            }
            if (strlen($day) === 2 && $day <= 20) {
                $result = $day . ' ' . array_key_last(self::DAY_PARSE);
            }
        }

        $result .= ' ';
        return $result;
    }

    public static function parseHours(string $hour)
    {
        $result = '';
        foreach (self::HOURS_PARSE as $key => $item) {
            if (in_array(substr($hour, strlen($hour) - 1, 1) , $item)) {
                $result = $hour . ' ' . $key;
            }
            if (strlen($hour) === 2 && $hour <= 20) {
                $result = $hour . ' ' . array_key_last(self::HOURS_PARSE);
            }
        }

        $result .= ' ';
        return $result;
    }

    public static function parseMin(string $min) {
        $result = '';
        foreach (self::MINUTES_PARSE as $key => $item) {
            if (in_array(substr($min, strlen($min) - 1, 1) , $item)) {
                $result = $min . ' ' . $key;
            }
            if (strlen($min) === 2 && $min <= 20) {
                $result = $min . ' ' . array_key_last(self::MINUTES_PARSE);
            }
        }
        return $result;
    }

    public static function parseSeconds(string $sec) {
        $result = '';
        foreach (self::SECONDS_PARSE as $key => $item) {
            if (in_array(substr($sec, strlen($sec) - 1, 1) , $item)) {
                $result = $sec . ' ' . $key;
            }
            if (strlen($sec) === 2 && $sec <= 60) {
                $result = ' ' . $sec . ' ' . array_key_last(self::SECONDS_PARSE);
            }
        }
        return $result;
    }
}
