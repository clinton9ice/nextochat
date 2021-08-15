<?php


namespace Date;
use application\validation\Validation;

class Date
{
   private const format =  "m/d/Y";

    public static function currentDate(string $format = self::format)
    {
        return  date($format);
    }

/*
 * $type = true; This is used if the time should be in strtotime format;
 * $type = false; This is if you want to make a custom timestamp
 * */
    public static function stampDate($stamp = "", $string = true, string $format = self::format)
    {
        if ($string == true and !is_array($stamp)) {
            return date($format, strtotime($stamp));
        }
        else {
            return date($format = "m-d-Y h:i:sa", mktime($stamp[0], $stamp[1], $stamp[2]));
        }
    }

    public static function time_ago($time_ago): string
    {
        /** @var TYPE_NAME $time_ago */
        $time_ago =  strtotime($time_ago) ? strtotime($time_ago) : $time_ago;

        $time  = time() - $time_ago;

        switch(true):
// seconds
            case $time <= 60;
                return 'Just now';
// minutes
            case $time >= 60 && $time < 3600;
                return (round($time/60) == 1) ? 'a minute' : round($time/60).' minutes ago';
// hours
            case $time >= 3600 && $time < 86400;
                return (round($time/3600) == 1) ? 'a hour ago' : round($time/3600).' hours ago';
// days
            case $time >= 86400 && $time < 604800;
                return (round($time/86400) == 1) ? 'yesterday' : round($time/86400).' days ago';
// weeks
            case $time >= 604800 && $time < 2600640;
                return (floor($time/604800) == 1) ? 'a week ago' : round($time/604800).' weeks ago';
// months
            case $time >= 2600640 && $time < 31207680;
                return (round($time/2600640) == 1) ? 'a month ago' : round($time/2600640).' months ago';
// years
            case $time >= 31207680;
                return (round($time/31207680) == 1) ? 'a year ago' : round($time/31207680).' years ago' ;

        endswitch;
    }

}