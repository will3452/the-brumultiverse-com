<?php

namespace App\Models;

use App\Helpers\TagHelper;
use App\Helpers\FileHelper;
use App\Models\Traits\HasCover;
use Cartalyst\Tags\TaggableTrait;
use App\Models\Traits\HasLargeFile;
use App\Models\Traits\BelongsToClass;
use Cartalyst\Tags\TaggableInterface;
use App\Models\Traits\BelongsToAccount;
use App\Models\Traits\HasFreeArtScenes;
use App\Models\Traits\HasPreview;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasPublishApproval;
use App\Models\Traits\HasTickets;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Film extends Model implements TaggableInterface
{
    use HasFactory,
        HasCover,
        HasTickets,
        HasFreeArtScenes,
        BelongsToAccount,
        BelongsToClass,
        HasLargeFile,
        HasPublishApproval,
        HasPreview,
        TaggableTrait;

    const TICKET_EDITABLE = [
        'title',
        'type', // film | trailer | animation
        'cost',
        'credit',
        'description',
    ];

    protected $fillable = [
        'title',
        'type', // film | trailer | animation
        'genre_id',
        'age_restriction',
        'language_id',
        'user_id',
        'account_id',
        'cost_type',
        'cost',
        'published_at',
        'credit',
        'description',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    const TYPE_FILM = 'Film';
    const TYPE_TRAILER = 'Trailer';
    const TYPE_ANIMATION = 'Animation';

    const TYPE_OPTIONS = [
        self::TYPE_TRAILER,
        self::TYPE_FILM,
        self::TYPE_ANIMATION,
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public static function processToCreate($r) // r === request
    {
        $film = self::create([
            'user_id' => auth()->id(),
            'account_id' => $r->account,
            'title' => $r->title,
            'age_restriction' => $r->age_restriction ?? 0,
            'type' => $r->type,
            'credit' => $r->credit,
            'description' => $r->description,
            'language_id' => $r->language,
            'genre_id' => $r->genre ?? null,
            'cost' => $r->cost,
            'cost_type' => $r->cost_type,
            'published_at' => $r->published_at,
        ]);

        $film->cover()->create([
            'path' => FileHelper::save($r->cover),
            'copyright_disclaimer' => true,
        ]);

        $tags = TagHelper::sanitize($r->tags);

        foreach ($tags as $tag) {
            $film->addTag($tag);
        }
        $largeFile = FileHelper::filepondSave($r->file);

        $film->largeFile()->create([
            'path' => $largeFile,
            'copyright_disclaimer' => true,
        ]);

        return $film;
    }

    public static function processToUpdate($r, $film) // r === request
    {
        $film->update([
            'user_id' => auth()->id(),
            'account_id' => $r->account,
            'title' => $r->title,
            // 'age_restriction' => $r->age_restriction ?? 0,
            // 'type' => $r->type,
            'credit' => $r->credit,
            'description' => $r->description,
            'language_id' => $r->language,
            // 'genre_id' => $r->genre ?? null,
            // 'cost' => $r->cost,
            // 'cost_type' => $r->cost_type,
            'published_at' => $r->published_at,
        ]);

        $tags = TagHelper::sanitize($r->tags);

        foreach ($tags as $tag) {
            $film->addTag($tag);
        }

        return $film;
    }
}
