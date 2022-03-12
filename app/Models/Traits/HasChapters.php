<?php

namespace App\Models\Traits;

use App\Models\Chapter;

trait HasChapters
{
    public function chapters()
    {
        return $this->morphMany(Chapter::class, 'model');
    }
}
