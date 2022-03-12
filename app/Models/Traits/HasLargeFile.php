<?php

namespace App\Models\Traits;

use App\Models\File;

trait HasLargeFile
{
    public function largeFile()
    {
        return $this->morphOne(File::class, 'model');
    }
}
