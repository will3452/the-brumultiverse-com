<?php

namespace App\Models\Traits;

use App\Models\Media;

trait HasCover
{
    public function cover()
    {
        return $this->morphOne(Media::class, 'mediable');
    }
}
