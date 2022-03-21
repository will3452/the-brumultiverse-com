<?php

namespace App\Models;

use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'mediable_id',
        'mediable_type',
        'path',
        'copyright_disclaimer',
    ];

    public function withWatermark($watermark = null, $position='left-top', $new = false)
    {
        $prefix = "custom";
        if (is_null($watermark)) {
            $watermark =  public_path("/bru_assets/textlogo.png");
            $prefix = "default";
        }

        $fileName = "$prefix-watermarked-$this->path";
        $filePath = '/img/watermarked/' . $fileName;

        if (file_exists(public_path($filePath) && ! $new)) {
            return $filePath;
        } else {
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

        if (file_exists(public_path($path))) {
            return $path;
        } else {
            $pathimg = $this->path;
            $img = Image::make(Storage::disk('public')->path($pathimg))
                ->resize($w, $h)->save(public_path($path), 75, 'png');
        }
        return $path;
    }
}
