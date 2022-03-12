<?php

namespace App\Models;

use App\Models\Traits\HasCover;
use App\Models\Traits\HasWorks;
use App\Models\Traits\BelongsToAccount;
use App\Models\Traits\HasPublishApproval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collection extends Model
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
    const TYPE_SONG = 'Song';
    const TYPE_ART_SCENE = 'Art Scene';
}
