<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileHelper
{
    public static function save($file, string $prefix = ''): string
    {
        $savedFile = $file->store('public');
        $pathArray = explode('/', $savedFile);
        return $prefix . end($pathArray);
    }

    public static function filepondSave($id)
    {
        $tmp = Storage::files("tmp" . DIRECTORY_SEPARATOR . $id)[0]; // get the file
        $arrTmp = explode('.', $tmp); // get the ext
        $ext = end($arrTmp); // get the ext
        $from = Storage::disk('local')->path($tmp); // get the abs file
        $filename = uniqid("bru-large-file") . time() . ".$ext"; // generate file name
        $to = Storage::disk('public')->path($filename); // generate file path
        if (File::move($from, $to)) { // check if moved
            return $filename;
        }
        return null; //
    }
}
