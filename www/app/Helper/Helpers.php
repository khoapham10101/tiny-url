<?php

namespace App\Helper;

use App\Models\Url;
/**
 * Auto generate shorten urls.
 */
class Helpers {

    const LENGTH = 7;

    /**
     * @param $len
     * @return false|string
     */
    static function generate($len)
    {
        $str_default = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $str_result = substr(str_shuffle($str_default), 0, $len);
        if (self::validate($str_result)) {
            return self::generate($len);
        }
        return $str_result;
    }

    /**
     * @param $string
     * @return mixed
     */
    static function validate($string)
    {
        return null !== Url::where('short_url', $string)->first() ? true : false;
    }
}
