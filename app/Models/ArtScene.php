<?php

namespace App\Models;

use App\Helpers\TagHelper;
use App\Helpers\FileHelper;
use App\Helpers\CrystalHelper;
use App\Models\Traits\HasArtFile;
use Cartalyst\Tags\TaggableTrait;
use App\Models\Traits\BelongsToClass;
use Cartalyst\Tags\TaggableInterface;
use App\Models\Traits\BelongsToAccount;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasPublishApproval;
use App\Models\Traits\HasStudentLink;
use App\Models\Traits\HasTickets;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArtScene extends Model implements TaggableInterface
{
    use HasFactory,
        HasStudentLink,
        HasTickets,
        BelongsToClass,
        BelongsToAccount,
        HasArtFile,
        HasPublishApproval,
        TaggableTrait;

    const _TYPE_LINK = 'Art';

    protected $with = [
        'artFile',
    ];

    const TICKET_EDITABLE = [
        'title',
        'description',
        'credit',
        'cost',
    ];

    protected $fillable = [
        'title',
        'description',
        'account_id',
        'user_id',
        'lead_college',
        'credit',
        'cost',
        'cost_type',
        'genre_id',
        'age_restriction',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    const DEFAULT_COST_TYPE = CrystalHelper::PURPLE_CRYSTAL;

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public static function processToCreate($r) // r === request
    {
        $artScene = self::create([
            'user_id' => auth()->id(),
            'account_id' => $r->account,
            'title' => $r->title,
            'age_restriction' => $r->age_restriction,
            'has_warning_message' => $r->has_warning_message,
            'category_id' => $r->category,
            'credit' => $r->credit,
            'description' => $r->description,
            'genre_id' => $r->genre,
            'cost' => $r->cost,
            'cost_type' => self::DEFAULT_COST_TYPE,
            'lead_character' => $r->lead_character,
            'lead_college' => $r->lead_college,
            'published_at' => $r->published_at,
        ]);

        $largeFile = FileHelper::filepondSave($r->file);

        $artScene->artFile()->create([
            'path' => $largeFile,
            'copyright_disclaimer' => true,
        ]);

        $tags = TagHelper::sanitize($r->tags);

        foreach ($tags as $tag) {
            $artScene->addTag($tag);
        }

        return $artScene;
    }

    public static function processToUpdate($r, $art) // r === request
    {
        $art->update([
            // 'user_id' => auth()->id(),
            'title' => $r->title,
            // 'age_restriction' => null,
            // 'has_warning_message' => $r->has_warning_message,
            // 'category_id' => $r->category,
            'credit' => $r->credit,
            'description' => $r->description,
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
            $art->addTag($tag);
        }

        return $art;
    }
}
