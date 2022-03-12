<?php

namespace App\Helpers;

class FileHelper
{
    public static function save($file, string $prefix = ''): string
    {
        $savedFile = $file->store('public');
        $pathArray = explode('/', $savedFile);
        return $prefix . end($pathArray);
    }
}
