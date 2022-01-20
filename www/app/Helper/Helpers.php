<?php

namespace App\Helper;

/**
 * Auto generate shorten urls.
 */
class Helpers {

    const LENGTH = 7;
    /**
     * @return int
     */
    static function shorten_strings($len)
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result), 0, $len);
    }
}
