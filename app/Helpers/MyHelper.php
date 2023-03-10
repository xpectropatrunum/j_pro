<?php

namespace App\Helpers;

class MyHelper
{
    static function getUTCOffset($timezone)
    {
        $current = timezone_open($timezone);
        $utcTime = new \DateTime('now', new \DateTimeZone('UTC'));
        $offsetInSecs = timezone_offset_get($current, $utcTime);
        $hoursAndSec = gmdate('H:i', abs($offsetInSecs));
        return stripos($offsetInSecs, '-') === false ? "+{$hoursAndSec}" : "-{$hoursAndSec}";
    }
    static function fa_to_en($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }
    static function dateOfMonths()
    {
        $month = (new Shamsi)->jNumber()[1];
        $year = (new Shamsi)->jNumber()[0];
        $out = [];
        foreach (range(1, 30) as $day) {
            $out[] = (object)[
                "date" => $year . "/" . $month . "/" . $day,
                "weekday" => __(date("D", strtotime((new Shamsi)->jalali_to_gregorian($year . "/" . $month . "/" . $day)))),
                "index" => date("w", strtotime((new Shamsi)->jalali_to_gregorian($year . "/" . $month . "/" . $day))),
                "unix" => strtotime((new Shamsi)->jalali_to_gregorian($year . "/" . $month . "/" . $day))
            ];
        }
        return $out;
    }
    static function mt_($num)
    {
        return bcdiv($num / 10000000, 2);
    }
    static function nice_number2($n)
    {
        return round($n / 10000000, 2);
    }
    static function nice_number($n)
    {
        // first strip any formatting;
        $n = (0 + str_replace(",", "", $n));

        // is this a number?
        if (!is_numeric($n)) {
            return false;
        }

        // now filter it;
        if ($n > 1000000000000) {
            return round(($n / 1000000000000), 2) . 'T';
        } elseif ($n > 1000000000) {
            return round(($n / 1000000000), 2) . 'B';
        } elseif ($n > 1000000) {
            return round(($n / 1000000), 2) . 'M';
        } elseif ($n > 1000) {
            return round(($n / 1000), 2) . 'K';
        }

        return number_format($n);
    }
}
