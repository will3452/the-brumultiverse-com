<?php

namespace App\Helpers;

class AssetHelper
{
    const BASE_URL = 'https://raw.githubusercontent.com/will3452/bru-assets/main/';

    public static function get($path)
    {
        return self::BASE_URL . $path;
    }
}
