<?php

namespace App\Helpers;

class TagHelper
{
    public static function sanitize($str)
    {
        $arr = preg_split("/[\[\]{}\:\;\,\"]/", $str);
        $tags = [];
        foreach ($arr as $a) {
            if (strlen($a) && $a != "value") {
                $tags[] = $a;
            }
        }

        return $tags;
    }

    public static function toShow($taggable)
    {
        return implode(',', $taggable->tags->pluck('name')->toArray());
    }
}
