<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
    ];

    protected $with = [
        'levels',
    ];

    const TYPE_TEXT = 'Text';
    const TYPE_AUDIO = 'Audio';
    const TYPE_ART = 'Art';
    const TYPE_SONG = 'Song';
    const TYPE_VIDEO = 'Video';
    const TYPE_PODCAST = 'Podcast';

    const TYPE_OPTIONS = [
        self::TYPE_TEXT => self::TYPE_TEXT,
        self::TYPE_AUDIO => self::TYPE_AUDIO,
        self::TYPE_ART => self::TYPE_ART,
        self::TYPE_SONG => self::TYPE_SONG,
        self::TYPE_VIDEO => self::TYPE_VIDEO,
        self::TYPE_PODCAST => self::TYPE_PODCAST,
    ];

    public function levels()
    {
        return $this->hasMany(Level::class);
    }

    public static function forBook()
    {
        return self::whereType(self::TYPE_TEXT)->get()->pluck('name', 'id');
    }

    public static function forArtScene()
    {
        return self::whereType(self::TYPE_ART)->get()->pluck('name', 'id');
    }

    public static function forSong()
    {
        return self::whereType(self::TYPE_SONG)->get()->pluck('name', 'id');
    }

    public static function forFilm()
    {
        return self::whereType(self::TYPE_VIDEO)->get()->pluck('name', 'id');
    }
}
