<?php

namespace App\Models\Traits;

use App\Models\ArtScene;
use App\Models\AudioBook;
use App\Models\Book;
use App\Models\ClassWork;
use App\Models\Film;
use App\Models\Podcast;
use App\Models\Song;

trait HasWorks
{
    public function works()
    {
        return $this->morphMany(ClassWork::class, 'class');
    }
}
