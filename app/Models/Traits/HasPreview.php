<?php

namespace App\Models\Traits;

use App\Models\Preview;

trait HasPreview
{
    public function preview()
    {
        return $this->morphOne(Preview::class, 'mediable');
    }

    public function hasPreview(): bool
    {
        return $this->preview == null ? false : true;
    }
}
