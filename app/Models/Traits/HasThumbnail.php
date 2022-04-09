<?php

namespace App\Models\Traits;

use App\Helpers\FileHelper;

trait HasThumbnail
{
    public function getThumbnailAttribute()
    {
        $size = implode('-', self::THUMBNAIL_SIZE);
        return "/img/profiles/" . $size . "-" . $this->path;
    }

    protected static function boot() {
        parent::boot();
        static::created(function ($model) {
            $path = $model->path;
            if (is_null($path)) {
                $path = $model->file;
            }
            FileHelper::generateImage([90, 140], $path);
        });
    }
}
