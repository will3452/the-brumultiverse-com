<?php

namespace App\Models;

use App\Models\Traits\HasCover;
use App\Models\Traits\HasHeatLevel;
use App\Models\Traits\BelongsToAccount;
use App\Models\Traits\BelongsToClass;
use App\Models\Traits\BookTrait;
use App\Models\Traits\HasChapters;
use App\Models\Traits\HasEpilogue;
use App\Models\Traits\HasFreeArtScenes;
use App\Models\Traits\HasPrologue;
use App\Models\Traits\HasPublishApproval;
use App\Models\Traits\HasReviewQuestion;
use App\Models\Traits\HasViolenceLevel;
use Cartalyst\Tags\TaggableInterface;
use Cartalyst\Tags\TaggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Book extends Model implements TaggableInterface
{
    use HasFactory,
        BelongsToClass,
        HasPrologue,
        HasEpilogue,
        HasFreeArtScenes,
        HasReviewQuestion,
        TaggableTrait,
        BelongsToAccount,
        HasCover,
        HasChapters,
        HasPublishApproval,
        BookTrait;

    protected $with = [
        'cover',
        'chapters',
    ];

    protected $casts = [
        'published_at' => 'datetime',
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
    ];

    const TYPE_REGULAR = 'Regular';
    const TYPE_PREMIUM = 'Premium';
    const TYPE_SPIN = 'Spin';
    const TYPE_EVENT = 'Event';
}
