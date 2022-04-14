<?php

namespace App\Models\Traits;

use App\Models\Book;
use App\Models\Film;
use App\Models\Song;
use App\Models\Event;
use App\Models\Account;
use App\Models\Album;
use App\Models\Podcast;
use App\Models\ArtScene;
use App\Models\AudioBook;
use App\Models\Collection;
use App\Models\Series;

trait ScholarTrait
{
    public function scholarModel()
    {
        if (self::class === Account::class) {
            return 'account_id';
        }

        return 'user_id';
    }

    public function events()
    {
        return $this->hasMany(Event::class, $this->scholarModel());
    }

    public function books()
    {
        return $this->hasMany(Book::class, $this->scholarModel());
    }

    public function artScenes()
    {
        return $this->hasMany(ArtScene::class, $this->scholarModel());
    }

    public function audioBooks()
    {
        return $this->hasMany(AudioBook::class, $this->scholarModel());
    }

    public function songs()
    {
        return $this->hasMany(Song::class, $this->scholarModel());
    }

    public function films()
    {
        return $this->hasMany(Film::class, $this->scholarModel());
    }

    public function podcasts()
    {
        return $this->hasMany(Podcast::class, $this->scholarModel());
    }

    public function albums()
    {
        return $this->hasMany(Album::class, $this->scholarModel());
    }

    public function collections()
    {
        return $this->hasMany(Collection::class, $this->scholarModel());
    }

    public function series()
    {
        return $this->hasMany(Series::class, $this->scholarModel());
    }
}
