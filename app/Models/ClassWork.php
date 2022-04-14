<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'class_type',
        'work_id',
        'work_type',
    ];

    public function work()
    {
        return $this->morphTo();
    }

    public function modelClass() // class is not valid, since this is built-in in php.
    {
        return $this->morphTo();
    }

    const INDEX = [
        Book::class => '/scholar/books/',
        ArtScene::class => '/scholar/art-scenes/',
        AudioBook::class => '/scholar/audio-books/',
        Podcast::class => '/scholar/podcasts/',
        Song::class => '/scholar/songs/',
        Film::class => '/scholar/films/',
    ];
}
