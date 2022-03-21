<?php

namespace App\Models;

use App\Helpers\CrystalHelper;
use App\Helpers\TagHelper;
use App\Helpers\FileHelper;
use App\Models\Traits\HasCover;
use App\Models\Traits\BookTrait;
use Cartalyst\Tags\TaggableTrait;
use App\Models\Traits\HasLargeFile;
use App\Models\Traits\BelongsToClass;
use Cartalyst\Tags\TaggableInterface;
use App\Models\Traits\BelongsToAccount;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasReviewQuestion;
use App\Models\Traits\HasPublishApproval;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AudioBook extends Model implements TaggableInterface
{
    use HasFactory,
        BelongsToClass,
        BelongsToAccount,
        TaggableTrait,
        HasCover,
        BookTrait,
        HasLargeFile,
        HasPublishApproval,
        HasReviewQuestion;

    protected $with = [
        'cover',
        'largeFile'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'account_id',
        'title',
        'age_restriction',
        'category_id',
        'credit',
        'blurb',
        'language_id',
        'genre_id',
        'violence_level_id',
        'heat_level_id',
        'type',
        'cost',
        'cost_type',// ref. to the CrystalHelper
        'lead_character',
        'lead_college',
        'published_at',
    ];

    const TYPE_REGULAR = 'Regular';
    const TYPE_PREMIUM = 'Premium';
    const TYPE_SPIN = 'Spin';
    const TYPE_EVENT = 'Event';

    const DEFAULT_COST_TYPE = CrystalHelper::PURPLE_CRYSTAL;


    public static function processToCreate($r) // r === request
    {
        $audio = self::create([
            'user_id' => auth()->id(),
            'account_id' => $r->account,
            'title' => $r->title,
            'age_restriction' => null,
            'has_warning_message' => $r->has_warning_message,
            'category_id' => $r->category,
            'credit' => $r->credit,
            'blurb' => $r->blurb,
            'language_id' => $r->language,
            'genre_id' => $r->genre,
            'violence_level_id' => null,
            'heat_level_id' => null,
            'cost' => $r->cost,
            'cost_type' => self::DEFAULT_COST_TYPE,
            'lead_character' => $r->lead_character,
            'lead_college' => $r->lead_college,
            'published_at' => $r->published_at,
        ]);

        $largeFile = FileHelper::filepondSave($r->file);



        $audio->largeFile()->create([
            'path' => $largeFile,
            'copyright_disclaimer' => true,
        ]);

        $audio->update([
            'heat_level_id' => $r->heat_level,
            'violence_level_id' => $r->violence_level,
        ]);

        $audio->cover()->create([
            'path' => FileHelper::save($r->cover),
            'copyright_disclaimer' => true,
        ]);

        $tags = TagHelper::sanitize($r->tags);

        foreach ($tags as $tag) {
            $audio->addTag($tag);
        }

        return $audio;
    }

    public static function processToUpdate($r, $audio) // r === request
    {
        $audio->update([
            // 'user_id' => auth()->id(),
            'title' => $r->title,
            // 'age_restriction' => null,
            'has_warning_message' => $r->has_warning_message,
            'category_id' => $r->category,
            // 'credit' => $r->credit,
            'blurb' => $r->blurb,
            // 'language_id' => $r->language,
            // 'genre_id' => $r->genre,
            // 'type' => $r->type,
            // 'cost' => $r->cost,
            // 'cost_type' => self::DEFAULT_COST_TYPE,
            'published_at' => $r->published_at,
            // 'back_matter' => null,
            // 'front_matter' => null,
        ]);

        $tags = TagHelper::sanitize($r->tags);

        foreach ($tags as $tag) {
            $audio->addTag($tag);
        }

        return $audio;
    }
}
