<?php

namespace App\Models;

use App\Helpers\TagHelper;
use App\Helpers\FileHelper;
use App\Helpers\CrystalHelper;
use App\Models\Traits\HasCover;
use App\Models\Traits\BookTrait;
use App\Models\Traits\HasTickets;
use Cartalyst\Tags\TaggableTrait;
use App\Models\Traits\HasChapters;
use App\Models\Traits\HasEpilogue;
use App\Models\Traits\HasPrologue;
use App\Models\Traits\HasHeatLevel;
use App\Models\Traits\BelongsToClass;
use Cartalyst\Tags\TaggableInterface;
use App\Models\Traits\BelongsToAccount;
use App\Models\Traits\HasBookContentChapter;
use App\Models\Traits\HasFreeArtScenes;
use App\Models\Traits\HasViolenceLevel;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasReviewQuestion;
use App\Models\Traits\HasPublishApproval;
use App\Models\Traits\HasStudentLink;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model implements TaggableInterface
{
    use HasFactory,
        HasTickets,
        HasStudentLink,
        BelongsToClass,
        HasPrologue,
        HasEpilogue,
        HasFreeArtScenes,
        HasReviewQuestion,
        TaggableTrait,
        BelongsToAccount,
        HasCover,
        HasBookContentChapter,
        HasChapters,
        HasPublishApproval,
        SoftDeletes,
        BookTrait;

    protected $with = [
        'cover',
        // 'chapters',
        'tags',
        'category',
    ];



    const _TYPE_LINK = 'Book';

    protected $casts = [
        'published_at' => 'datetime',
    ];

    const TICKET_EDITABLE = [
        'title',
        'credit',
        'blurb',
        'cost',
        'type',
    ];

    protected $fillable = [
        'user_id', //actual user profile
        'account_id',
        'title',
        'age_restriction', // and above
        'has_warning_message',
        'category_id',
        'credit',
        'blurb',
        'language_id',
        'genre_id',
        'violence_level_id',
        'heat_level_id',
        'type', // regular, premium,
        'cost',
        'cost_type',// ref. to the CrystalHelper
        'lead_character',
        'lead_college',
        'published_at',
        'back_matter',
        'front_matter',
        'deleted_at',
        'collaboration'
    ];

    const TYPE_REGULAR = 'Regular';
    const TYPE_PREMIUM = 'Premium';
    const TYPE_SPIN = 'Spin-Off';
    const TYPE_EVENT = 'Event';
    const TYPE_PLATINUM = 'Platinum';

    const TYPES = [
        // self::TYPE_EVENT,
        self::TYPE_PREMIUM,
        self::TYPE_PLATINUM,
        self::TYPE_REGULAR,
        self::TYPE_SPIN,
    ];

    public function bookContent ()
    {
        return $this->hasOne(BookContent::class, 'book_id');
    }


    const DEFAULT_COST_TYPE = CrystalHelper::PURPLE_CRYSTAL;

    public static function processToCreate($r) // r === request
    {
        $book = self::create([
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
            'type' => $r->type,
            'cost' => $r->cost,
            'cost_type' => self::DEFAULT_COST_TYPE,
            'lead_character' => $r->lead_character,
            'lead_college' => $r->lead_college,
            'published_at' => $r->published_at,
            'back_matter' => null,
            'front_matter' => null,
            'collaboration' => $r->collaboration,
        ]);

        $book->update([
            'heat_level_id' => $r->heat_level,
            'violence_level_id' => $r->violence_level,
        ]);

        $book->cover()->create([
            'path' => FileHelper::save($r->cover),
            'copyright_disclaimer' => true,
        ]);

        $tags = TagHelper::sanitize($r->tags);

        foreach ($tags as $tag) {
            $book->addTag($tag);
        }

        return $book;
    }

    public static function processToUpdate($r, $book) // r === request
    {
        $book->update([
            // 'user_id' => auth()->id(),
            'title' => $r->title,
            // 'age_restriction' => null,
            'has_warning_message' => $r->has_warning_message,
            // 'category_id' => $r->category,
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
            $book->addTag($tag);
        }

        return $book;
    }

    public function groups () {
        return $this->belongsToMany(Group::class, 'book_group');
    }
}
