<?php

namespace App\Models;

use App\Models\Traits\HasCover;
use App\Models\Traits\BelongsToAccount;
use App\Models\Traits\HasPublishApproval;
use App\Models\Traits\HasWorks;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Series extends Model
{
    use HasFactory,
        HasCover,
        HasWorks,
        HasPublishApproval,
        BelongsToAccount;

    protected $fillable = [
        'title',
        'type',
        'description',
        'credit', //credits
        'account_id',
        'user_id',
        'published_at',
    ];



    protected $casts = [
        'published_at' => 'datetime',
    ];

    const TYPE_BOOK = 'Book';
    const TYPE_FILM = 'Film';
    const TYPE_AUDIO_BOOK = 'Audio Book';
    const TYPE_PODCAST = 'Podcast';

    const TYPES = [
        self::TYPE_BOOK,
        self::TYPE_FILM,
        self::TYPE_AUDIO_BOOK,
        self::TYPE_PODCAST,
    ];

    public function getOptionWorks($existingIds)
    {
        $optionWorks = [];

        if ($this->type === self::TYPE_BOOK) {
            $optionWorks = auth()->user()->books()->whereNotIn('id', $existingIds)->get();
        }

        if ($this->type === self::TYPE_FILM) {
            $optionWorks = auth()->user()->films()->whereNotIn('id', $existingIds)->get();
        }

        if ($this->type === self::TYPE_AUDIO_BOOK) {
            $optionWorks = auth()->user()->audioBooks()->whereNotIn('id', $existingIds)->get();
        }

        if ($this->type === self::TYPE_PODCAST) {
            $optionWorks = auth()->user()->podcasts()->whereNotIn('id', $existingIds)->get();
        }

        return $optionWorks;
    }
}
