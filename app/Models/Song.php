<?php

namespace App\Models;

use App\Helpers\TagHelper;
use App\Helpers\FileHelper;
use App\Helpers\CrystalHelper;
use App\Models\Traits\HasCover;
use Cartalyst\Tags\TaggableTrait;
use App\Models\Traits\HasLargeFile;
use App\Models\Traits\BelongsToClass;
use Cartalyst\Tags\TaggableInterface;
use App\Models\Traits\BelongsToAccount;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasPublishApproval;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Song extends Model implements TaggableInterface
{
    use HasFactory,
        TaggableTrait,
        BelongsToAccount,
        HasLargeFile,
        BelongsToClass,
        HasPublishApproval,
        HasPublishApproval,
        HasCover;

    protected $with = [
            'cover',
            'largeFile',
        ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $fillable = [
        'title',
        'user_id',
        'account_id',
        'genre_id',
        'description',
        'credit',
        'cost_type',
        'cost',
        'lyrics',
        'copyright',
        'not_yet_copyrighted',
        'published_at',
    ];

    const DEFAULT_COST_TYPE = CrystalHelper::PURPLE_CRYSTAL;

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public static function processToCreate($r) // r === request
    {
        $song = self::create([
            'user_id' => auth()->id(),
            'account_id' => $r->account,
            'title' => $r->title,
            'description' => $r->description,
            'credit' => $r->credit,
            'genre_id' => $r->genre,
            'cost' => $r->cost,
            'not_yet_copyrighted' => $r->not_yet_copyrighted ?? false,
            'cost_type' => self::DEFAULT_COST_TYPE,
            'copyright' => $r->copyright,
            'lyrics' => $r->lyrics,
            'published_at' => $r->published_at,
        ]);

        $largeFile = FileHelper::filepondSave($r->file);

        $song->largeFile()->create([
            'path' => $largeFile,
            'copyright_disclaimer' => true,
        ]);

        $song->cover()->create([
            'path' => FileHelper::save($r->cover),
            'copyright_disclaimer' => true,
        ]);

        $tags = TagHelper::sanitize($r->tags);

        foreach ($tags as $tag) {
            $song->addTag($tag);
        }

        return $song;
    }

    public static function processToUpdate($r, $song) // r === request
    {
        $song->update([
            // 'user_id' => auth()->id(),
            // 'account_id' => $r->account,
            'title' => $r->title,
            'description' => $r->description,
            'credit' => $r->credit,
            // 'genre_id' => $r->genre,
            // 'cost' => $r->cost,
            'not_yet_copyrighted' => $r->not_yet_copyrighted ?? false,
            // 'cost_type' => self::DEFAULT_COST_TYPE,
            'copyright' => $r->copyright,
            'lyrics' => $r->lyrics,
            // 'published_at' => $r->published_at,
        ]);

        $tags = TagHelper::sanitize($r->tags);

        foreach ($tags as $tag) {
            $song->addTag($tag);
        }

        return $song;
    }
}
