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
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasPublishApproval;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Podcast extends Model implements TaggableInterface
{
    use HasFactory,
        BelongsToAccount,
        BelongsToClass,
        HasCover,
        HasLargeFile,
        HasPublishApproval,
        TaggableTrait;

    protected $with = [
        'cover',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'launch_at' => 'date',
    ];

    protected $fillable = [
        'title',
        'account_id',
        'user_id',
        'description',
        'credit',
        'type', // regular | premium
        'cost_type',
        'cost',
        'launch_at',
        'published_at',
    ];

    const TYPE_REGULAR = 'Regular';
    const TYPE_PREMIUM = 'Premium';

    public static function processToCreate($r) // r === request
    {
        $podcast = self::create([
            'user_id' => auth()->id(),
            'account_id' => $r->account,
            'title' => $r->title,
            'type' => $r->type,
            'description' => $r->description,
            'credit' => $r->credit,
            'cost' => $r->cost,
            'cost_type' => $r->cost_type,
            'launch_at' => $r->launch_at,
            'published_at' => $r->published_at,
        ]);

        $largeFile = FileHelper::filepondSave($r->file);

        $podcast->largeFile()->create([
            'path' => $largeFile,
            'copyright_disclaimer' => true,
        ]);

        $podcast->cover()->create([
            'path' => FileHelper::save($r->cover),
            'copyright_disclaimer' => true,
        ]);

        $tags = TagHelper::sanitize($r->tags);

        foreach ($tags as $tag) {
            $podcast->addTag($tag);
        }

        return $podcast;
    }

    public static function processToUpdate($r, $podcast) // r === request
    {
        $podcast->update([
            // 'user_id' => auth()->id(),
            // 'account_id' => $r->account,
            'title' => $r->title,
            // 'type' => $r->type,
            'description' => $r->description,
            'credit' => $r->credit,
            // 'cost' => $r->cost,
            // 'cost_type' => $r->cost_type,
            // 'launch_at' => $r->launch_at,
            'published_at' => $r->published_at,
        ]);


        $tags = TagHelper::sanitize($r->tags);

        foreach ($tags as $tag) {
            $podcast->addTag($tag);
        }

        return $podcast;
    }
}
