<?php

namespace App\Helper;

use App\Models\Url;
use Illuminate\Support\Facades\Cache;

/**
 * Auto generate shorten urls.
 */
class Helpers
{

    const LENGTH = 7;

    const REDIS_TIME = -1;

    /**
     * @param $len
     * @return false|string
     */
    public static function generate($len)
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
    public static function validate($string)
    {
        return null !== Url::where('short_url', $string)->first() ? true : false;
    }

    public static function clearCacheForKey($key)
    {
        Cache::forget($key);
    }

    public static function rememberForever($short_url, $long_url = '')
    {
        Cache::rememberForever($short_url, function () use ($short_url, $long_url) {
            if ($long_url) {
                return $long_url;
            }
            return Url::findOneByPath($short_url)->long_url;
        });
    }
}
