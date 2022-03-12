<?php

namespace App\Models\Traits;

use App\Models\Media;

trait HasArtFile
{
    public function artFile()
    {
        return $this->morphOne(Media::class, 'mediable');
    }
}
