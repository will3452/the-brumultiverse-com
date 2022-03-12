<?php

namespace App\Models\Traits;

use App\Models\Media;

trait HasMedia
{
    public function media()
    {
        $this->morphMany(Media::class, 'mediable');
}
}
