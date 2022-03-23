<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class FileHelper
{
    public static function save($file, string $prefix = ''): string
    {
        $savedFile = $file->store('public');
        $pathArray = explode('/', $savedFile);
        return $prefix . end($pathArray);
    }

    public static function getExtension(string $path): string
    {
        $arr = explode('.', $path);
        return end($arr);
    }

    public static function generateImage($size, $path)
    {
        [$w, $h] =  $size;
        $newFileName = "$w-$h-$path";
        $file = Storage::disk('public')->path($path);
        if (file_exists($file)) {
            $img = Image::make($file)->resize($w,$h, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path("/img/profiles/" . $newFileName), 90, 'png');
        }

        return null;
    }

    public static function filepondSave($id, array $image = [])
    {
        $tmp = Storage::files("tmp" . DIRECTORY_SEPARATOR . $id)[0]; // get the file
        $ext = self::getExtension($tmp); // get the ext
        $from = Storage::disk('local')->path($tmp); // get the abs file
        $filename = uniqid("bru-large-file") . time() . ".$ext"; // generate file name
        $to = Storage::disk('public')->path($filename); // generate file path
        if (File::move($from, $to)) { // check if moved
            if (count($image)) {
                self::generateImage($image['size'], $filename);
            }
            return $filename;
        }
        return null; //
    }

    public static function delete($file)
    {
        return File::delete(Storage::disk('public')->path($file));
    }
}
