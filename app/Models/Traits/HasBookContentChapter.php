<?php

namespace App\Models\Traits;

use App\Models\BookContentChapter;

trait HasBookContentChapter
{
    public function bookContentChapters ()
    {
        return $this->hasMany(BookContentChapter::class);
    }
}
