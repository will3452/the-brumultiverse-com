<?php

namespace App\Models;

use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;
    const COVER_HEIGHT = 800;
    const COVER_WIDTH = 512;

    protected $fillable = [
        'mediable_id',
        'mediable_type',
        'path',
        'copyright_disclaimer',
    ];

    public function withFrame($frame = null, $new=false, $art=false)
    {
        $width = self::COVER_WIDTH;
        $height = self::COVER_HEIGHT;

        if (is_null($frame)) {
            $frame = public_path('img/frame/book.png');
        }

        if ($art) {
            $frame = public_path('img/frame/art.png');
        }


        $fileName = "frame-$this->path";
        $filePath = '/img/cover-frames/' . $fileName;

        if (! file_exists(public_path($filePath)) || $new) {
            $path = $this->path;
            $img = Image::make(Storage::disk('public')->path($path));

            if ($art) {
                if ($img->getWidth() > $img->getHeight()) {
                    $frame = public_path('img/frame/art-landscape.png');
                    $width = $img->getWidth();
                    $height = $img->getHeight();
                }
            }

            $img->resize($width, $height); //resize the main cover

            $frameImg = Image::make($frame);

            $frameImg->resize($width, $height); // resize the frame
            $img->insert($frameImg, 'top-left', 0, 0)->save(public_path($filePath));
        }
        return $filePath;
    }

    public function withWatermark($watermark = null, $position='left-top', $new = false)
    {
        $prefix = "custom";
        if (is_null($watermark)) {
            $watermark =  getAsset('home/textlogo.png');
            $prefix = "default";
        }

        $fileName = "$prefix-watermarked-$this->path";
        $filePath = '/img/watermarked/' . $fileName;

        if (! file_exists(public_path($filePath)) || $new)
        {
            $path = $this->path;
            $img = Image::make(Storage::disk('public')->path($path));
                $watermark = Image::make($watermark)->resize($img->width() / 2, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            $img->insert($watermark, $position, 10, 10)->save(public_path($filePath), 75, 'png');
        }

        return $filePath;
    }

    public function getSize($w = 96, $h = 128) {
        $fileName = "$h-$w-$this->path";
        $path = '/img/cover/' . $fileName;
        if (! file_exists(public_path($path)))
        {
            $pathimg = $this->path;
            Image::make(Storage::disk('public')->path($pathimg))
                ->resize($w, $h)->save(public_path($path), 75, 'png');
        }
        return $path;
    }
}
