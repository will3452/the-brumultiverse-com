<?php

namespace App\Models\Traits;

use App\Models\Book;
use App\Models\Film;
use App\Models\Song;
use App\Models\Podcast;
use App\Models\ArtScene;
use App\Models\AudioBook;

trait ScholarTrait
{
    public function books()
    {
        return $this->hasMany(Book::class, 'account_id');
    }

    public function artScenes()
    {
        return $this->hasMany(ArtScene::class, 'account_id');
    }

    public function audioBooks()
    {
        return $this->hasMany(AudioBook::class, 'account_id');
    }

    public function songs()
    {
        return $this->hasMany(Song::class, 'account_id');
    }

    public function films()
    {
        return $this->hasMany(Film::class, 'account_id');
    }

    public function podcasts()
    {
        return $this->hasMany(Podcast::class, 'account_id');
    }
}
