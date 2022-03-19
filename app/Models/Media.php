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

    public function withWatermark($watermark = null, $position='left-top')
    {
        if (is_null($watermark)) {
            $watermark =  public_path("/bru_assets/textlogo.png");
        }

        $path = $this->path;
        $img = Image::make(Storage::disk('public')->path($path));
        $watermark = Image::make($watermark)->resize($img->width() / 2, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $data = $img->insert($watermark, $position, 10, 10)->encode('data-url', 50);
        return $data;
    }

    public function getSize($w = 96, $h = 128) {
        $path = $this->path;
        $img = Image::make(Storage::disk('public')->path($path))
            ->resize($w, $h)
            ->encode('data-url', 50);
        return $img;
    }
}
